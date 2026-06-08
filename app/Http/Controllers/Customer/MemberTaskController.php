<?php

namespace App\Http\Controllers\Customer;
 
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Customer;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MemberTaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Jika user tidak login, redirect ke login
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the actual customer record
        $customer = Customer::where('email', $user->email)->first();
        if (!$customer) {
            return back()->with('error', 'Customer record not found. Please contact support.');
        }
 
        $tasks = Task::where('is_active', true)
            ->orderByRaw("FIELD(required_tier, 'Bronze', 'Silver', 'Gold')")
            ->get()
            ->map(function (Task $task) use ($customer) {
                $unlocked = $task->isUnlockedFor($customer->tier ?? 'Bronze');
                $hasPurchases = $this->customerHasSufficientPurchases($customer, $task);
                $pivot = $customer->tasks()->where('task_id', $task->id)->first();
 
                // Get products for product-specific tasks
                $products = [];
                if ($task->task_type === 'product_specific') {
                    $products = $task->products()
                        ->select('products.id', 'products.pro_name', 'products.pro_price')
                        ->get()
                        ->map(fn($p) => [
                            'id' => $p->id,
                            'name' => $p->pro_name,
                            'pro_price' => $p->price,
                        ])
                        ->toArray();
                }

                return [
                    'id'            => $task->id,
                    'title'         => $task->title,
                    'description'   => $task->description,
                    'required_tier' => $task->required_tier,
                    'task_type'     => $task->task_type,
                    'points_reward' => $task->points_reward,
                    'min_purchases' => $task->min_purchases_required,
                    'has_purchases' => $hasPurchases,
                    'unlocked'      => $unlocked && $hasPurchases,
                    'claimed'       => $pivot !== null,
                    'status'        => $pivot?->pivot?->status,
                    'coupon_code'   => $pivot?->pivot?->coupon_code,
                    'claimed_at'    => $pivot?->pivot?->claimed_at,
                    'product_count' => $task->products()->count(),
                    'products'      => $products,
                ];
            });
 
        $grouped = [
            'Bronze' => $tasks->where('required_tier', 'Bronze')->values(),
            'Silver' => $tasks->where('required_tier', 'Silver')->values(),
            'Gold'   => $tasks->where('required_tier', 'Gold')->values(),
        ];
 
        return view('customer.tasks', [
            'customer' => $customer,
            'grouped'  => $grouped,
            'tasks'    => $tasks,
        ]);
    }
 
    public function claim(Request $request, Task $task)
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the actual customer record
        $customer = Customer::where('email', $user->email)->first();
        if (!$customer) {
            return back()->with('error', 'Customer record not found.');
        }
 
        // Check if task is unlocked for customer's tier
        if (!$task->isUnlockedFor($customer->tier ?? 'Bronze')) {
            return back()->with('error', 'You do not have the required tier for this task.');
        }
 
        // Check if customer has made sufficient purchases
        if (!$this->customerHasSufficientPurchases($customer, $task)) {
            $purchaseCount = $customer->orders()->count();
            return back()->with('error', "You need to purchase at least {$task->min_purchases_required} product(s) to claim this task. You have purchased: {$purchaseCount}");
        }
 
        // Check if already claimed
        $alreadyClaimed = $customer->tasks()->where('task_id', $task->id)->exists();
        if ($alreadyClaimed) {
            return back()->with('error', 'You have already claimed this task.');
        }
 
        // Generate unique coupon code
        $couponCode = strtoupper('BROOLE-' . Str::random(8));
        while (DiscountCoupon::where('code', $couponCode)->exists()) {
            $couponCode = strtoupper('BROOLE-' . Str::random(8));
        }
 
        // Create the discount coupon
        DiscountCoupon::create([
            'code'             => $couponCode,
            'description'      => "Reward coupon from task: {$task->title}",
            'discount_type'    => 'percentage',
            'discount_value'   => $this->discountByTier($task->required_tier),
            'minimum_purchase' => 0,
            'max_uses'         => 1,
            'is_active'        => true,
            'expires_at'       => now()->addDays(30)->toDateString(),
        ]);
 
        // Attach task to customer
        $customer->tasks()->attach($task->id, ['id' => \Illuminate\Support\Str::uuid(), 
            'status'      => 'claimed',
            'coupon_code' => $couponCode,
            'claimed_at'  => now(),
        ]);
 
        // Add points and save to database
        if ($task->points_reward > 0) {
            $customer->increment('member_points', $task->points_reward);
        }
 
        return back()->with('success', "Task claimed! Your coupon code is: {$couponCode} | Points: +{$task->points_reward}");
    }
 
    public function widget()
    {
        $user = auth()->user();
        if (!$user) return response()->json([]);

        // Get the actual customer record
        $customer = Customer::where('email', $user->email)->first();
        if (!$customer) return response()->json([]);
 
        $tasks = Task::where('is_active', true)
            ->orderByRaw("FIELD(required_tier, 'Bronze', 'Silver', 'Gold')")
            ->take(5)
            ->get()
            ->map(fn(Task $t) => [
                'id'            => $t->id,
                'title'         => $t->title,
                'required_tier' => $t->required_tier,
                'task_type'     => $t->task_type,
                'points_reward' => $t->points_reward,
                'min_purchases' => $t->min_purchases_required,
                'has_purchases' => $this->customerHasSufficientPurchases($customer, $t),
                'unlocked'      => $t->isUnlockedFor($customer->tier ?? 'Bronze') && $this->customerHasSufficientPurchases($customer, $t),
                'claimed'       => $customer->tasks()->where('task_id', $t->id)->exists(),
                'product_count' => $t->products()->count(),
            ]);
 
        return response()->json($tasks);
    }

    /**
     * Check if customer has made sufficient purchases for a task
     */
    private function customerHasSufficientPurchases($customer, Task $task): bool
    {
        // Get the actual customer record from User
        $actualCustomer = $customer instanceof Customer ? $customer : Customer::where('email', $customer->email)->first();
        
        if (!$actualCustomer) {
            return false;
        }

        if ($task->task_type === 'general') {
            // For general tasks: check order count
            $orderCount = $actualCustomer->orders()->count();
            return $orderCount >= $task->min_purchases_required;
        } else {
            // For product-specific tasks: check if customer has purchased ANY of the required products
            $requiredProductIds = $task->products()->pluck('products.id')->toArray();
            
            if (empty($requiredProductIds)) {
                return false;
            }

            $customerPurchasedProductIds = $actualCustomer->orders()
                ->join('order_items', 'order_histories.id', '=', 'order_items.order_id')
                ->distinct()
                ->pluck('order_items.product_id')
                ->toArray();

            // Check if customer purchased at least one of the required products
            $hasPurchasedRequiredProduct = count(array_intersect($requiredProductIds, $customerPurchasedProductIds)) > 0;
            
            return $hasPurchasedRequiredProduct && $actualCustomer->orders()->count() >= $task->order_count;
        }
    }
 
    private function discountByTier(string $tier): float
    {
        return match($tier) {
            'Bronze' => 5.0,
            'Silver' => 10.0,
            'Gold'   => 15.0,
            default  => 5.0,
        };
    }
}