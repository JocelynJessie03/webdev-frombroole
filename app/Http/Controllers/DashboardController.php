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
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. FILTER TABS (DAILY / MONTHLY)
        |--------------------------------------------------------------------------
        */
        $view = $request->input('view', 'daily');

        /*
        |--------------------------------------------------------------------------
        | 2. TOTAL SALES & TOTAL ORDERS (DYNAMIC BASED ON VIEW) - NATIVE LARAVEL
        |--------------------------------------------------------------------------
        */
        if ($view === 'monthly') {
            $startOfMonth = now()->startOfMonth()->toDateTimeString();
            $endOfMonth   = now()->endOfMonth()->toDateTimeString();

            $totalSales = OrderHistory::whereBetween('order_date', [$startOfMonth, $endOfMonth])
                ->sum('total_price');

            $totalOrders = OrderHistory::whereBetween('order_date', [$startOfMonth, $endOfMonth])
                ->count();

            $labelPeriode = "This Month (" . now()->format('F Y') . ")";
        } else {
            $startOfDay = now()->startOfDay()->toDateTimeString();
            $endOfDay   = now()->endOfDay()->toDateTimeString();

            $totalSales = OrderHistory::whereBetween('order_date', [$startOfDay, $endOfDay])
                ->sum('total_price');

            $totalOrders = OrderHistory::whereBetween('order_date', [$startOfDay, $endOfDay])
                ->count();

            $labelPeriode = "Today (" . now()->format('d M Y') . ")";
        }

        /*
        |--------------------------------------------------------------------------
        | 3. BEST SELLER PRODUCTS (GROUPED BY REAL DATABASE CATEGORIES)
        |--------------------------------------------------------------------------
        */
        $bestSellersAll = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.pro_name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.pro_name')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();

        $getBestByCategoryName = function($exactCategoryName) {
            return DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.pro_name', DB::raw('SUM(order_items.quantity) as total_sold'))
                ->where('categories.category_name', $exactCategoryName)
                ->groupBy('products.id', 'products.pro_name')
                ->orderByDesc('total_sold')
                ->take(3)
                ->get();
        };

        $bestSellersDrink      = $getBestByCategoryName('Drinks');
        $bestSellersBroole     = $getBestByCategoryName('Broole Series'); 
        $bestSellersCheese     = $getBestByCategoryName('Cheese Cake Series');

        $chartDataGroup = [
            'all'        => [
                'labels' => $bestSellersAll->pluck('pro_name')->toArray(),
                'values' => $bestSellersAll->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
            ],
            'drink'      => [
                'labels' => $bestSellersDrink->pluck('pro_name')->toArray(),
                'values' => $bestSellersDrink->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
            ],
            'broole'     => [
                'labels' => $bestSellersBroole->pluck('pro_name')->toArray(),
                'values' => $bestSellersBroole->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
            ],
            'cheesecake' => [
                'labels' => $bestSellersCheese->pluck('pro_name')->toArray(),
                'values' => $bestSellersCheese->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
            ]
        ];

        /*
        |--------------------------------------------------------------------------
        | 4. LOW STOCK PRODUCTS (KALKULASI DINAMIS DARI INGREDIENTS)
        |--------------------------------------------------------------------------
        */
        $allProducts = Product::with('ingredients')->get();

        foreach ($allProducts as $product) {
            if ($product->ingredients->isEmpty()) {
                $product->calculated_stock = 0;
            } else {
                $stocks = [];
                foreach ($product->ingredients as $ingredient) {
                    $needed = $ingredient->pivot->amount_needed ?: 1;
                    $available = floor($ingredient->stock / $needed);
                    $stocks[] = $available;
                }
                $product->calculated_stock = (int) max(0, min($stocks));
            }
        }

        $lowStocks = $allProducts
            ->filter(function($product) {
                return $product->calculated_stock <= 10;
            })
            ->sortBy('calculated_stock')
            ->take(5);

       /*
        |--------------------------------------------------------------------------
        | 5. INVENTORY INGREDIENTS STATUS (DYNAMIC BY UNIT LIMITS)
        |--------------------------------------------------------------------------
        */
        // Mengambil semua bahan baku yang memenuhi syarat Low Stock sesuai aturan unit bisnis Anda
       $ingredients = DB::table('ingredients')
    ->where(function($q) {
        $q->where('unit', 'pcs')->where('stock', '<=', 50)
          ->orWhere('unit', 'ml')->where('stock', '<=', 5000)
          ->orWhere('unit', 'gr')->where('stock', '<=', 3000)
          ->orWhere('unit', 'pack')->where('stock', '<=', 20);
    })
    ->whereNull('deleted_at') // Memastikan data yang soft-delete tidak ikut ketarik
    ->orderBy('stock', 'asc') // Mengurutkan dari nominal terkecil
    ->get();
        /*
        |--------------------------------------------------------------------------
        | 6. RECENT ORDERS LIST
        |--------------------------------------------------------------------------
        */
        $recentOrders = OrderHistory::with('customer')
            ->latest('order_date')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 7. RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('dashboard', compact(
            'view',
            'labelPeriode',
            'totalSales',
            'totalOrders',
            'chartDataGroup',
            'lowStocks',
            'ingredients',
            'recentOrders'
        ));
    } // Akhir dari method index()

    /*
    |--------------------------------------------------------------------------
    | GLOBAL SEARCH API
    |--------------------------------------------------------------------------
    */
    public function apiSearch(Request $request)
    {
        $query = $request->get('query');

        return response()->json([
            'products' => Product::where('pro_name', 'LIKE', "%{$query}%")->take(5)->get(),
            'ingredients' => Ingredient::where('name', 'LIKE', "%{$query}%")->take(5)->get(),
            'customers' => Customer::where('customer_name', 'LIKE', "%{$query}%")->take(5)->get(),
            'orders' => OrderHistory::where('order_id', 'LIKE', "%{$query}%")->take(5)->get(),
            'reports' => OrderHistory::with('customer')
                ->where('order_id', 'LIKE', "%{$query}%")
                ->orWhere('status', 'LIKE', "%{$query}%")
                ->orWhere('total_price', 'LIKE', "%{$query}%")
                ->orWhere('id', 'LIKE', "%{$query}%")
                ->orWhereHas('customer', function ($q) use ($query) {
                    $q->where('customer_name', 'LIKE', "%{$query}%");
                })
                ->take(5)
                ->get(),
        ]);
    }
} // Akhir dari class DashboardController