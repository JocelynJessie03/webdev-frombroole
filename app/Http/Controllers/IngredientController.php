<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();

        if ($request->filter == 'low_stock') {
            $query->where(function($q) {
                $q->where('unit', 'pcs')->where('stock', '<=', 100)
                  ->orWhere('unit', 'ml')->where('stock', '<=', 2000)
                  ->orWhere('unit', 'gr')->where('stock', '<=', 2000);
            });
        }

        $ingredients = $query->get();

        $lowStockCount = Ingredient::all()->filter(fn($item) => $item->is_low_stock)->count();
        $totalIngredients = Ingredient::count();

        return view('ingredient.inventory', compact('ingredients', 'totalIngredients', 'lowStockCount'));
    }

    // Method untuk menampilkan form create
    public function create()
    {
        return view('ingredient.create');
    }

    // Method untuk menyimpan data ingredient baru
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:ingredients,name',
            'stock' => 'required|numeric|min:0',
            'unit'  => 'required|string|in:gr,ml,pcs', // Pilihan unit dibatasi sesuai logic filter kamu
        ]);

        Ingredient::create([
            'name'  => $request->name,
            'stock' => $request->stock,
            'unit'  => strtolower($request->unit),
        ]);

        return redirect()->route('ingredient.inventory')->with('success', 'Ingredient successfully added!');
    }
    public function edit(Ingredient $ingredient)
{
    // Menampilkan view form edit dengan membawa data ingredient yang dipilih
    return view('ingredient.edit', compact('ingredient'));
}

public function update(Request $request, Ingredient $ingredient)
{
    $request->validate([
        'name'  => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
        'stock' => 'required|numeric|min:0',
        'unit'  => 'required|string|in:gr,ml,pcs',
    ]);

    $ingredient->update([
        'name'  => $request->name,
        'stock' => $request->stock,
        'unit'  => strtolower($request->unit),
    ]);

    return redirect()->route('ingredient.inventory')->with('success', 'Ingredient updated successfully!');
}


}