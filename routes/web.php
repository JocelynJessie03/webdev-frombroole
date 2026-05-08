<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
<<<<<<< HEAD
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
=======
    return view('welcome');
});
>>>>>>> 6671f1bdff6255797dc5a6b3ad4b754c9d1d667e
