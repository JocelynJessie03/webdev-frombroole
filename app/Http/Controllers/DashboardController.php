<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | TOTAL SALES
        |--------------------------------------------------------------------------
        */

        $totalSales = OrderHistory::sum('total_price');



        /*
        |--------------------------------------------------------------------------
        | TOTAL ORDERS
        |--------------------------------------------------------------------------
        */

        $totalOrders = OrderHistory::count();



        /*
        |--------------------------------------------------------------------------
        | BEST SELLER PRODUCTS
        |--------------------------------------------------------------------------
        */

        $bestSellers = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();



        /*
        |--------------------------------------------------------------------------
        | LOW STOCK PRODUCTS
        |--------------------------------------------------------------------------
        */

        $lowStocks = Product::with('ingredients')
            ->where('pro_delete', false)
            ->get();



        foreach ($lowStocks as $product)
        {

            if ($product->ingredients->isEmpty())
            {
                $product->calculated_stock = 0;
            }
            else
            {

                $stocks = [];

                foreach ($product->ingredients as $ingredient)
                {

                    $needed = $ingredient->pivot->amount_needed ?: 1;

                    $available = floor($ingredient->stock / $needed);

                    $stocks[] = $available;
                }

                $product->calculated_stock = (int) max(0, min($stocks));
            }
        }



        $lowStocks = $lowStocks
            ->sortBy('calculated_stock')
            ->take(5);



        /*
        |--------------------------------------------------------------------------
        | INVENTORY INGREDIENTS
        |--------------------------------------------------------------------------
        */

        $ingredients = Ingredient::orderBy('stock', 'asc')
            ->take(6)
            ->get();



        /*
        |--------------------------------------------------------------------------
        | RECENT ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = OrderHistory::with('customer')
            ->latest()
            ->take(5)
            ->get();



        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalSales',
            'totalOrders',
            'bestSellers',
            'lowStocks',
            'ingredients',
            'recentOrders'
        ));
    }



    /*
    |--------------------------------------------------------------------------
    | GLOBAL SEARCH API
    |--------------------------------------------------------------------------
    */

public function apiSearch(Request $request)
{
    $query = $request->query('query');



    /*
    |--------------------------------------------------------------------------
    | PRODUCTS
    |--------------------------------------------------------------------------
    */

    $products = Product::where('pro_name', 'LIKE', "%{$query}%")
        ->where('pro_delete', false)
        ->take(5)
        ->get();



    /*
    |--------------------------------------------------------------------------
    | INGREDIENTS
    |--------------------------------------------------------------------------
    */

    $ingredients = Ingredient::where('name', 'LIKE', "%{$query}%")
        ->take(5)
        ->get();



    /*
    |--------------------------------------------------------------------------
    | CUSTOMERS
    |--------------------------------------------------------------------------
    */

    $customers = Customer::where('customer_name', 'LIKE', "%{$query}%")
        ->take(5)
        ->get();



    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    $orders = OrderHistory::where('order_id', 'LIKE', "%{$query}%")
        ->take(5)
        ->get();



    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    $reports = OrderHistory::with('customer')
        ->where('order_id', 'LIKE', "%{$query}%")
        ->orWhere('status', 'LIKE', "%{$query}%")
        ->orWhere('payment_method', 'LIKE', "%{$query}%")
        ->orWhereHas('customer', function($q) use ($query){

            $q->where('customer_name', 'LIKE', "%{$query}%");

        })
        ->latest()
        ->take(5)
        ->get();



    return response()->json([

        'products' => $products,

        'ingredients' => $ingredients,

        'customers' => $customers,

        'orders' => $orders,

        'reports' => $reports

    ]);
}

}