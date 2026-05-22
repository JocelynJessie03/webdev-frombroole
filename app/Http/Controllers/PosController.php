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

        $query = Product::with('category');

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

    public function checkoutView($id)
{
    $order = OrderHistory::with('items.product')
        ->findOrFail($id);

    return view('checkout', compact('order'));
}
public function checkoutPreview(Request $request)
{
    $cart = json_decode($request->cart, true);

    return view('checkout_preview', compact('cart'));
}
public function processPayment(Request $request)
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $cart = json_decode($request->cart, true);

    $subtotal = 0;
    $totalItems = 0;

    foreach ($cart as $item) {

        $subtotal += $item['price'] * $item['qty'];

        $totalItems += $item['qty'];
    }

    $tax = $subtotal * 0.10;

    $total = $subtotal + $tax;

    $transaction = [
        'transaction_details' => [
            'order_id' => 'INV-' . now()->format('YmdHis'),
            'gross_amount' => $total,
        ],
    ];

    $snapToken = Snap::getSnapToken($transaction);

    session([
        'cart' => $cart,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $total,
        'order_id' => $transaction['transaction_details']['order_id']
    ]);

    return view('payment', compact('snapToken'));
}
public function paymentSuccess()
{
    $cart = session('cart');

    $order = OrderHistory::create([
        'order_id' => session('order_id'),
        'customer_id' => 1,
        'order_date' => now(),
        'total_items' => count($cart),
        'total_price' => session('total'),
        'status' => 'Paid'
    ]);

    foreach ($cart as $item) {

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['qty'],
            'price_at_purchase' => $item['price']
        ]);
    }

    return redirect()->route('receipt', $order->id);
}
public function receipt($id)
{
    $order = OrderHistory::with('items.product')
        ->findOrFail($id);

    return view('receipt', compact('order'));
}
    
}