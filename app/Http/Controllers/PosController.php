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
    $categories = Category::all();

    // Pastikan meload relasi dengan pivot table amount_needed agar Accessor di Model bisa menghitungnya
    $query = Product::with(['category', 'ingredients' => function($q) {
        $q->withPivot('amount_needed');
    }])->where('pro_delete', false);

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->latest()->get();

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
                'customer_id' => 1,
                'order_date' => now(),
                'total_items' => $totalItems,
                'total_price' => $total,
                'status' => 'Complete'
            ]);

            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
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

//     public function checkoutView($id)
// {
//     $order = OrderHistory::with('items.product')
//         ->findOrFail($id);

//     return view('checkout', compact('order'));
// }
 
public function checkoutPreview(Request $request)
{
    $cart = json_decode($request->cart, true);

    return view('checkout_preview', compact('cart'));
}
public function processPayment(Request $request)
{
    $cart = json_decode($request->cart, true);
    $customerId = $request->customer_id;
    $pointsUsed = $request->points_used ? (int) $request->points_used : 0;
    
    // TANGKAP METODE PEMBAYARAN DARI PREVIEW FORM ('cash' atau 'midtrans')
    $paymentMethod = $request->payment_method; 

    $subtotal = 0;
    $totalItems = 0;
    $item_details = [];

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['qty'];
        $totalItems += $item['qty'];

        $item_details[] = [
            'id' => $item['id'],
            'price' => $item['price'],
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

    if ($pointsUsed > 0) {
        if ($pointsUsed > $total) {
            $pointsUsed = $total;
        }
        $total -= $pointsUsed;

        $item_details[] = [
            'id' => 'DISC-POIN',
            'price' => -$pointsUsed,
            'quantity' => 1,
            'name' => 'Diskon Poin Member',
        ];
    }

    $orderId = 'INV-' . now()->format('YmdHis');

    // ==========================================
    // JIKA KASIR MEMILIH METODE: CASH (TUNAI)
    // ==========================================
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

            // 2. Simpan Item & Potong Stok Bahan Baku
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price_at_purchase' => $item['price']
                ]);

                $product = \App\Models\Product::with(['ingredients' => function($q) {
                    $q->withPivot('amount_needed');
                }])->find($item['id']);

                if ($product && $product->ingredients) {
                    foreach ($product->ingredients as $ingredient) {
                        $takaran = $ingredient->pivot->amount_needed ?: 1;
                        $totalPotongan = $takaran * $item['qty'];
                        
                        $ingredient->stock = $ingredient->stock - $totalPotongan;
                        $ingredient->save();

                        DB::table('ingredient_histories')->insert([
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

            // 3. Potong Poin & Update Loyalty Member (Jika Ada)
            if ($customerId) {
                if ($pointsUsed > 0) {
                    DB::table('customers')->where('id', $customerId)->decrement('member_points', $pointsUsed);
                }
                
                DB::table('customers')->where('id', $customerId)->increment('total_spend', $total);
                $customer = DB::table('customers')->where('id', $customerId)->first();
                
                if ($customer) {
                    $newTier = 'Bronze';
                    if ($customer->total_spend >= 1000000) { $newTier = 'Gold'; } 
                    elseif ($customer->total_spend >= 750000) { $newTier = 'Silver'; }

                    if ($customer->tier !== $newTier) {
                        DB::table('customers')->where('id', $customerId)->update(['tier' => $newTier]);
                    }
                    
                    $pointsEarned = floor($total / 10000); 
                    if ($pointsEarned > 0) {
                        DB::table('customers')->where('id', $customerId)->increment('member_points', $pointsEarned);
                    }
                }
            }

            DB::commit();
            return redirect()->route('receipt', $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses transaksi tunai: ' . $e->getMessage());
        }
    }

    // ==========================================
    // JIKA KASIR MEMILIH METODE: MIDTRANS
    // ==========================================
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
        // BATASI METODE PEMBAYARAN HANYA QRIS DAN GOPAY
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
        'payment_method' => 'QRIS/GoPay' // Simpan info untuk halaman success nanti
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
            'status' => 'Complete',
            'payment_method' => $paymentMethod // Simpan nama payment method-nya
        ]);

        // ... [Sisa kode potong stok dan poin member di bawahnya tetap biarkan sama persis seperti kode lamamu] ...
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price_at_purchase' => $item['price']
            ]);

            $product = \App\Models\Product::with(['ingredients' => function($q) {
                $q->withPivot('amount_needed');
            }])->find($item['id']);

            if ($product && $product->ingredients) {
                foreach ($product->ingredients as $ingredient) {
                    $takaran = $ingredient->pivot->amount_needed ?: 1;
                    $totalPotongan = $takaran * $item['qty'];
                    
                    $ingredient->stock = $ingredient->stock - $totalPotongan;
                    $ingredient->save();

                    DB::table('ingredient_histories')->insert([
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
                $newTier = 'Bronze';
                if ($customer->total_spend >= 1000000) { $newTier = 'Gold'; } 
                elseif ($customer->total_spend >= 750000) { $newTier = 'Silver'; }

                if ($customer->tier !== $newTier) {
                    DB::table('customers')->where('id', $customerId)->update(['tier' => $newTier]);
                }
                
                $pointsEarned = floor($grandTotal / 10000); 
                if ($pointsEarned > 0) {
                    DB::table('customers')->where('id', $customerId)->increment('member_points', $pointsEarned);
                }
            }
        }
        // ... [Akhir dari kode potong stok lamamu] ...

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
    $customer = DB::table('customers')->where('phone', $request->phone)->first();

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