# Midtrans Payment Integration - Complete Setup

## Overview
Integrasi Midtrans Snap Payment Gateway untuk direct payment modal di cart page tanpa redirect halaman baru.

## Features
✅ Payment modal popup langsung setelah checkout  
✅ Multiple payment methods: QRIS + BCA Virtual Account  
✅ Real-time Snap.pay() integration  
✅ Beautiful modal UI dengan design matching app  
✅ Payment success/pending/error handling  
✅ Order auto-complete dengan clear cart setelah sukses  

## Architecture

### 1. Backend Flow (CartController.php)
```
POST /checkout
  ↓
[Validasi & Create OrderHistory]
  ↓
[Setup Midtrans Config dari .env]
  ↓
[Prepare Transaction Data]
  ↓
[Generate Snap Token via Midtrans\Snap::getSnapToken()]
  ↓
Return JSON: {snap_token, order_id, total}
```

### 2. Frontend Flow (cart.blade.php)
```
Click "Proceed to Checkout"
  ↓
POST checkout endpoint
  ↓
showPaymentModal(snapToken)
  ↓
User select QRIS or BCA VA
  ↓
triggerMidtransPayment(snapToken, method)
  ↓
window.snap.pay() display payment
  ↓
[On Success] Clear cart → Redirect shop
[On Error] Show error banner → Allow retry
```

### 3. Key Files Modified

#### app/Http/Controllers/Customer/CartController.php
**Changes:**
- Added Midtrans imports: `use Midtrans\Config as MidtransConfig; use Midtrans\Snap;`
- Modified `checkout()` method to return JSON snap token instead of redirect
- Setup Midtrans config with server_key, is_production from .env
- Create transaction array with item_details, customer_details, enabled_payments
- Generate snapToken using `Snap::getSnapToken($transaction)`

**Key Code:**
```php
// Setup Midtrans
MidtransConfig::$serverKey = config('midtrans.server_key');
MidtransConfig::$isProduction = config('midtrans.is_production');
MidtransConfig::$isSanitized = true;
MidtransConfig::$is3ds = true;

$transaction = [
    'transaction_details' => ['order_id' => $orderId, 'gross_amount' => $total],
    'item_details' => $item_details,
    'customer_details' => ['first_name' => $customer->customer_name, 'email' => $customer->email],
    'enabled_payments' => ['qris', 'bca_va'],
];

$snapToken = Snap::getSnapToken($transaction);

return response()->json([
    'success' => true,
    'snap_token' => $snapToken,
    'order_id' => $orderId,
    'total' => $total
]);
```

#### resources/views/customer/cart.blade.php
**Changes:**
- Modified `proceedCheckout()` to show payment modal instead of redirect
- Added `showPaymentModal(snapToken, orderId, total)` function with beautiful UI
- Added `triggerMidtransPayment(snapToken, paymentMethod)` untuk payment execution
- Added `closePaymentModal()` untuk close modal
- Added CSS animations: `@keyframes fadeIn` dan `@keyframes slideUp`
- Payment method buttons dengan QRIS + BCA VA icons

**Key Code:**
```js
window.proceedCheckout = async function () {
    // ... existing code ...
    if (res.ok && data.success) {
        showPaymentModal(data.snap_token, data.order_id, data.total);
    }
};

window.triggerMidtransPayment = function (snapToken, paymentMethod) {
    const snapConfig = {
        onSuccess: handleSuccess,
        onPending: handlePending,
        onError: handleError,
        onClose: handleClose,
    };
    snap.pay(snapToken, snapConfig);
};
```

#### resources/views/layouts/app.blade.php
**Changes:**
- Added Midtrans Snap script di HEAD section
- Dynamic load dari production atau sandbox based on config
- Auto-inject client key dari .env

**Key Code:**
```blade
@if(config('midtrans.is_production'))
    <script src="https://app.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
@else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
@endif
```

## Configuration

### .env Variables (Already Set)
```env
MIDTRANS_SERVER_KEY=Mid-server-FDgIi2KvnZkTNj1UJgt6Nnpj
MIDTRANS_CLIENT_KEY=Mid-client-XJ2FoJzI5GFVK8jg
MIDTRANS_IS_PRODUCTION=false
```

### config/midtrans.php (Already Configured)
```php
return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
];
```

