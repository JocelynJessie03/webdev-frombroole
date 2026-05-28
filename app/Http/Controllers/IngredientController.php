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
        $chartData = DB::table('ingredients')
            ->leftJoin('ingredient_histories', function($join) {
                $join->on('ingredients.id', '=', 'ingredient_histories.ingredient_id')
                     ->where('ingredient_histories.type', '=', 'out')
                     ->where('ingredient_histories.date', '>=', today()->subDays(4)->toDateString());
            })
            ->select(
                'ingredients.name', 
                'ingredients.unit', 
                DB::raw('COALESCE(SUM(ingredient_histories.amount), 0) as total_amount')
            )
            ->whereNull('ingredients.deleted_at') 
            ->groupBy('ingredients.id', 'ingredients.name', 'ingredients.unit')
            ->orderBy('total_amount', 'desc')
            ->get();

        $usageData = [
            'labels' => $chartData->pluck('name')->toArray(),
            'values' => $chartData->pluck('total_amount')->map(function($item) { return (float)$item; })->toArray(),
            'units'  => $chartData->pluck('unit')->map(function($item) { return strtolower($item); })->toArray()
        ];

        $query = Ingredient::query();

        if ($request->filter == 'low_stock') {
            $query->where(function($q) {
                // 🌟 FIX: Pastikan stock harus di atas 0 agar barang habis tidak ikut masuk ke sini
                $q->where(fn($sub) => $sub->where('unit', 'pcs')->where('stock', '<=', 50)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'ml')->where('stock', '<=', 5000)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'gr')->where('stock', '<=', 3000)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'pack')->where('stock', '<=', 20)->where('stock', '>', 0));
            });
        }
        elseif ($request->filter == 'out_of_stock') {
            $query->where(function($q) {
                $q->where('stock', '<=', 0);
            });
        }
        elseif ($request->filter == 'all') {
            $query->where(function($q) {
                // Cukup hilangkan batas '> 0', maka otomatis barang habis (<= 0) dan mau habis akan tergabung di sini
                $q->where(fn($sub) => $sub->where('unit', 'pcs')->where('stock', '<=', 50))
                  ->orWhere(fn($sub) => $sub->where('unit', 'ml')->where('stock', '<=', 5000))
                  ->orWhere(fn($sub) => $sub->where('unit', 'gr')->where('stock', '<=', 3000))
                  ->orWhere(fn($sub) => $sub->where('unit', 'pack')->where('stock', '<=', 20))
                  // Jaga-jaga jika ada barang dengan unit lain (selain 4 di atas) yang stoknya kebetulan habis
                  ->orWhere('stock', '<=', 0); 
            });
        }

        $ingredients = $query->get();

        $totalIngredients = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->count();

        // 🌟 FIX: Hitungan angka di CARD ATAS juga dikunci agar yang bernilai 0 tidak terhitung sebagai Low Stock
        $lowStockCount = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->where(function ($q) {
                $q->where(fn($sub) => $sub->where('unit', 'pcs')->where('stock', '<=', 50)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'ml')->where('stock', '<=', 5000)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'gr')->where('stock', '<=', 3000)->where('stock', '>', 0))
                  ->orWhere(fn($sub) => $sub->where('unit', 'pack')->where('stock', '<=', 20)->where('stock', '>', 0));
            })
            ->count();

        // 🌟 FIX: Menghitung yang murni habis total (0 atau kurang)
        $outOfStockCount = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->where('stock', '<=', 0)
            ->count();

        $usedTodayCount = 0;
        if (DB::getSchemaBuilder()->hasTable('ingredient_histories')) {
            $usedTodayCount = DB::table('ingredient_histories')
                ->where('type', 'out')
                ->whereDate('created_at', now('Asia/Jakarta'))
                ->sum('amount');
        }

        return view('ingredient.inventory', [
            'ingredients'      => $ingredients,
            'totalIngredients' => $totalIngredients,
            'lowStockCount'    => $lowStockCount,
            'outOfStockCount'  => $outOfStockCount,
            'usedTodayCount'   => $usedTodayCount,
            'usageData'        => $usageData
        ]);
    }

    // 🌟 FIX: Diubah menggunakan ID biasa agar klop dengan web.php ({id})
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
            'stock' => 'required|numeric|min:0',
            'unit'  => 'required|string|in:gr,ml,pcs,pack',
        ]);

        $oldStock = $ingredient->stock;
        $newStock = $request->stock;

        if (
            $newStock < $oldStock
            &&
            DB::getSchemaBuilder()->hasTable('ingredient_histories')
        ) {
            IngredientHistory::create([
                'ingredient_id' => $ingredient->id,
                'amount'        => $oldStock - $newStock,
                'type'          => 'out',
                'date'          => today()->toDateString(),
                'created_at'    => now('Asia/Jakarta'),
                'updated_at'    => now('Asia/Jakarta'),
            ]);
        }

        $ingredient->update([
            'name'  => $request->name,
            'stock' => $newStock,
            'unit'  => strtolower($request->unit),
        ]);

        DB::table('notifications')->insert([
            'title' => 'Ingredient Stock Adjusted',
            'message' => 'Stock for "' . $request->name . '" has been updated from ' . $oldStock . ' to ' . $newStock . ' ' . strtolower($request->unit) . '.',
            'type' => 'stock',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()
            ->route('ingredient.inventory')
            ->with('success', 'Ingredient updated successfully!');
    }

    public function create()
    {
        return view('ingredient.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:ingredients,name',
            'stock' => 'required|numeric|min:0',
            'unit'  => 'required|string|in:gr,ml,pcs,pack',
        ]);

        Ingredient::create([
            'name'  => $request->name,
            'stock' => $request->stock,
            'unit'  => strtolower($request->unit),
        ]);

        DB::table('notifications')->insert([
            'title' => 'New Ingredient Added',
            'message' => 'Ingredient "' . $request->name . '" (' . $request->stock . ' ' . strtolower($request->unit) . ') has been successfully registered.',
            'type' => 'stock',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()
            ->route('ingredient.inventory')
            ->with('success', 'Ingredient successfully added!');
    }

    // 🌟 FIX: Diubah menggunakan ID biasa agar klop dengan web.php ({id})
    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('ingredient.edit', compact('ingredient'));
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        DB::table('notifications')->insert([
            'title' => 'Ingredient Deleted',
            'message' => 'Ingredient "' . $ingredient->name . '" has been permanently removed from the system.',
            'type' => 'stock',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Ingredient successfully deleted!');
    }
}