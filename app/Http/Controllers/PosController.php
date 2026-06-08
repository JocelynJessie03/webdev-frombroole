<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $categories = DB::table('categories')
        ->where('category_name', '!=', 'Uncategorized')
        ->where('category_delete', false)
        ->get();

        // Pastikan meload relasi dengan pivot table amount_needed agar Accessor di Model bisa menghitungnya
        $query = Product::with(['category', 'ingredients' => function($q) {
            $q->withPivot('amount_needed');
        }])->where('pro_delete', false)
          ->whereHas('category', function($q) {
              $q->where('category_name', '!=', 'Uncategorized');
          });

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();

        $products = $products->sortByDesc(function ($product) {
            // Jika stok lebih dari 0, berikan nilai 1 (prioritas tinggi)
            // Jika stok 0 atau kurang, berikan nilai 0 (prioritas rendah, akan turun ke bawah)
            return $product->getCalculatedStockAttribute() > 0 ? 1 : 0;
        })->values();

        return view('pos', compact('products', 'categories'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $cart = json_decode($request->cart, true);

            if (!$cart || count($cart) == 0) {
                return back()->with('error', 'Cart kosong!');
            }

            $subtotal = 0;
            $totalItems = 0;

            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['qty'];
                $totalItems += $item['qty'];
            }

            $tax = $subtotal * 0.10;
            $total = $subtotal + $tax;

            $order = OrderHistory::create([
                'order_id' => 'INV-' . now()->format('YmdHis'),
                'customer_id' => null,
                'order_date' => now(),
                'total_items' => $totalItems,
                'total_price' => $total,
                'status' => 'Pending'
            ]);

            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'sugar_level' => $item['sugarLevel'],
                    'price_at_purchase' => $item['price']
                ]);
            }

           DB::commit();

        return redirect()
        ->route('checkout.view', $order->id);
        }

        catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
 
    public function checkoutPreview(Request $request)
    {
        $cart = json_decode($request->input('cart'), true) ?? [];

        return view('checkout_preview', compact('cart'));
    }

    public function processPayment(Request $request)
    {
        $cart = json_decode($request->cart, true);
        $customerId = $request->customer_id;
        $pointsUsed = $request->points_used ? (int) $request->points_used : 0;
        $paymentMethod = $request->payment_method; 

        $subtotal = 0;
        $totalItems = 0;
        $item_details = [];

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
            $totalItems += $item['qty'];

            $item_details[] = [
                'id' => $item['id'],
                'price' => (int) $item['price'],
                'quantity' => $item['qty'],
                'name' => substr($item['name'], 0, 50),
            ];
        }

        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        $item_details[] = [
            'id' => 'TAX-10',
            'price' => (int) $tax,
            'quantity' => 1,
            'name' => 'Tax (10%)',
        ];

        // LOGIKA POTONGAN POIN: Menggunakan kuantitas -1 agar Midtrans tidak menolak harga negatif
        if ($pointsUsed > 0) {
            if ($pointsUsed > $total) {
                $pointsUsed = $total;
            }
            $total -= $pointsUsed;

            $item_details[] = [
                'id' => 'DISC-POIN',
                'price' => (int) $pointsUsed, 
                'quantity' => -1, // Trik kuantitas minus agar disetujui Midtrans
                'name' => 'Diskon Poin Member',
            ];
        }

        // Tambah string acak di belakang ID agar terhindar dari duplikasi ID saat testing sandbox
        $banhyakOrder = DB::table('order_histories')->count();
        $orderId = 'INV-' . now()->format('YmdHis') . '-' . str_pad($banhyakOrder + 1, 3, '0', STR_PAD_LEFT);

        // ================= PAY CASH =================
        if ($paymentMethod === 'cash') {
            DB::beginTransaction();
            try {
                $order = OrderHistory::create([
                    'order_id' => $orderId,
                    'customer_id' => $customerId ?: null,
                    'order_date' => now(),
                    'total_items' => count($cart),
                    'total_price' => $total,
                    'status' => 'Pending',
                    'payment_method' => 'Cash'
                ]);

                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['qty'],
                        'price_at_purchase' => $item['price'],
                        'sugar_level' => $item['sugarLevel']
                    ]);

                    $product = \App\Models\Product::with(['ingredients' => function($q) {
                        $q->withPivot('amount_needed');
                    }])->find($item['id']);

                    if ($product && $product->ingredients) {
                        foreach ($product->ingredients as $ingredient) {
                            $takaran = $ingredient->pivot->amount_needed ?: 1;
                            
                            // --- TAMBAHAN LOGIKA SUGAR LEVEL UNTUK CASH ---
                            $namaBahan = strtolower($ingredient->name);
                            if (str_contains($namaBahan, 'gula') || str_contains($namaBahan, 'sugar')) {
                                $persentaseGula = isset($item['sugarLevel']) ? ((int)$item['sugarLevel'] / 100) : 1;
                                $takaran = $takaran * $persentaseGula;
                            }
                            // ----------------------------------------------

                            $totalPotongan = $takaran * $item['qty'];
                            
                            $ingredient->stock = $ingredient->stock - $totalPotongan;
                            $ingredient->save();

                            DB::table('ingredient_histories')->insert([
                                'id'            => \Illuminate\Support\Str::uuid(),
                                'ingredient_id' => $ingredient->id,
                                'amount'        => $totalPotongan,
                                'type'          => 'out',
                                'date'          => today()->toDateString(),
                                'created_at'    => now(),
                                'updated_at'    => now()
                            ]);
                        }
                    }
                }

                if ($customerId) {
                    if ($pointsUsed > 0) {
                        DB::table('customers')->where('id', $customerId)->decrement('member_points', $pointsUsed);
                    }
                    
                    DB::table('customers')->where('id', $customerId)->increment('total_spend', $total);
                    $customer = DB::table('customers')->where('id', $customerId)->first();
                    
                    if ($customer) {
                        // SINKRONISASI TIER & PROGRESS BAR BARU
                        $newTier = 'Bronze';
                        if ($customer->total_spend >= 700000) { $newTier = 'Gold'; } 
                        elseif ($customer->total_spend >= 300000) { $newTier = 'Silver'; }

                        $progressPercentage = min(($customer->total_spend / 700000) * 100, 100);
                        $pointsEarned = floor($total / 100); // Kelipatan Rp 100

                        DB::table('customers')->where('id', $customerId)->update([
                            'tier' => $newTier,
                            'progress_percentage' => round($progressPercentage)
                        ]);

                        if ($pointsEarned > 0) {
                            DB::table('customers')->where('id', $customerId)->increment('member_points', $pointsEarned);
                        }
                    }
                }

                DB::table('notifications')->insert([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'title'   => 'New Order Received (Cash)',
                    'message' => 'Order ' . $orderId . ' has been successfully generated with total payment of Rp ' . number_format($total, 0, ',', '.'),
                    'type'    => 'order',
                    'is_read' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::commit();
                return redirect()->route('receipt', $order->id);

            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Gagal memproses transaksi tunai: ' . $e->getMessage());
            }
        }

        // ================= PAY MIDTRANS =================
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $total,
            ],
            'item_details' => $item_details,
            'enabled_payments' => ['qris', 'gopay'], 
        ];

        $snapToken = Snap::getSnapToken($transaction);

        session([
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'order_id' => $orderId,
            'customer_id' => $customerId,
            'points_used' => $pointsUsed,
            'payment_method' => 'QRIS/GoPay'
        ]);

        return view('payment', compact('snapToken'));
    }

    public function paymentSuccess()
    {
        $cart = session('cart');
        $customerId = session('customer_id');
        $pointsUsed = session('points_used');
        $paymentMethod = session('payment_method', 'QRIS/GoPay');

        if (!$cart) {
            return redirect()->route('pos')->with('error', 'Session Is Expired.');
        }

        DB::beginTransaction();

        try {
            $order = OrderHistory::create([
                'order_id' => session('order_id'),
                'customer_id' => $customerId ?: null,
                'order_date' => now(),
                'total_items' => count($cart),
                'total_price' => session('total'),
                'status' => 'Pending',
                'payment_method' => $paymentMethod
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price_at_purchase' => $item['price'],
                    'sugar_level' => $item['sugarLevel']
                ]);

                $product = \App\Models\Product::with(['ingredients' => function($q) {
                    $q->withPivot('amount_needed');
                }])->find($item['id']);

                if ($product && $product->ingredients) {
                    foreach ($product->ingredients as $ingredient) {
                        $takaran = $ingredient->pivot->amount_needed ?: 1;
                        $namaBahan = strtolower($ingredient->name);
                        if (str_contains($namaBahan, 'gula') || str_contains($namaBahan, 'sugar')) {
                            $persentaseGula = isset($item['sugarLevel']) ? ((int)$item['sugarLevel'] / 100) : 1;
                            $takaran = $takaran * $persentaseGula;
                        }

                        $totalPotongan = $takaran * $item['qty'];
                        
                        $ingredient->stock = $ingredient->stock - $totalPotongan;
                        $ingredient->save();

                        DB::table('ingredient_histories')->insert([
                            'id'            => \Illuminate\Support\Str::uuid(),
                            'ingredient_id' => $ingredient->id,
                            'amount'        => $totalPotongan,
                            'type'          => 'out',
                            'date'          => today()->toDateString(),
                            'created_at'    => now(),
                            'updated_at'    => now()
                        ]);
                    }
                }
            }

            if ($customerId && $pointsUsed > 0) {
                DB::table('customers')->where('id', $customerId)->decrement('member_points', $pointsUsed);
            }

            if ($customerId) {
                $grandTotal = session('total');
                DB::table('customers')->where('id', $customerId)->increment('total_spend', $grandTotal);
                $customer = DB::table('customers')->where('id', $customerId)->first();
                
                if ($customer) {
                    // SINKRONISASI TIER & PROGRESS BAR BARU
                    $newTier = 'Bronze';
                    if ($customer->total_spend >= 700000) { $newTier = 'Gold'; } 
                    elseif ($customer->total_spend >= 300000) { $newTier = 'Silver'; }

                    $progressPercentage = min(($customer->total_spend / 700000) * 100, 100);
                    $pointsEarned = floor($grandTotal / 100); // Kelipatan Rp 100

                    DB::table('customers')->where('id', $customerId)->update([
                        'tier' => $newTier,
                        'progress_percentage' => round($progressPercentage)
                    ]);

                    if ($pointsEarned > 0) {
                        DB::table('customers')->where('id', $customerId)->increment('member_points', $pointsEarned);
                    }
                }
            }


            DB::commit();
            session()->forget(['cart', 'subtotal', 'tax', 'total', 'order_id', 'customer_id', 'points_used', 'payment_method']);

            return redirect()->route('receipt', $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pos')->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

public function receipt($id)
{
    $order = OrderHistory::with('items.product')
        ->findOrFail($id);

    return view('receipt', compact('order'));
}
    public function checkMember(Request $request)
{
    $customer = DB::table('customers')->where('email', $request->email)->first();

    if ($customer) {
        return response()->json([

            'status' => 'success',

            'data' => $customer

        ]);
    } else {
        return response()->json([

            'status' => 'not_found',

            'message' => 'Member Not Found.'

        ]);

    }
}

}