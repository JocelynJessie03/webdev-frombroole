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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pos', [PosController::class, 'index'])->name('pos');


//Product
Route::get('/product-inventory', [ProductController::class, 'index'])->name('product.inventory');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');


// INGREDIENT
Route::get('/ingredient-inventory', [IngredientController::class, 'index'])
    ->name('ingredient.inventory');

Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredient.create');

Route::post('/ingredients/store', [IngredientController::class, 'store'])->name('ingredient.store');

Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');

Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredient.update');


// ORDER HISTORY
Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');

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

// POS
Route::get('/pos', [ProductController::class, 'index'])
    ->name('pos');

// REPORTS
Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports');

    Route::get('/customer', function () {
    return view('customer.layout');
});

Route::get('/profile/edit', function () {
    return view('customer.profile.edit');
})->name('profile.edit');