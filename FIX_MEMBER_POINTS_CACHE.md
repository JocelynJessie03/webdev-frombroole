# 🔧 FIX: Member Points Cache Issue - Data Tercampur Antar User

## 📌 Masalah yang Terjadi

**Gejala:**
- User Siti (customer ID 2) memiliki 3730 points
- User Budi Santoso (customer ID 1) memiliki 5470 points di database
- Saat Siti logout dan Budi login → cart page menampilkan **3730 Pts** (dari Siti!)

**Root Cause:**
```
Siti membuka cart → localStorage berisi data Siti
        ↓
    Siti logout (localStorage TIDAK di-clear)
        ↓
    Budi login
        ↓
    Budi buka cart → JavaScript membaca localStorage lama (3730 dari Siti)
        ↓
    HASIL: Data user yang berbeda tercampur!
```

---

## ✅ Solusi yang Diterapkan

### 1️⃣ **Clear localStorage saat Logout**

**File:** `resources/views/layouts/app.blade.php` & `resources/views/customer/layout.blade.php`

```blade
{{-- Tambahkan onsubmit handler ke logout form --}}
<form method="POST" action="{{ route('logout') }}" onsubmit="clearCustomerLocalStorage()">
    @csrf
    <button type="submit">Logout</button>
</form>
```

**Script function di kedua layouts:**
```javascript
function clearCustomerLocalStorage() {
    // Clear customer-specific localStorage keys
    const keysToRemove = [
        'customer_cart',
        'checkout_payload',
        'available_points',
        'user_member_points',
        'last_customer_id'
    ];
    
    keysToRemove.forEach(key => {
        localStorage.removeItem(key);
    });
    
    console.log('Customer localStorage cleared on logout');
    return true;
}
```

### 2️⃣ **Fetch Member Points Real-Time di Cart Page**

**File:** `resources/views/customer/cart.blade.php`

Setiap kali cart page di-load, JavaScript akan **fetch data points terbaru dari server**:

```javascript
// Dipanggil saat page load (sebelum renderCart)
function fetchMemberPointsRealTime() {
    fetch('{{ route("customer.cart.member-points") }}')
        .then(res => res.json())
        .then(data => {
            if (data.success && data.member_points !== undefined) {
                const availablePointsEl = document.getElementById('available-points');
                if (availablePointsEl) {
                    // Override nilai dari server (real-time)
                    availablePointsEl.textContent = data.member_points + ' Pts';
                    
                    // Update input max attribute
                    const inputPoints = document.getElementById('input-points');
                    if (inputPoints) {
                        inputPoints.max = data.member_points;
                        if (parseInt(inputPoints.value) > data.member_points) {
                            inputPoints.value = 0;
                        }
                    }
                    
                    // Update summary dengan nilai baru
                    updateSummary();
                }
            }
        })
        .catch(err => console.error('Error fetching member points:', err));
}
```

### 3️⃣ **Backend Endpoint untuk Fetch Real-Time Points**

**File:** `app/Http/Controllers/Customer/CartController.php`

```php
/**
 * Ambil member points real-time untuk cart page
 */
public function getMemberPoints(Request $request)
{
    $customerId = auth()->id();
    if (!$customerId) {
        return response()->json(['success' => false, 'member_points' => 0], 401);
    }

    $customer = DB::table('customers')->where('id', $customerId)->first();
    if (!$customer) {
        return response()->json(['success' => false, 'member_points' => 0], 404);
    }

    return response()->json([
        'success' => true,
        'member_points' => (int)$customer->member_points
    ]);
}
```

### 4️⃣ **Route Baru**

**File:** `routes/web.php`

```php
Route::get('/cart/member-points', [CartController::class, 'getMemberPoints'])
    ->name('customer.cart.member-points');
```

---

## 🎯 Bagaimana Solusi Ini Bekerja

```
SKENARIO SEBELUM (BERMASALAH):
┌─────────────────────────────────────┐
│ Page Load                           │
│ ↓                                   │
│ Server render: $userPoints = 3730   │
│ (dari database pada saat render)    │
│ ↓                                   │
│ Display: "3730 Pts"                 │
│ ✗ CACHE/STALE: Bisa jadi dari      │
│   user sebelumnya!                  │
└─────────────────────────────────────┘

SKENARIO SESUDAH (DIPERBAIKI):
┌─────────────────────────────────────┐
│ 1. Logout Siti                      │
│    → clearCustomerLocalStorage()    │
│    → localStorage kosong            │
├─────────────────────────────────────┤
│ 2. Budi login & buka cart           │
│    → Server render: $userPoints = ? │
├─────────────────────────────────────┤
│ 3. fetchMemberPointsRealTime()      │
│    → Fetch: /cart/member-points     │
│    → Server query DB: SELECT ...    │
│    → Return: {member_points: 5470}  │
├─────────────────────────────────────┤
│ 4. Update DOM:                      │
│    → availablePointsEl.text = 5470  │
│    → input.max = 5470               │
│    ✓ SELALU AKURAT                  │
└─────────────────────────────────────┘
```

---

## 🧪 Testing Steps

1. **Login sebagai Siti (ID 2, 3730 points)**
   ```
   Buka Cart → Lihat: "3730 Pts" ✓
   ```

2. **Logout (clear localStorage)**
   ```
   Klik Logout
   → clearCustomerLocalStorage() dijalankan
   → localStorage dihapus
   ```

3. **Login sebagai Budi (ID 1, 5470 points)**
   ```
   Buka Cart → fetchMemberPointsRealTime() dijalankan
   → API return: 5470
   → Display: "5470 Pts" ✓
   
   HASIL: Benar! Tidak ada data Siti tercampur.
   ```

---

## 📋 Checklist Implementasi

- [x] Add `clearCustomerLocalStorage()` function di `layouts/app.blade.php`
- [x] Add `clearCustomerLocalStorage()` function di `customer/layout.blade.php`
- [x] Add `onsubmit` handler ke logout form di `layouts/app.blade.php`
- [x] Add `onsubmit` handler ke logout form di `customer/layout.blade.php`
- [x] Add `getMemberPoints()` method di `CartController`
- [x] Add route `/cart/member-points` di `routes/web.php`
- [x] Add `fetchMemberPointsRealTime()` function di `cart.blade.php`
- [x] Call `fetchMemberPointsRealTime()` saat cart page load

---

## 🚀 Hasil Akhir

| Aspek | Sebelum | Sesudah |
|-------|---------|---------|
| **Cache Issue** | ❌ Data user tercampur | ✅ Selalu fresh dari DB |
| **Logout** | ❌ localStorage masih ada | ✅ Dibersihkan otomatis |
| **Cart Load** | ❌ Bisa outdated | ✅ Fetch real-time |
| **Akurasi Points** | ❌ Bisa salah | ✅ 100% akurat |

