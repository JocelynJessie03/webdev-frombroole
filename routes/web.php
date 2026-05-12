<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// POS
Route::get('/pos', [ProductController::class, 'index'])
    ->name('pos');



// CREATE PRODUCT PAGE
Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');



// STORE PRODUCT
Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

