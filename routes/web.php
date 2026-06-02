<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\Customer\MemberTaskController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditMemberController; // <-- TAMBAHAN UNTUK EDIT PROFILE
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. GUEST ROUTES (Hanya bisa diakses jika BELUM login)
// ==========================================
Route::middleware('guest')->group(function () {
    // Login
    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register & OTP
    Route::view('/register', 'register')->name('register');
    Route::post('/register/send-otp', [AuthController::class, 'sendOtp']);
    Route::view('/verify-otp', 'verify-otp')->name('verify-otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

    // Forgot Password
    Route::view('/forgot-password', 'forgot-password');
    Route::post('/forgot-password/send-otp', [AuthController::class, 'sendForgotOtp']);
    Route::view('/verify-reset-otp', 'verify-reset-otp');
    Route::post('/verify-reset-otp', [AuthController::class, 'verifyResetOtp']);
    Route::post('/resend-reset-otp', [AuthController::class, 'resendResetOtp']);
    Route::view('/new-password', 'new-password');
    Route::post('/new-password', [AuthController::class, 'updatePassword']);

    // OAuth Google
    Route::get('/auth/google', [GoogleController::class, 'redirect']);
    Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
});

// Logout (Harus login untuk bisa logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 2. ADMIN ROUTES (Hanya untuk Admin)
// ==========================================
Route::middleware(['auth:admin', 'admin'])->group(function () {
    // Redirection
    Route::get('/', function () { return redirect('/dashboard'); });

    // Dashboard & Global Search
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/search', [DashboardController::class, 'apiSearch']);

    // POS & Checkout
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    Route::get('/checkout/{id}', [PosController::class, 'checkoutView'])->name('checkout.view');
    Route::post('/checkout-preview', [PosController::class, 'checkoutPreview'])->name('checkout.preview');
    Route::post('/payment-process', [PosController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success/{id}', [PosController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/receipt/{id}', [PosController::class, 'receipt'])->name('receipt');
    Route::post('/check-member', [PosController::class, 'checkMember'])->name('check.member');

    // Inventory / Products
    Route::get('/product-inventory', [ProductController::class, 'index'])->name('product.inventory');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Ingredients
    Route::get('/ingredient-inventory', [IngredientController::class, 'index'])->name('ingredient.inventory');
    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredient.create');
    Route::post('/ingredients/store', [IngredientController::class, 'store'])->name('ingredient.store');
    Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');
    Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredient.update');
    Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredient.destroy');

    // Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

    // Orders & Customers
    Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');
    Route::patch('/order_history/{id}/update-status', [OrderHistoryController::class, 'updateStatus'])->name('order_history.update_status');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Notifications
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);

    Route::post('/admin/tasks', [App\Http\Controllers\AdminTaskController::class, 'store'])->name('admin.tasks.store');
    Route::delete('/admin/tasks/{task}', [App\Http\Controllers\AdminTaskController::class, 'destroy'])->name('admin.tasks.destroy');
});

// ==========================================
// 3. CUSTOMER ROUTES (Hanya untuk Customer)
// ==========================================
Route::middleware(['auth', 'customer'])->group(function () {
    // Halaman Customer
    Route::view('/home', 'customer.home')->name('customer.home');
    Route::view('/about', 'customer.about')->name('customer.about');
    Route::view('/contact', 'customer.contact')->name('customer.contact');
    Route::view('/transactions_history', 'customer.transactions_history')
    ->name('customer.transactions_history');
    Route::view('/shop', 'customer.shop')->name('customer.shop');

    Route::view(
    '/contact/success',
    'customer.contact-success'
    )->name('contact.success');

    Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

    
    // Shop 
    Route::get('/shop', [ShopController::class, 'index'])->name('customer.shop');
    Route::get('/cart',  [ShopController::class, 'cart'])->name('customer.cart');
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('customer.checkout');
    Route::post('/validate-coupon', [ShopController::class, 'validateCoupon'])->name('customer.validate-coupon');
    
    Route::view('/transaction-history', 'customer.transactions_history')->name('customer.history');
    
    // --> DIUBAH: Menggunakan EditMemberController <--
    Route::get('/profile/edit', [EditMemberController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [EditMemberController::class, 'update'])->name('profile.update');
    
    Route::get('/tasks', [MemberTaskController::class, 'index'])->name('customer.tasks.index');
    Route::post('/tasks/{task}/claim', [MemberTaskController::class, 'claim'])->name('customer.tasks.claim');
    Route::get('/api/tasks/widget', [MemberTaskController::class, 'widget'])->name('customer.tasks.widget');
    // AI Chat
    Route::post('/ai-chat', [AiController::class, 'chat']);
});
