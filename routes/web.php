<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pos', function () {
    return view('pos');
})->name('pos');

Route::get('/inventory', function () {
    return view('inventory');
})->name('inventory');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/customers', function () {
    return view('customers');
})->name('customers');

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



// CREATE PRODUCT PAGE
Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');



// STORE PRODUCT
Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

