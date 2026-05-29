<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;

// LOGIN AND REGISTER

// buat auth
Route::view('/login', 'login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// forgot password
Route::view('/forgot-password', 'forgot-password');

Route::post('/forgot-password/send-otp', [AuthController::class, 'sendForgotOtp']);

Route::view('/verify-reset-otp', 'verify-reset-otp');

Route::post('/verify-reset-otp', [AuthController::class, 'verifyResetOtp']);

Route::view('/new-password', 'new-password');

Route::post('/new-password', [AuthController::class, 'updatePassword']);

// buat oauth
Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// register & verify otp
Route::view('/register', 'register')->name('register');

Route::post('/register/send-otp', [AuthController::class, 'sendOtp']);

Route::view('/verify-otp', 'verify-otp')->name('verify-otp');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

// resend otp
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

Route::post('/resend-reset-otp', [AuthController::class, 'resendResetOtp']);

// ADMIN SIDE

// POS
Route::get('/pos', [ProductController::class, 'index'])
    ->name('pos');

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/pos', [PosController::class, 'index'])->name('pos');


//Product
Route::get('/product-inventory', [ProductController::class, 'index'])->name('product.inventory');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


//Category
Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

// INGREDIENT
Route::get('/ingredient-inventory', [IngredientController::class, 'index'])
    ->name('ingredient.inventory');

Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredient.create');

Route::post('/ingredients/store', [IngredientController::class, 'store'])->name('ingredient.store');

Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');

Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredient.update');

Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredient.destroy');
// ORDER HISTORY
Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');

Route::patch('/order_history/{id}/update-status', [OrderHistoryController::class, 'updateStatus'])->name('order_history.update_status');

//Customer
Route::get('/customers', [CustomerController::class, 'index'])->name('customers');


// REPORTS
Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports');


// CHECKOUT
Route::post('/pos/checkout', [PosController::class, 'checkout'])
    ->name('pos.checkout');
    
Route::get('/checkout/{id}', [PosController::class, 'checkoutView'])
    ->name('checkout.view');

Route::post('/checkout-preview', [PosController::class, 'checkoutPreview'])
    ->name('checkout.preview');

Route::post('/payment-process', [PosController::class, 'processPayment'])
    ->name('payment.process');

Route::get('/payment-success/{id}', [PosController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::get('/receipt/{id}', [PosController::class, 'receipt'])
    ->name('receipt');

Route::get('/api/search', [DashboardController::class, 'apiSearch']);
Route::post('/check-member', [App\Http\Controllers\PosController::class, 'checkMember'])->name('check.member');


//CATEGORY
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
// Tambahkan baris rute restore ini di routes/web.php kamu
Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');


Route::post(
    '/notifications/{id}/read',
    [NotificationController::class, 'markAsRead']
);

Route::post(
    '/notifications/mark-all-read',
    [NotificationController::class, 'markAllAsRead']
);

// CUSTOMER SIDE
Route::view('/home', 'customer.home')->name('customer.home');