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

                $q->where('stock', '<=', 0);

            });

        }

        $ingredients = $query->get();



        /*
        |--------------------------------------------------------------------------
        | TOTAL INGREDIENTS
        |--------------------------------------------------------------------------
        */

        $totalIngredients = DB::table('ingredients')
            ->whereNull('deleted_at')
            ->count();



        /*
        |--------------------------------------------------------------------------
        | LOW STOCK COUNT
        |--------------------------------------------------------------------------
        */

        $lowStockCount = DB::table('ingredients')

            ->whereNull('deleted_at')

            ->where(function ($q) {

                $q->where(fn($sub) =>
                    $sub->where('unit', 'pcs')->where('stock', '<=', 50)
                )

                ->orWhere(fn($sub) =>
                    $sub->where('unit', 'ml')->where('stock', '<=', 5000)
                )

                ->orWhere(fn($sub) =>
                    $sub->where('unit', 'gr')->where('stock', '<=', 3000)
                )

                ->orWhere(fn($sub) =>
                    $sub->where('unit', 'pack')->where('stock', '<=', 20)
                );

            })

            ->count();



        /*
        |--------------------------------------------------------------------------
        | USED TODAY COUNT
        |--------------------------------------------------------------------------
        */

        $usedTodayCount = 0;

        if (DB::getSchemaBuilder()->hasTable('ingredient_histories')) {

            $usedTodayCount = DB::table('ingredient_histories')

                ->where('type', 'out')

                ->whereDate('created_at', now('Asia/Jakarta'))

                ->sum('amount');
        }



        return view(
            'ingredient.inventory',
            compact(
                'ingredients',
                'totalIngredients',
                'lowStockCount',
                'usedTodayCount'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE INGREDIENT
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([

            'name'  => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,

            'stock' => 'required|numeric|min:0',

            'unit'  => 'required|string|in:gr,ml,pcs,pack',

        ]);



        $oldStock = $ingredient->stock;

        $newStock = $request->stock;



        /*
        |--------------------------------------------------------------------------
        | SAVE HISTORY IF STOCK DECREASED
        |--------------------------------------------------------------------------
        */

        if (
            $newStock < $oldStock
            &&
            DB::getSchemaBuilder()->hasTable('ingredient_histories')
        ) {

            IngredientHistory::create([

                'ingredient_id' => $ingredient->id,

                'amount'        => $oldStock - $newStock,

                'type'          => 'out',

                'created_at'    => now('Asia/Jakarta'),

                'updated_at'    => now('Asia/Jakarta'),

            ]);
        }



        /*
        |--------------------------------------------------------------------------
        | UPDATE INGREDIENT
        |--------------------------------------------------------------------------
        */

        $ingredient->update([

            'name'  => $request->name,

            'stock' => $newStock,

            'unit'  => strtolower($request->unit),

        ]);



        return redirect()
            ->route('ingredient.inventory')
            ->with('success', 'Ingredient updated successfully!');
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('ingredient.create');
    }



    /*
    |--------------------------------------------------------------------------
    | STORE INGREDIENT
    |--------------------------------------------------------------------------
    */

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



        return redirect()
            ->route('ingredient.inventory')
            ->with('success', 'Ingredient successfully added!');
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit(Ingredient $ingredient)
    {
        return view('ingredient.edit', compact('ingredient'));
    }



    /*
    |--------------------------------------------------------------------------
    | DELETE INGREDIENT
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $ingredient->delete();

        return redirect()
            ->back()
            ->with('success', 'Ingredient successfully deleted!');
    }
}


