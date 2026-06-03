# 🧪 Midtrans Payment Integration - Test Scenarios

## Test Environment Setup

### Prerequisites
- ✅ Server running: `php artisan serve --port=8000`
- ✅ Browser: Chrome/Firefox/Safari (latest)
- ✅ Midtrans Keys: Sandbox mode configured
- ✅ Test Account: Active customer account

---

## Scenario 1: Happy Path - QRIS Payment ✅

### Steps
1. Login dengan customer account
2. Navigate ke Shop (`/shop`)
3. Add 2-3 items ke cart
4. Click Cart icon → Go to `/cart`
5. Fill optional order notes
6. Click "Proceed to Checkout"
7. **Expected:** Payment modal pops up

### Verify in Modal
- [ ] Modal backdrop dengan blur effect
- [ ] Header: "Pilih Metode Pembayaran"
- [ ] Total amount displayed correctly
- [ ] QRIS button visible dengan icon
- [ ] BCA VA button visible dengan icon
- [ ] Cancel button visible
- [ ] Smooth fade-in animation

### Complete Payment
1. Click "Bayar dengan QRIS" button
2. Midtrans payment page opens
3. Select "QRIS" sebagai payment method
4. Use sandbox card: `4111 1111 1111 1111`
5. Fill form dengan OTP/2FA
6. Click "Bayar" / "Confirm"

### Expected Results
- [ ] Payment success page shown
- [ ] Browser console shows `[SUCCESS]` log
- [ ] localStorage cleared (customer_cart removed)
- [ ] Toast message: "Pembayaran berhasil! Terima kasih."
- [ ] Auto-redirect to shop (`/shop`)
- [ ] Cart page empty
- [ ] Order appears di Admin dashboard

### Database Verification
- [ ] OrderHistory created dengan status "Pending"
- [ ] OrderItems inserted untuk each cart item
- [ ] Customer.member_points increased
- [ ] Customer.total_spend updated
- [ ] Customer.tier updated (if applicable)

---

## Scenario 2: BCA Virtual Account Payment ✅

### Steps
1. Login dengan customer account
2. Add items ke cart
3. Go to checkout (same as Scenario 1)
4. Click "Transfer BCA Virtual Account" button

### Verify Modal Behavior
- [ ] Button hover effect works (color change)
- [ ] Button click triggers Midtrans payment

### Complete Payment
1. Midtrans shows BCA VA details
2. Virtual account number generated
3. User selects payment method
4. Use sandbox card untuk complete transaction

### Expected Results
- [ ] Payment success/pending based on card used
- [ ] Appropriate console logs
- [ ] Cart cleared (if success)
- [ ] Order created dengan correct details

---

## Scenario 3: Modal Close Button ✅

### Steps
1. Proceed to checkout
2. Payment modal appears
3. Click "Batal" button

### Expected Results
- [ ] Modal closes smoothly (fade-out animation)
- [ ] Page returns to normal cart view
- [ ] "Proceed to Checkout" button re-enabled
- [ ] Cart items still visible
- [ ] NO order created
- [ ] localStorage still has cart items

---

## Scenario 4: Modal Backdrop Click ✅

### Steps
1. Show payment modal
2. Click on backdrop (semi-transparent area)

### Expected Results
- [ ] Modal closes
- [ ] Same behavior sebagai Scenario 3
- [ ] Checkout button re-enabled

---

## Scenario 5: Payment Pending Status ⏳

### Steps
1. Proceed to checkout
2. Click payment method button
3. Use sandbox card: `4111 1111 1111 1112`
4. Complete payment flow

### Expected Results
- [ ] Midtrans shows "pending" status
- [ ] Console shows `[PENDING]` log
- [ ] Toast message: "Pembayaran pending..."
- [ ] Order created dengan status "Pending"
- [ ] Modal closes
- [ ] Cart cleared

---

## Scenario 6: Payment Failed ❌

### Steps
1. Proceed to checkout
2. Click payment method
3. Use sandbox card: `4111 1111 1111 1113`
4. Complete payment attempt

### Expected Results
- [ ] Midtrans shows error message
- [ ] Console shows `[ERROR]` log
- [ ] Toast message: "Pembayaran gagal. Silakan coba lagi."
- [ ] Modal closes
- [ ] "Proceed to Checkout" button re-enabled
- [ ] Cart items preserved
- [ ] NO order created
- [ ] localStorage still has items

---

## Scenario 7: Multiple Items with Different Prices 💰

