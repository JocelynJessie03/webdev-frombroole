<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja
     */
    public function index()
    {
        return view('customer.cart');
    }

    /**
     * Ambil member points real-time untuk cart page
     * Cari customer berdasarkan EMAIL, bukan ID (karena users.id ≠ customers.id)
     */
    public function getMemberPoints(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'member_points' => 0], 401);
        }

        // Cari customer berdasarkan EMAIL (bukan ID!)
        $customer = DB::table('customers')->where('email', $user->email)->first();
        if (!$customer) {
            return response()->json(['success' => false, 'member_points' => 0], 404);
        }

        return response()->json([
            'success' => true,
            'member_points' => (int)$customer->member_points
        ]);
    }

    /**
     * Validasi kode kupon diskon dari halaman keranjang
     */
    public function checkout(Request $request)
    {
        // Ambil data user yang sedang login saat ini
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'errors' => ['Please log in to continue.']], 401);
        }

        // FIX: Cari customer berdasarkan EMAIL, bukan ID (karena users.id ≠ customers.id)
        $customer = DB::table('customers')->where('email', $user->email)->first();
        if (!$customer) {
            return response()->json(['success' => false, 'errors' => ['Customer profile not found.']], 404);
        }

        // 1. Validasi awal data payload dari JS
        $validated = $request->validate([
            'items'              => ['required', 'array', 'min:1'],
            'items.*.id'         => ['required', 'integer', 'exists:products,id'],
            'items.*.qty'        => ['required', 'integer', 'min:1'],
            'items.*.price'      => ['required', 'numeric', 'min:0'],
            'items.*.sugarLevel' => ['nullable', 'in:0,50,100'],
            'notes'              => ['nullable', 'string', 'max:500'],
            'promo'              => ['nullable', 'string', 'max:30'],
            'discount'           => ['nullable', 'integer', 'min:0', 'max:100'],
            'points_used'        => ['nullable', 'integer', 'min:0'],
        ]);

        $pointsUsed = intval($validated['points_used'] ?? 0);

        // Validasi poin di database menggunakan data customer yang valid
        if ($pointsUsed > 0 && $pointsUsed > ($customer->member_points ?? 0)) {
            return response()->json(['success' => false, 'errors' => ['Insufficient member points balance.']], 422);
        }

        // 2. Verifikasi ulang stok bahan resep di server
        $errors = [];
        $subtotal = 0;
        $totalItems = 0;
        $item_details = [];

        foreach ($validated['items'] as $lineItem) {
            $product = Product::with(['ingredients' => function ($q) {
                $q->withPivot('amount_needed');
            }])->find($lineItem['id']);

            if (!$product || $product->pro_delete) {
                $errors[] = ($product->pro_name ?? 'A product') . ' is no longer available.';
                continue;
            }

            if ($product->calculated_stock < $lineItem['qty']) {
                $errors[] = 'Only ' . $product->calculated_stock . ' unit(s) of "' . $product->pro_name . '" are available.';
                continue;
            }

            $subtotal += $product->pro_price * $lineItem['qty'];
            $totalItems += $lineItem['qty'];

            $item_details[] = [
                'id'       => $product->id, // Tetap gunakan integer asli murni
                'price'    => (int) $product->pro_price,
                'quantity' => $lineItem['qty'],
                'name'     => substr($product->pro_name, 0, 50),
            ];
        }

        if (!empty($errors)) {
            return response()->json(['success' => false, 'errors' => $errors], 422);
        }

        // 3. Hitung Diskon Kupon, Pajak, dan Grand Total
        $discountAmount = 0;
        if (!empty($validated['promo'])) {
            $coupon = DiscountCoupon::where('code', strtoupper($validated['promo']))->first();
            if ($coupon && $coupon->isAvailable()) {
                $discountAmount = round($subtotal * (intval($validated['discount']) / 100));
                
                $item_details[] = [
                    'id'       => 'COUPON-' . $coupon->code,
                    'price'    => (int) -$discountAmount, // Wajib minus untuk pengurang harga Midtrans
                    'quantity' => 1,
                    'name'     => 'Promo Coupon Discount',
                ];
            }
        }

        $tax = round(($subtotal - $discountAmount) * 0.10);
        $total = $subtotal + $tax - $discountAmount;

        if ($tax > 0) {
            $item_details[] = [
                'id'       => 'TAX-10',
                'price'    => (int) $tax,
                'quantity' => 1,
                'name'     => 'Tax (10%)',
            ];
        }

        // Pengurangan poin (Disisakan Rp 1 jika poin melunasi seluruh isi cart agar Midtrans tidak menolak nominal 0)
        if ($pointsUsed > 0) {
            if ($pointsUsed >= $total) { 
                $pointsUsed = $total - 1; 
            }
            $total -= $pointsUsed;

            $item_details[] = [
                'id'       => 'DISC-POIN',
                'price'    => (int) -$pointsUsed, // FIX: Wajib di-set minus (-) agar disetujui server Midtrans
                'quantity' => 1,
                'name'     => 'Diskon Poin Member',
            ];
        }

        DB::beginTransaction();
        try {
            $countOrder = DB::table('order_histories')->count();
            $invoiceId = 'INV-WEB-' . now()->format('YmdHis') . '-' . str_pad($countOrder + 1, 3, '0', STR_PAD_LEFT);

            // 4. Buat order baru dengan status 'Pending'
            $order = OrderHistory::create([
                'order_id'       => $invoiceId,
                'customer_id'    => $customer->id,
                'order_date'     => now(),
                'total_items'    => $totalItems,
                'total_price'    => $total,
                'status'         => 'Pending',
                'payment_method' => 'Midtrans (Web)'
            ]);

            foreach ($validated['items'] as $lineItem) {
                $product = Product::find($lineItem['id']);
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $product->id,
                    'quantity'          => $lineItem['qty'],
                    'price_at_purchase' => $product->pro_price
                ]);
            }

            session(['web_points_used_' . $order->id => $pointsUsed]);

            // Kredensial Midtrans
            MidtransConfig::$serverKey    = config('midtrans.server_key');
            MidtransConfig::$isProduction = config('midtrans.is_production');
            MidtransConfig::$isSanitized  = true;
            MidtransConfig::$is3ds         = true;

            $transaction = [
                'transaction_details' => [
                    'order_id'     => $invoiceId,
                    'gross_amount' => (int) $total,
                ],
                'item_details' => $item_details,
                // Mengunci tampilan popup langsung memunculkan metode QRIS & Gopay
                'enabled_payments' => [
                    'qris',
                    'gopay'
                ],
                'customer_details' => [
                    'first_name' => $user->name ?? 'Customer Web',
                    'email'      => $user->email ?? 'customer@mail.com',
                ], 
                'enabled_payments' => [
                'qris',
                'gopay',       // Tambahan untuk memicu QRIS di beberapa tipe akun Sandbox
                'shopeepay',   // Tambahan untuk memicu QRIS di beberapa tipe akun Sandbox
                'bank_transfer'
                ]
            ];
            $snapToken = Snap::getSnapToken($transaction);

            DB::commit();

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $order->id,
                'total'      => $total
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'errors' => ['Checkout failed: ' . $e->getMessage()]], 500);
        }
    }

    /**
     * POST-PAYMENT: POTONG RESEP & UPDATE MEMBER TIERS
     */
    public function paymentSuccess($id)
    {
        $order = OrderHistory::with('items.product')->findOrFail($id);

        if ($order->status === 'Paid') {
            return redirect()->route('customer.shop')->with('success', 'Order has already been processed.');
        }

        DB::beginTransaction();
        try {
            $order->status = 'Paid';
            $order->save();

            foreach ($order->items as $item) {
                $product = Product::with(['ingredients' => function($q) {
                    $q->withPivot('amount_needed');
                }])->find($item->product_id);

                if ($product && $product->ingredients) {
                    foreach ($product->ingredients as $ingredient) {
                        $takaran = $ingredient->pivot->amount_needed ?: 1;
                        $totalPotongan = $takaran * $item->quantity;
                        
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

            $customerId = $order->customer_id;
            if ($customerId) {
                $pointsUsed = session()->pull('web_points_used_' . $order->id, 0);

                if ($pointsUsed > 0) {
                    DB::table('customers')->where('id', $customerId)->decrement('member_points', $pointsUsed);
                }
                
                DB::table('customers')->where('id', $customerId)->increment('total_spend', $order->total_price);
                $customer = DB::table('customers')->where('id', $customerId)->first();
                
                if ($customer) {
                    $newTier = 'Bronze';
                    if ($customer->total_spend >= 700000) { $newTier = 'Gold'; } 
                    elseif ($customer->total_spend >= 300000) { $newTier = 'Silver'; }

                    $progressPercentage = min(($customer->total_spend / 700000) * 100, 100);
                    $pointsEarned = floor($order->total_price / 100);

                    DB::table('customers')->where('id', $customerId)->update([
                        'tier'                => $newTier,
                        'progress_percentage' => round($progressPercentage)
                    ]);

                    if ($pointsEarned > 0) {
                        DB::table('customers')->where('id', $customerId)->increment('member_points', $pointsEarned);
                    }
                }
            }

            DB::table('notifications')->insert([
                'title'      => 'New Web Order Paid (Midtrans)',
                'message'    => 'Order ' . $order->order_id . ' has been successfully paid with amount of Rp ' . number_format($order->total_price, 0, ',', '.'),
                'type'       => 'order',
                'is_read'    => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();
            return redirect()->route('customer.shop')->with('success', 'Thank you! Your payment was successful.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('customer.shop')->with('error', 'Failed to finalize transaction: ' . $e->getMessage());
        }
    }

    /**
     * VALIDATE COUPON
     */
    public function validateCoupon(Request $request)
    {
        $code = $request->input('code', '');
        if (!$code) {
            return response()->json(['valid' => false, 'message' => 'Coupon code is required.']);
        }

        $coupon = DiscountCoupon::where('code', strtoupper($code))->where('is_active', true)->first();
        if (!$coupon) {
            return response()->json(['valid' => false, 'message' => 'Invalid coupon code.']);
        }

        if ($coupon->expires_at && now()->isAfter($coupon->expires_at)) {
            return response()->json(['valid' => false, 'message' => 'This coupon has expired.']);
        }

        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return response()->json(['valid' => false, 'message' => 'This coupon has reached its usage limit.']);
        }

        return response()->json([
            'valid' => true,
            'discount_value' => $coupon->discount_value
        ]);
    }
}