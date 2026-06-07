<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // =========================================================================
    //  SHOP — Product listing with category filter
    // =========================================================================

    public function index(Request $request)
{
    // 1. Fetch active categories
    $categories = DB::table('categories')
        ->where('category_name', '!=', 'Uncategorized')
        ->where('category_delete', false)
        ->get();

    // 2. Base Query
    $query = Product::with([
        'category',
        'ingredients' => function ($q) {
            $q->withPivot('amount_needed');
        },
    ])->where('pro_delete', false)
      ->whereHas('category', function($q) {
          $q->where('category_name', '!=', 'Uncategorized');
      });

    // 3. Live Search Filter
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('pro_name', 'LIKE', "%{$search}%")
              ->orWhere('pro_description', 'LIKE', "%{$search}%");
        });
    }

    // 4. Category Filter
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // 5. Sorting
    $sort = $request->input('sort', 'latest');
    switch ($sort) {
        case 'price_low':
            $query->orderBy('pro_price', 'asc');
            break;
        case 'price_high':
            $query->orderBy('pro_price', 'desc');
            break;
        case 'name_asc':
            $query->orderBy('pro_name', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('pro_name', 'desc');
            break;
        default:
            $query->latest();
            break;
    }

    // 6. Sort out of stock items to the bottom
    $allProducts = $query->get();

    $inStock = $allProducts->filter(function($product) {
        return $product->calculated_stock > 0;
    });

    $outOfStock = $allProducts->filter(function($product) {
        return $product->calculated_stock <= 0;
    });

    $sortedProducts = $inStock->merge($outOfStock);

    // 7. Paginate (12 per page) & keep query strings manually
    $perPage = 12;
    $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;

    $products = new \Illuminate\Pagination\LengthAwarePaginator(
        $sortedProducts->forPage($page, $perPage)->values(),
        $sortedProducts->count(),
        $perPage,
        $page,
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), 'query' => $request->query()]
    );

    // [BARU] Jika di-request via JavaScript (Real-time), kirimkan html bagian grid saja
    if ($request->ajax()) {
        // Return full view, client-side DOMParser will extract #shop-dynamic-content
        return view('customer.shop', compact('products', 'categories', 'sort'));
    }

    return view('customer.shop', compact('products', 'categories', 'sort'));
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function checkout(Request $request)
    {
        // 1. Validate the incoming payload
        $validated = $request->validate([
            'items'            => ['required', 'array', 'min:1'],
            'items.*.id'       => ['required', 'integer', 'exists:products,id'],
            'items.*.qty'      => ['required', 'integer', 'min:1'],
            'items.*.price'    => ['required', 'numeric', 'min:0'],
            'items.*.sugarLevel' => ['nullable', 'in:0,50,100'],
            'notes'            => ['nullable', 'string', 'max:500'],
            'promo'            => ['nullable', 'string', 'max:30'],
            'discount'         => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        // 2. Re-verify stock for every item (server-side guard)
        $errors = [];
        foreach ($validated['items'] as $lineItem) {
            $product = Product::with(['ingredients' => function ($q) {
                $q->withPivot('amount_needed');
            }])->find($lineItem['id']);

            if (! $product || $product->pro_delete) {
                $errors[] = ($product->pro_name ?? 'A product') . ' is no longer available.';
                continue;
            }

            if ($product->calculated_stock < $lineItem['qty']) {
                $errors[] = 'Only ' . $product->calculated_stock . ' unit(s) of "' . $product->pro_name . '" are available.';
            }
        }

        if (! empty($errors)) {
            return response()->json([
                'success' => false,
                'errors'  => $errors,
            ], 422);
        }

        // 4. Return success — the cart page will clear localStorage and redirect
        return response()->json([
            'success'      => true,
            'message'      => 'Order placed successfully!',
            // 'order_id'  => $order->id,   // uncomment when Order model exists
            'redirect_url' => route('customer.shop'), // change to order-confirmation route
        ]);
    }

    public function viewCart()
    {
        return view('customer.cart');
    }

    // =========================================================================
    //  VALIDATE COUPON — Validates a coupon code and returns discount percentage
    // =========================================================================

    public function validateCoupon(Request $request)
    {
        $code = $request->input('code', '');

        if (!$code) {
            return response()->json([
                'valid' => false,
                'message' => 'Coupon code is required.',
            ]);
        }

        // Search for the coupon in discount_coupons table
        $coupon = \App\Models\DiscountCoupon::where('code', strtoupper($code))
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid coupon code.',
            ]);
        }

        // Check if coupon has expired
        if ($coupon->expires_at && now()->isAfter($coupon->expires_at)) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon has expired.',
            ]);
        }

        // Check if coupon has reached max uses
        if ($coupon->max_uses && $coupon->times_used >= $coupon->max_uses) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon has reached its usage limit.',
            ]);
        }

        // Coupon is valid
        return response()->json([
            'valid' => true,
            'code' => $coupon->code,
            'discount_value' => $coupon->discount_value,
            'discount_type' => $coupon->discount_type,
            'message' => 'Coupon applied successfully!',
        ]);
    }
}