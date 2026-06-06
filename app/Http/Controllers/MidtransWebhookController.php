<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\DiscountCoupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handleNotification(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];
        $signatureKey = $payload['signature_key'] ?? null;

        Log::info('Midtrans webhook received', ['order_id' => $orderId, 'status' => $transactionStatus]);

        // Verify Midtrans signature
        $serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production', false);
        
        if ($signatureKey && $serverKey && $isProduction) {
            // Midtrans signature format: sha512(order_id + status_code + gross_amount + server_key)
            $expectedSignature = hash('sha512',
                $orderId .
                ($payload['status_code'] ?? '') .
                ($payload['gross_amount'] ?? '') .
                $serverKey
            );

            if ($signatureKey !== $expectedSignature) {
                Log::warning('Midtrans signature mismatch', [
                    'expected' => $expectedSignature,
                    'received' => $signatureKey,
                    'order_id' => $orderId,
                    'status_code' => $payload['status_code'] ?? null,
                    'gross_amount' => $payload['gross_amount'] ?? null
                ]);
                return response()->json(['message' => 'Invalid signature'], 403);
            }
        } elseif ($signatureKey && !$isProduction) {
            Log::info('Midtrans webhook signature skipped (development mode)', ['order_id' => $orderId]);
        }

        // If no signature key in development, proceed anyway
        if (!$signatureKey && $isProduction) {
            Log::warning('Midtrans webhook missing signature in production', ['order_id' => $orderId]);
            return response()->json(['message' => 'Signature key missing'], 403);
        }

        // In development without signature, still process
        if (!$signatureKey && !$isProduction) {
            Log::info('Processing webhook without signature (development)', ['order_id' => $orderId]);
        }

        $order = OrderHistory::with('items')->where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Jika transaksi berhasil (settlement/capture = sukses di Midtrans)
        // handle 'paid' status for older Midtrans API versions
        if (in_array($transactionStatus, ['settlement', 'capture', 'paid'])) {
            
            // Cegah double eksekusi jika webhook terpanggil 2 kali
            if ($order->payment_status === 'PAID') {
                return response()->json(['message' => 'Already processed'], 200);
            }

            DB::beginTransaction();
            try {
                // 1. Update status pembayaran
                $order->payment_status = 'PAID';
                // (Catatan: $order->status tetap 'Pending' untuk admin)
                $order->save();

                // 2. [PROSES BOM] Potong stok bahan baku
                foreach ($order->items as $item) {
                    $product = Product::with(['ingredients' => function($q) {
                        $q->withPivot('amount_needed');
                    }])->find($item->product_id);

                    if ($product && $product->ingredients && $product->ingredients->isNotEmpty()) {
                        foreach ($product->ingredients as $ingredient) {
                            $takaran = $ingredient->pivot->amount_needed ?: 1;
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
                    // A. Potong Poin yang digunakan (Ambil dari DB, bukan Session)
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

                            // Catat penggunaan per-customer (ignore jika sudah ada dari paymentSuccess)
                            DB::table('coupon_usages')->insertOrIgnore([
                                'customer_id'      => $customerId,
                                'coupon_id'        => $coupon->id,
                                'order_history_id' => $order->id,
                                'created_at'       => now(),
                                'updated_at'       => now()
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

                DB::commit();
                return response()->json(['message' => 'Success'], 200);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => 'Error processing webhook: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'Ignored transaction status'], 200);
    }
}