<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceiptMail;
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
        $user = Auth::user();
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
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'errors' => ['Please log in to continue.']], 401);
        }

        $customer = DB::table('customers')->where('email', $user->email)->first();
        if (!$customer) {
            return response()->json(['success' => false, 'errors' => ['Customer profile not found.']], 404);
        }

        $validated = $request->validate([
            'items'              => ['required', 'array', 'min:1'],
            'items.*.id'         => ['required', 'integer', 'exists:products,id'],
            'items.*.qty'        => ['required', 'integer', 'min:1'],
            'items.*.price'      => ['required', 'numeric', 'min:0'],
            'items.*.sugarLevel' => ['nullable', 'string'], // Diubah ke string agar fleksibel
            'notes'              => ['nullable', 'string', 'max:500'],
            'promo'              => ['nullable', 'string', 'max:30'],
            'discount'           => ['nullable', 'numeric', 'min:0', 'max:100'],
            'points_used'        => ['nullable', 'numeric', 'min:0'],
        ]);

        $pointsUsed = intval($validated['points_used'] ?? 0);

        if ($pointsUsed > 0 && $pointsUsed > ($customer->member_points ?? 0)) {
            return response()->json(['success' => false, 'errors' => ['Insufficient member points balance.']], 422);
        }

        $errors = [];
        $subtotal = 0;
        $totalItems = 0;

        foreach ($validated['items'] as $lineItem) {
            $product = Product::query()->find($lineItem['id']);

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
        }

        if (!empty($errors)) {
            return response()->json(['success' => false, 'errors' => $errors], 422);
        }

        // Hitung Kupon Diskon
        $discountAmount = 0;
        $couponApplied = null;
        if (!empty($validated['promo'])) {
            $coupon = DiscountCoupon::query()->where('code', strtoupper($validated['promo']))->first();
            if ($coupon && $coupon->isAvailable()) {
                // Cek apakah customer ini sudah pernah pakai kupon ini
                $alreadyUsed = DB::table('coupon_usages')
                    ->where('customer_id', $customer->id)
                    ->where('coupon_id', $coupon->id)
                    ->exists();

                if ($alreadyUsed) {
                    return response()->json(['success' => false, 'errors' => ['You have already used this coupon.']], 422);
                }

                $discountAmount = round($subtotal * (floatval($validated['discount']) / 100));
                $couponApplied = $coupon->code;
            }
        }

        $tax = round(($subtotal - $discountAmount) * 0.10);
        $total = $subtotal + $tax - $discountAmount;

        // Kurangi dengan poin (jika ada)
        if ($pointsUsed > 0) {
            $total -= $pointsUsed;
        }

        // 🚨 PENGAMAN WAJIB MIDTRANS: Total tagihan TIDAK BOLEH 0
        // Midtrans butuh minimal Rp 100 untuk bisa memunculkan popup
        if ($total < 100) {
            // Hitung ulang poin yang benar-benar terpakai agar tidak memotong kelebihan
            $pointsUsed = $pointsUsed - (100 - $total); 
            if ($pointsUsed < 0) {
                $pointsUsed = 0;
            }
            $total = 100; // Paksa bayar minimal Rp 100
        }

        DB::beginTransaction();
        try {
            $countOrder = DB::table('order_histories')->count();
            $invoiceId = 'INV-WEB-' . now()->format('YmdHis') . '-' . str_pad($countOrder + 1, 3, '0', STR_PAD_LEFT);

            $order = OrderHistory::create([
                'order_id'       => $invoiceId,
                'customer_id'    => $customer->id,
                'order_date'     => now(),
                'total_items'    => $totalItems,
                'total_price'    => $total,
                'status'         => 'Pending', // Status order/pengiriman tetap Pending
                'payment_status' => 'UNPAID',  // Status pembayaran UNPAID
                'payment_method' => 'Midtrans (Web)',
                'points_used'    => $pointsUsed,    // <-- SIMPAN KE DB
                'promo_code'     => $couponApplied  // <-- SIMPAN KE DB
            ]);

            foreach ($validated['items'] as $lineItem) {
                $product = Product::query()->find($lineItem['id']);
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $product->id,
                    'quantity'          => $lineItem['qty'],
                    'price_at_purchase' => $product->pro_price,
                    'sugar_level'       => $lineItem['sugarLevel'] ?? null,
                ]);
            }

            $item_details = [[
                'id'       => $invoiceId,
                'price'    => (int) $total,
                'quantity' => 1,
                'name'     => 'From Broole Artisan Order Summary',
            ]];

            MidtransConfig::$serverKey    = config('midtrans.server_key');
            MidtransConfig::$isProduction = config('midtrans.is_production');
            MidtransConfig::$isSanitized  = true;
            MidtransConfig::$is3ds        = true;

            // ==========================================
            // LOGIKA SAKTI: DINAMISASI PAYMENT METHOD
            // ==========================================
            $enabled_payments = [
                'qris',
                'gopay',
                'shopeepay'
            ];

            // Bank Transfer HANYA ditampilkan jika total belanja setelah diskon masih >= Rp 10.000
            if ($total >= 10000) {
                $enabled_payments[] = 'bank_transfer';
            }

            $transaction = [
                'transaction_details' => [
                    'order_id'     => $invoiceId,
                    'gross_amount' => (int) $total,
                ],
                'item_details' => $item_details,
                'customer_details' => [
                    'first_name' => $user->name ?? 'Customer Web',
                    'email'      => $user->email ?? 'customer@mail.com',
                ], 
                'enabled_payments' => $enabled_payments // <-- Array dimasukkan ke sini
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
            // Menambahkan error message $e->getMessage() agar jika gagal lagi, kamu bisa lihat alasannya di fitur Inspect Element > Network
            return response()->json(['success' => false, 'errors' => ['Checkout failed: ' . $e->getMessage()]], 500);
        }
    }

    /**
     * POST-PAYMENT: POTONG RESEP & UPDATE MEMBER TIERS
     * Fallback dari Midtrans onSuccess callback — jalankan jika webhook belum memproses
     */
    public function paymentSuccess($id)
    {
        $order = OrderHistory::with('items')->find($id);

        if (!$order) {
            return redirect()->route('customer.shop')->with('error', 'Order not found.');
        }

        // GUARD: Jika webhook sudah memproses (payment_status = PAID), skip
        if ($order->payment_status === 'PAID') {
            return redirect()->route('customer.shop')->with('success', 'Thank you! Your order is being processed.');
        }

        DB::beginTransaction();
        try {
            // 1. Update status pembayaran
            $order->payment_status = 'PAID';
            $order->save();

            // 2. [PROSES BOM] Potong stok bahan baku berdasarkan resep
            foreach ($order->items as $item) {
                $product = Product::with(['ingredients' => function($q) {
                    $q->withPivot('amount_needed');
                }])->find($item->product_id);

                if ($product && $product->ingredients && $product->ingredients->isNotEmpty()) {
                    foreach ($product->ingredients as $ingredient) {
                        $takaran = $ingredient->pivot->amount_needed ?: 1;

                        // Logika sugar level
                        $namaBahan = strtolower($ingredient->name);
                        if (str_contains($namaBahan, 'gula') || str_contains($namaBahan, 'sugar')) {
                            $persentaseGula = $item->sugar_level ? ((int)$item->sugar_level / 100) : 1;
                            $takaran = $takaran * $persentaseGula;
                        }

                        $totalPotongan = $takaran * $item->quantity;

                        if ($totalPotongan > $ingredient->stock) {
                            $totalPotongan = $ingredient->stock;
                        }

                        $ingredient->stock = max(0, $ingredient->stock - $totalPotongan);
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

            // 3. Proses Poin dan Kupon Customer
            $customerId = $order->customer_id;
            if ($customerId) {
                // A. Potong Poin yang digunakan
                if ($order->points_used > 0) {
                    DB::table('customers')->where('id', $customerId)->decrement('member_points', $order->points_used);
                }

                // B. Proses kupon: increment used_count, catat di coupon_usages, nonaktifkan jika perlu
                if ($order->promo_code) {
                    $coupon = DiscountCoupon::query()->where('code', $order->promo_code)->first();
                    if ($coupon) {
                        $coupon->increment('used_count');

                        // Nonaktifkan jika sudah mencapai batas pemakaian
                        if ($coupon->max_uses !== null && $coupon->used_count >= $coupon->max_uses) {
                            $coupon->update(['is_active' => false]);
                        }

                        // Catat penggunaan per-customer (ignore jika sudah ada)
                        DB::table('coupon_usages')->insertOrIgnore([
                            'customer_id'    => $customerId,
                            'coupon_id'      => $coupon->id,
                            'order_history_id' => $order->id,
                            'created_at'     => now(),
                            'updated_at'     => now()
                        ]);
                    }
                }

                // C. Update total spend & Tier
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

            // 4. Notifikasi Admin
            DB::table('notifications')->insert([
                'title'      => 'New Web Order Paid (Midtrans)',
                'message'    => 'Order ' . $order->order_id . ' has been successfully paid.',
                'type'       => 'order',
                'is_read'    => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 5. Kirim Email Receipt ke Customer
            if ($customer && !empty($customer->email)) {
                try {
                    Mail::to($customer->email)->send(new OrderReceiptMail($order));
                    Log::info('Order receipt email sent to customer', ['email' => $customer->email, 'order_id' => $order->order_id]);
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send order receipt email', ['order_id' => $order->order_id, 'error' => $mailEx->getMessage()]);
                }
            }

            DB::commit();
            Log::info('paymentSuccess processed successfully', ['order_id' => $order->order_id]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('paymentSuccess failed', ['order_id' => $order->order_id, 'error' => $e->getMessage()]);
            return redirect()->route('customer.shop')->with('error', 'Payment processing error: ' . $e->getMessage());
        }

        return redirect()->route('customer.shop')->with('success', 'Thank you! Your order is being processed.');
    }

    /**
     * CANCEL PAYMENT (Midtrans Modal Closed)
     */
    public function paymentCancel($id)
    {
        $order = OrderHistory::find($id);

        if ($order && $order->payment_status === 'UNPAID') {
            // Hapus item pesanan dan order history
            OrderItem::where('order_id', $order->id)->delete();
            $order->delete();

            return response()->json(['success' => true, 'message' => 'Order cancelled successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Order cannot be cancelled.'], 400);
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

        $coupon = DiscountCoupon::query()->where('code', strtoupper($code))->where('is_active', true)->first();
        if (!$coupon) {
            return response()->json(['valid' => false, 'message' => 'Invalid coupon code.']);
        }

        if ($coupon->expires_at && now()->isAfter($coupon->expires_at)) {
            return response()->json(['valid' => false, 'message' => 'This coupon has expired.']);
        }

        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return response()->json(['valid' => false, 'message' => 'This coupon has reached its usage limit.']);
        }

        // Cek apakah customer ini sudah pernah memakai kupon ini
        $user = Auth::user();
        if ($user) {
            $customer = DB::table('customers')->where('email', $user->email)->first();
            if ($customer) {
                $alreadyUsed = DB::table('coupon_usages')
                    ->where('customer_id', $customer->id)
                    ->where('coupon_id', $coupon->id)
                    ->exists();

                if ($alreadyUsed) {
                    return response()->json(['valid' => false, 'message' => 'You have already used this coupon.']);
                }
            }
        }

        return response()->json([
            'valid' => true,
            'discount_value' => $coupon->discount_value
        ]);
    }
}