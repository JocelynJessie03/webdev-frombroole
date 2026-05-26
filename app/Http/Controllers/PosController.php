<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\Notification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    public function index(Request $request)
    {
        // 1. MENGGUNAKAN DB::TABLE: Ambil semua kategori KECUALI 'Uncategorized' untuk daftar tab di POS
        $categories = DB::table('categories')
            ->where('category_name', '!=', 'Uncategorized')
            ->whereNull('deleted_at') // Antisipasi jika kamu menggunakan soft deletes
            ->get();

        // 2. AMBIL ID DARI KATEGORI 'Uncategorized' agar bisa digunakan untuk memblokir produk terkait
        $uncategorizedCategory = DB::table('categories')
            ->where('category_name', 'Uncategorized')
            ->first();
            
        $uncategorizedId = $uncategorizedCategory ? $uncategorizedCategory->id : null;

        // 3. Load relasi dengan pivot table seperti biasa agar Accessor stok dinamis tetap berjalan
        $query = Product::with(['category', 'ingredients' => function($q) {
            $q->withPivot('amount_needed');
        }])->where('pro_delete', false);

        // 4. PROTEKSI: Sembunyikan semua produk yang terikat dengan kategori 'Uncategorized' atau yang category_id nya NULL
        if ($uncategorizedId) {
            $query->where('category_id', '!=', $uncategorizedId)
                  ->whereNotNull('category_id');
        } else {
            $query->whereNotNull('category_id');
        }

        // 5. Filter kategori pilihan kasir jika ada tombol kategori yang diklik
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

           return redirect()->route('checkout.view', $order->id);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
 
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



/*
|--------------------------------------------------------------------------
| REVENUE NOTIFICATION
|--------------------------------------------------------------------------
*/

$todayRevenue =
    OrderHistory::whereDate(
        'created_at',
        today()
    )->sum('total_price');



Notification::create([

    'title' => 'Revenue Updated',

    'message' =>
        "Today's sales reached Rp " .
        number_format(
            $todayRevenue,
            0,
            ',',
            '.'
        ),

    'type' => 'revenue',

]);



/*
|--------------------------------------------------------------------------
| NEW ORDER NOTIFICATION
|--------------------------------------------------------------------------
*/

Notification::create([

    'title' => 'New Order Received',

    'message' =>
        $order->order_id .
        ' successfully created',

    'type' => 'order',

]);



return redirect()
    ->route('receipt', $order->id);
                return redirect()->route('receipt', $order->id);

            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Gagal memproses transaksi tunai: ' . $e->getMessage());
            }
        }

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
        return redirect()->route('pos')
            ->with('error', 'Session Is Expired.');
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

            'payment_method' => $paymentMethod

        ]);



        foreach ($cart as $item)
        {

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $item['id'],

                'quantity' => $item['qty'],

                'price_at_purchase' => $item['price']

            ]);



            $product = \App\Models\Product::with([

                'ingredients' => function($q) {

                    $q->withPivot('amount_needed');

                }

            ])->find($item['id']);



            if ($product && $product->ingredients)
            {

                foreach ($product->ingredients as $ingredient)
                {

                    $takaran =
                        $ingredient->pivot->amount_needed ?: 1;

                    $totalPotongan =
                        $takaran * $item['qty'];



                    $ingredient->stock =
                        $ingredient->stock - $totalPotongan;

                    $ingredient->save();



                    /*
                    |--------------------------------------------------------------------------
                    | LOW STOCK NOTIFICATION
                    |--------------------------------------------------------------------------
                    */

                    if($ingredient->stock <= 5)
                    {

                        Notification::create([

                            'title' => 'Low Ingredient Stock',

                            'message' =>
                                $ingredient->name .
                                ' stock remaining only ' .
                                $ingredient->stock,

                            'type' => 'stock',

                        ]);

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | INGREDIENT HISTORY
                    |--------------------------------------------------------------------------
                    */

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



        /*
        |--------------------------------------------------------------------------
        | MEMBER SYSTEM
        |--------------------------------------------------------------------------
        */

        if ($customerId && $pointsUsed > 0)
        {

            DB::table('customers')
                ->where('id', $customerId)
                ->decrement('member_points', $pointsUsed);

        }



        if ($customerId)
        {

            $grandTotal = session('total');

            DB::table('customers')
                ->where('id', $customerId)
                ->increment('total_spend', $grandTotal);

            $customer = DB::table('customers')
                ->where('id', $customerId)
                ->first();



            if ($customer)
            {

                $newTier = 'Bronze';

                if ($customer->total_spend >= 1000000)
                {
                    $newTier = 'Gold';
                }
                elseif ($customer->total_spend >= 750000)
                {
                    $newTier = 'Silver';
                }



                if ($customer->tier !== $newTier)
                {

                    DB::table('customers')
                        ->where('id', $customerId)
                        ->update([
                            'tier' => $newTier
                        ]);

                }



                $pointsEarned =
                    floor($grandTotal / 10000);



                if ($pointsEarned > 0)
                {

                    DB::table('customers')
                        ->where('id', $customerId)
                        ->increment(
                            'member_points',
                            $pointsEarned
                        );

                }

            }

        }



        /*
        |--------------------------------------------------------------------------
        | REVENUE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        $todayRevenue =
            OrderHistory::whereDate(
                'created_at',
                today()
            )->sum('total_price');



        Notification::create([

            'title' => 'Revenue Updated',

            'message' =>
                "Today's sales reached Rp " .
                number_format(
                    $todayRevenue,
                    0,
                    ',',
                    '.'
                ),

            'type' => 'revenue',

        ]);



        /*
        |--------------------------------------------------------------------------
        | NEW ORDER NOTIFICATION
        |--------------------------------------------------------------------------
        */

        Notification::create([

            'title' => 'New Order Received',

            'message' =>
                $order->order_id .
                ' successfully created',

            'type' => 'order',

        ]);



        DB::commit();



        session()->forget([

            'cart',
            'subtotal',
            'tax',
            'total',
            'order_id',
            'customer_id',
            'points_used',
            'payment_method'

        ]);



        return redirect()
            ->route('receipt', $order->id);

    }
    catch (\Exception $e)
    {

        DB::rollback();

        return redirect()
            ->route('pos')
            ->with(
                'error',
                'Gagal memproses transaksi: ' .
                $e->getMessage()
            );

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
    $customer = DB::table('customers')
        ->where('phone', $request->phone)
        ->first();

    if ($customer)
    {

        return response()->json([

            'status' => 'success',

            'data' => $customer

        ]);

    }
    else
    {

        return response()->json([

            'status' => 'not_found',

            'message' => 'Member Not Found.'

        ]);

    }
}

}

