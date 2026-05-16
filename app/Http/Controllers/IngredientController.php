<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();

    // Logika Filter Low Stock yang Baru
    if ($request->filter == 'low_stock') {
        $query->where(function($q) {
            $q->where('unit', 'pcs')->where('stock', '<=', 100)
              ->orWhere('unit', 'ml')->where('stock', '<=', 2000)
              ->orWhere('unit', 'gr')->where('stock', '<=', 2000);
        });
    }

    $ingredients = $query->get();

    // Hitung Low Stock untuk Card (menggunakan logic yang sama)
    $lowStockCount = Ingredient::all()->filter(fn($item) => $item->is_low_stock)->count();
    $totalIngredients = Ingredient::count();

    return view('ingredient.inventory', compact('ingredients', 'totalIngredients', 'lowStockCount'));
}
}