### Steps
1. Add items dengan berbeda prices:
   - Item A: Rp 50,000 (qty 2)
   - Item B: Rp 75,000 (qty 1)
   - Item C: Rp 30,000 (qty 3)
2. Apply promo code (if available)
3. Use member points (if available)
4. Proceed to checkout

### Verify Calculation
- [ ] Subtotal = (50k × 2) + (75k × 1) + (30k × 3) = Rp 220,000
- [ ] Tax = 10% = Rp 22,000
- [ ] Total before discount = Rp 242,000
- [ ] Discount applied correctly (jika ada)
- [ ] Points deducted correctly (jika digunakan)
- [ ] Final total accurate
- [ ] Midtrans receives correct amount

### Database Verification
- [ ] OrderHistory.total_price = final amount
- [ ] OrderItem entries untuk each product dengan correct qty & price
- [ ] Points earned = floor(final_amount / 100)

---

## Scenario 8: Promo Code Discount 🎉

### Steps
1. Add items ke cart
2. In cart view: Input valid promo code
3. Verify discount applied
4. Proceed to checkout

### Expected Results
- [ ] Discount percentage shown
- [ ] Subtotal reduced by discount amount
- [ ] Final total calculated correctly
- [ ] Midtrans transaction includes discount line item
- [ ] OrderHistory.total_price reflects discount

---

## Scenario 9: Member Points Usage 🏆

### Steps
1. Add items (Total: Rp 100,000)
2. In cart: Enter points ke gunakan (e.g., 5,000 points = Rp 5,000)
3. Verify new total
4. Proceed to checkout

### Expected Results
- [ ] Available points displayed
- [ ] Can't use lebih dari available points
- [ ] Total reduced by points amount
- [ ] Midtrans receives: Rp 100,000 - Rp 5,000 = Rp 95,000
- [ ] After payment: customer.member_points decreased by 5,000

---

## Scenario 10: Mobile Responsiveness 📱

### Setup
1. Use Chrome DevTools responsive mode atau real mobile device
2. Set viewport ke mobile size (375px width - iPhone SE)

### Steps
1. Navigate to cart page
2. Add items
3. Proceed to checkout

### Verify Mobile UX
- [ ] Modal responsive pada mobile screen
- [ ] Buttons stack vertically
- [ ] Text readable (min 16px font)
- [ ] Touch targets min 44x44px
- [ ] Scrollable content jika overflow
- [ ] No horizontal scroll
- [ ] Payment method buttons full-width

---

## Scenario 11: Inventory Deduction ✅

### Pre-Check
- Check ingredient inventory di admin

### Steps
1. Order dengan item yang butuh ingredients
   - Item A perlu: Sugar (10ml), Coffee (2g)
   - Qty ordered: 2
2. Complete payment successfully
3. Check admin inventory

### Expected Results
- [ ] Ingredient quantities decreased
- [ ] Deduction = (amount_needed × qty) untuk each ingredient
- [ ] IngredientHistory logged untuk tracking
- [ ] Accuracy maintained

---

## Scenario 12: Order History Logging 📝

### Steps
1. Complete successful checkout
2. Check database OrderHistory table

### Verify Data
- [ ] order_id = INV-WEB-YYYYMMDDHHmmss-###
- [ ] customer_id correct (from customers table via email)
- [ ] order_date = now()
- [ ] total_items = sum of quantities
- [ ] total_price = final calculated price
- [ ] status = 'Pending'
- [ ] payment_method = 'Web Checkout'
- [ ] created_at & updated_at timestamps correct

---

## Scenario 13: Customer Tier Update 📊

### Setup
- Customer current tier: Bronze
- Customer total_spend: Rp 200,000
- Silver threshold: Rp 300,000
- Gold threshold: Rp 700,000

### Steps
1. Order dengan total: Rp 120,000
2. Complete payment
3. Check customer record

### Expected Results
- [ ] total_spend = Rp 200,000 + Rp 120,000 = Rp 320,000
- [ ] Tier updated to Silver
- [ ] progress_percentage calculated towards Gold

### Alternative Test
Order amounts that trigger tier changes dan verify each step.

---

## Scenario 14: Real-time Member Points Display 🔄

### Steps
1. Open cart page
2. Member points shown on page
3. Open another browser/tab dengan same user
4. Change points di admin (or via another transaction)
5. Back to first tab - verify points update

### Expected Results
- [ ] fetchMemberPointsRealTime() called on page load
- [ ] Points match database value
- [ ] API endpoint returns correct points

---

