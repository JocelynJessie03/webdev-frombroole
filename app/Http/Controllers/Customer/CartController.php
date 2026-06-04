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
        $user = auth()->user();
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
            $product = Product::find($lineItem['id']);

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
            $coupon = DiscountCoupon::where('code', strtoupper($validated['promo']))->first();
            if ($coupon && $coupon->isAvailable()) {
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
                'status'         => 'Pending',
                'payment_method' => 'Midtrans (Web)'
            ]);

            foreach ($validated['items'] as $lineItem) {
                $product = Product::find($lineItem['id']);
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $product->id,
                    'quantity'          => $lineItem['qty'],
                    'price_at_purchase' => $product->pro_price,
                    'sugar_level'       => $lineItem['sugarLevel'] ?? null,
                ]);
            }

            session(['web_points_used_' . $order->id => $pointsUsed]);
            if ($couponApplied) {
                session(['web_promo_used_' . $order->id => $couponApplied]);
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

            // [PROSES BOM] Potong stok bahan baku resep otomatis (Kode bawaan kamu sudah benar)
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
                // 1. Tarik dan hapus data poin lama yang digunakan
                $pointsUsed = session()->pull('web_points_used_' . $order->id, 0);
                if ($pointsUsed > 0) {
                    DB::table('customers')->where('id', $customerId)->decrement('member_points', $pointsUsed);
                }

                // 2. [BARU] Tarik kupon yang digunakan lalu tambahkan hits pemakaiannya (+1)
                $promoUsed = session()->pull('web_promo_used_' . $order->id);
                if ($promoUsed) {
                    $coupon = DiscountCoupon::where('code', $promoUsed)->first();
                    if ($coupon) {
                        $coupon->increment('used_count'); // Jatah kupon otomatis berkurang!
                    }
                }
                
                // 3. Update data pengeluaran customer
                DB::table('customers')->where('id', $customerId)->increment('total_spend', $order->total_price);
                $customer = DB::table('customers')->where('id', $customerId)->first();
                
                if ($customer) {
                    // Update tingkatan Tier member
                    $newTier = 'Bronze';
                    if ($customer->total_spend >= 700000) { $newTier = 'Gold'; } 
                    elseif ($customer->total_spend >= 300000) { $newTier = 'Silver'; }

                    $progressPercentage = min(($customer->total_spend / 700000) * 100, 100);
                    
                    // HITUNG BONUS POIN BARU (Harga Akhir dibagi 100)
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

            // Kirim Notifikasi Admin (Kode bawaan kamu)
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