## Database Integration
Orders created dalam OrderHistory table sebelum Midtrans payment modal ditampilkan:
- order_id: INV-WEB-YYYYMMDDHHmmss-###
- customer_id: from customers table (linked by email)
- status: 'Pending' sampai pembayaran berhasil
- total_price: calculated dari subtotal + tax - discount - points_used

## Payment Methods

### QRIS
- Scan QR code dengan smartphone
- Mendukung semua bank dengan QRIS
- Instant settlement

### BCA Virtual Account
- Generate unique VA number per transaction
- Payment via BCA desktop/mobile banking
- Transfer timeout typically 24 hours

## Testing

### 1. Test di Sandbox Mode
```env
MIDTRANS_IS_PRODUCTION=false
```

### 2. Flow Test
1. Add items ke cart
2. Click "Proceed to Checkout"
3. Modal muncul dengan "Pilih Metode Pembayaran"
4. Klik QRIS atau BCA VA button
5. Midtrans payment page muncul
6. Test dengan credentials Midtrans sandbox

### 3. Test Cards (Sandbox)
- Success: 4111 1111 1111 1111
- Pending: 4111 1111 1111 1112
- Deny: 4111 1111 1111 1113

## Error Handling

### Common Issues & Solutions

**Issue:** Modal tidak muncul setelah checkout
- Check: Midtrans snap.js loaded di browser console
- Check: snap_token returned dari /checkout endpoint
- Check: Console errors dalam browser dev tools

**Issue:** Payment gagal dengan error "Midtrans library tidak siap"
- Ensure: Midtrans script loaded sebelum cart.blade.php script
- Solution: Scripts di app.blade.php di-load terlebih dahulu

**Issue:** Snap token tidak valid
- Check: Server key dan Client key di .env benar
- Check: is_production match dengan endpoint (sandbox vs production)

## Production Deployment

### Steps untuk go live:
1. Dapatkan production keys dari Midtrans dashboard
2. Update .env:
   ```env
   MIDTRANS_SERVER_KEY=your-production-server-key
   MIDTRANS_CLIENT_KEY=your-production-client-key
   MIDTRANS_IS_PRODUCTION=true
   ```
3. Clear cache: `php artisan config:clear && php artisan cache:clear`
4. Test checkout flow dengan production keys

## Related Files & Routes

**Routes:**
- GET `/cart` - Show cart page (CartController@index)
- GET `/cart/member-points` - Get real-time member points
- POST `/checkout` - Process checkout & generate snap token

**Models:**
- `App\Models\OrderHistory` - Store order data
- `App\Models\OrderItem` - Store order items
- `App\Models\Product` - Product details

**API Endpoints:**
- POST `/checkout` - Returns JSON dengan snap_token
- GET `/cart/member-points` - Returns member_points

## UI Components

### Payment Modal Features
- Beautiful backdrop dengan blur effect
- Smooth animations (fadeIn, slideUp)
- Two payment method buttons dengan icons
- Cancel button untuk close modal
- Responsive design (mobile-friendly)

### Payment Button Styling
- QRIS button dengan QR icon
- BCA VA button dengan bank card icon
- Hover effects dengan color change & slide
- Disabled state saat processing

## Monitoring & Logging

Payment flow logs tersimpan di:
- Browser Console: `[SUCCESS]`, `[PENDING]`, `[ERROR]`, `[INFO]`
- Server logs: `storage/logs/laravel.log`

Contoh console logs:
```
[SUCCESS] Payment completed: {transaction_id, order_id, status}
[PENDING] Waiting for payment confirmation: {transaction_id}
[ERROR] Payment failed: {error_message}
[INFO] Payment modal closed by user
```

## Next Steps / Future Enhancements

1. **Payment Status Webhook**
   - Implement notification endpoint untuk real-time payment status update
   - Auto-update OrderHistory status saat payment berhasil

2. **Invoice Email**
   - Send invoice email ke customer setelah payment sukses
   - Include payment details & order summary

3. **Payment History Page**
   - Create page untuk customer lihat riwayat pembayaran
   - Show transaction status, amount, date

4. **Discount/Promo Integration**
   - Improve promo code validation
   - Add automatic discount application

5. **Multiple Currency Support**
   - If expanding internationally
   - Currency conversion via Midtrans

## References
- Midtrans Documentation: https://docs.midtrans.com
- Midtrans Snap API: https://docs.midtrans.com/reference/snap-api
- Payment Methods: https://docs.midtrans.com/reference/payment-methods