## Scenario 15: Double-Click Prevention ⏱️

### Steps
1. Proceed to checkout
2. Quickly double-click "Proceed to Checkout" button

### Expected Results
- [ ] Only one checkout request sent
- [ ] Button disabled after first click
- [ ] Loading spinner shown
- [ ] Single order created (not duplicates)

---

## Scenario 16: Browser Back Button 🔙

### Steps
1. Complete payment successfully
2. See success message
3. Click browser back button

### Expected Results
- [ ] Page history preserved
- [ ] Cart page shown (empty)
- [ ] No error messages
- [ ] Can navigate normally

---

## Scenario 17: Session Timeout ⏰

### Steps
1. Start checkout process
2. Wait untuk session timeout (default 120 mins)
3. Try to continue checkout

### Expected Results
- [ ] Redirected to login
- [ ] No error or data corruption
- [ ] Cart items preserved (localStorage)
- [ ] Can login again dan continue

---

## Scenario 18: Concurrent Checkouts 🔀

### Setup
- Open 2 browser windows/tabs dengan same user

### Steps
1. Add different items di Window 1
2. Add different items di Window 2
3. Checkout di Window 1
4. Complete payment
5. Checkout di Window 2

### Expected Results
- [ ] Window 1 creates order dengan Window 1 items
- [ ] Window 2 checkout uses Window 2 items
- [ ] No data mixing/conflict
- [ ] Both orders created separately
- [ ] localStorage handles correctly

---

## Scenario 19: Network Failure During Checkout 🌐

### Steps (Using Chrome DevTools)
1. Set Network throttling: "Offline"
2. Proceed to checkout
3. Observe error

### Expected Results
- [ ] Checkout fails gracefully
- [ ] Error banner shown: "Network error..."
- [ ] Button re-enabled untuk retry
- [ ] NO partial order created

---

## Scenario 20: Insufficient Points Error ❌

### Setup
- Customer available points: Rp 5,000
- Order total: Rp 100,000

### Steps
1. In cart: Try to use Rp 10,000 points
2. Try to checkout

### Expected Results
- [ ] Client validation prevents using too many points
- [ ] Server validation catches any bypass attempts
- [ ] Error message: "Invalid points amount..."
- [ ] Checkout fails safely

---

## Performance Testing ⚡

### Scenario 21: Page Load Time
- [ ] Cart page loads dalam < 2 seconds
- [ ] Midtrans script loads dalam < 1 second
- [ ] Modal appears instantly (< 100ms after modal fn called)

### Scenario 22: Network Latency
- [ ] Test di Slow 3G network (DevTools)
- [ ] Checkout completes without timeout
- [ ] No visual glitches atau UI bugs

---

## Browser Compatibility ✓

Test di:
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Chrome (Android)
- [ ] Mobile Safari (iOS)

### Verify
- [ ] All features work correctly
- [ ] Animations smooth
- [ ] No console errors
- [ ] Styling correct

---

## Accessibility Testing ♿

### Keyboard Navigation
- [ ] Tab through modal elements
- [ ] Enter key triggers button actions
- [ ] Escape key closes modal
- [ ] Focus visible on buttons

### Screen Reader
- [ ] Modal title announced
- [ ] Button labels readable
- [ ] Instructions clear
- [ ] Error messages announced

---

## Test Data Cleanup 🧹

After testing:
```bash
# Delete test orders from database
DELETE FROM order_histories WHERE created_at >= DATE('today');
DELETE FROM order_items WHERE created_at >= DATE('today');

# Reset test customer data
UPDATE customers SET member_points = <original> WHERE email = 'test@example.com';
UPDATE customers SET total_spend = <original> WHERE email = 'test@example.com';

# Clear application cache
php artisan cache:clear
```

---

## Checklist Summary

- [ ] All 20+ scenarios tested
- [ ] No console errors
- [ ] No database issues
- [ ] Payment flow working
- [ ] Modal UI beautiful
- [ ] Mobile responsive
- [ ] Accessibility good
- [ ] Performance acceptable
- [ ] Browser compatibility verified
- [ ] Data integrity maintained

---

## Issues Found & Fixes

### Issue #1
**Description:** ...
**Steps to Reproduce:** ...
**Expected:** ...
**Actual:** ...
**Fix:** ...
**Status:** ✅ Fixed / ⏳ Pending

---

## Sign-off

- Tested by: _______
- Date: _______
- Status: ✅ PASS / ❌ NEEDS FIXES

---

**Note:** Keep this document updated as you test and make changes.
