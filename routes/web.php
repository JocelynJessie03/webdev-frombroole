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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pos', [PosController::class, 'index'])->name('pos');

Route::get('/product-inventory', [ProductController::class, 'index'])->name('product.inventory');

Route::get('/ingredient-inventory', [IngredientController::class, 'index'])
    ->name('ingredient.inventory');

Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredient.create');
Route::post('/ingredients/store', [IngredientController::class, 'store'])->name('ingredient.store');

Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');





// CREATE PRODUCT PAGE
Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');



// STORE PRODUCT
Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

