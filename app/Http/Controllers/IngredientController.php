<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();

        if ($request->filter == 'low_stock') {
            $query->where(function($q) {
                $q->where('unit', 'pcs')->where('stock', '<=', 50)
                  ->orWhere('unit', 'ml')->where('stock', '<=', 5000)
                  ->orWhere('unit', 'gr')->where('stock', '<=', 3000)
                  ->orWhere('unit', 'pack')->where('stock', '<=', 20);
            });
        }
        elseif ($request->filter == 'out_of_stock') {
            $query->where(function($q) {
                $q->where('unit', 'pcs')->where('stock', '<=', 0)
                  ->orWhere('unit', 'ml')->where('stock', '<=', 0)
                  ->orWhere('unit', 'gr')->where('stock', '<=', 0)
                  ->orWhere('unit', 'pack')->where('stock', '<=', 0);
            });
        }

        $ingredients = $query->get();
        // 1. Hitung Total Ingredients
        $totalIngredients = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->count();

        // 2. Hitung Low Stock Count (menerjemahkan accessor model ke dalam query SQL)
        $lowStockCount = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->where(function ($q) {
                $q->where(fn($sub) => $sub->where('unit', 'pcs')->where('stock', '<=', 50))
                  ->orWhere(fn($sub) => $sub->where('unit', 'ml')->where('stock', '<=', 5000))
                  ->orWhere(fn($sub) => $sub->where('unit', 'gr')->where('stock', '<=', 3000))
                  ->orWhere(fn($sub) => $sub->where('unit', 'pack')->where('stock', '<=', 20));
            })
            ->count();

        // 3. LOGIKA BARU: Hitung jenis bahan yang keluar hari ini
        $usedTodayCount = DB::table('ingredient_histories')
            ->where('type', 'out')
            ->whereDate('date', today())
            ->distinct() // Menghindari duplikasi id
            ->sum('amount');

        return view('ingredient.inventory', compact('ingredients', 'totalIngredients', 'lowStockCount', 'usedTodayCount'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
            'stock' => 'required|numeric|min:0',
            'unit'  => 'required|string|in:gr,ml,pcs',
        ]);

        // LOGIKA BARU: Cek selisih stok lama dan stok baru
        $oldStock = $ingredient->stock;
        $newStock = $request->stock;

        // Jika stok baru lebih KECIL dari stok lama, berarti ada bahan yang "Dipakai/Keluar"
        if ($newStock < $oldStock) {
            IngredientHistory::create([
                'ingredient_id' => $ingredient->id,
                'amount'        => $oldStock - $newStock, // Selisihnya
                'type'          => 'out',
                'date'          => today(), // Catat tanggal hari ini
            ]);
        }

        $ingredient->update([
            'name'  => $request->name,
            'stock' => $newStock,
            'unit'  => strtolower($request->unit),
        ]);

        return redirect()->route('ingredient.inventory')->with('success', 'Ingredient updated successfully!');
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
public function destroy($id)
    {
        $ingredient = \App\Models\Ingredient::findOrFail($id);
        
        // Karena pakai SoftDeletes di model, ini otomatis hanya mengisi kolom deleted_at
        $ingredient->delete();

        return redirect()->back()->with('success', 'Ingredient successfully deleted!');
    }

}