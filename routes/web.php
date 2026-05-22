<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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


// INGREDIENT
Route::get('/ingredient-inventory', [IngredientController::class, 'index'])
    ->name('ingredient.inventory');

Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredient.create');

Route::post('/ingredients/store', [IngredientController::class, 'store'])->name('ingredient.store');

Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');

Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredient.update');


// ORDER HISTORY
Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');

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

