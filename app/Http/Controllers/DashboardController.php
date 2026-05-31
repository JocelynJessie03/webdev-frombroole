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
    
        $view = $request->input('view', 'daily');

        if ($view === 'monthly') {
            $startOfMonth = now()->startOfMonth()->toDateTimeString();
            $endOfMonth   = now()->endOfMonth()->toDateTimeString();

            $totalSales = DB::table('order_histories')->whereBetween('order_date', [$startOfMonth, $endOfMonth])
                ->sum('total_price');

            $totalOrders = DB::table('order_histories')->whereBetween('order_date', [$startOfMonth, $endOfMonth])
                ->count();

            $labelPeriode = "This Month (" . now()->format('F Y') . ")";
        } else {
            $startOfDay = now()->startOfDay()->toDateTimeString();
            $endOfDay   = now()->endOfDay()->toDateTimeString();

            $totalSales = DB::table('order_histories')->whereBetween('order_date', [$startOfDay, $endOfDay])
                ->sum('total_price');

            $totalOrders = DB::table('order_histories')->whereBetween('order_date', [$startOfDay, $endOfDay])
                ->count();

            $labelPeriode = "Today (" . now()->format('d M Y') . ")";
        }

        /*
        |--------------------------------------------------------------------------
        | 3. BEST SELLER PRODUCTS (GROUPED BY REAL DATABASE CATEGORIES)
        |--------------------------------------------------------------------------
        */
       // Langkah 1: Cari 3 Kategori yang total item terjualnya paling banyak
        $topCategories = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.category_name', DB::raw('SUM(order_items.quantity) as total_category_sold'))
            ->groupBy('categories.id', 'categories.category_name')
            ->orderByDesc('total_category_sold')
            ->take(3)
            ->get();

        // Langkah 2: Ambil produk terlaris dari masing-masing kategori di atas
        $chartDataGroup = [];

        // 1. Ambil Top 3 Produk Paling Laris secara KESELURUHAN (untuk tab 'All')
        $bestSellersOverall = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.pro_name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.pro_name')
            ->orderByDesc('total_sold')
            ->take(3) // Hanya tampilkan Top 3 saja
            ->get();

        $chartDataGroup['all'] = [
            'category_name' => 'All',
            'labels' => $bestSellersOverall->pluck('pro_name')->toArray(),
            'values' => $bestSellersOverall->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
        ];

        // 2. Ambil Top 3 Kategori Terlaris
        $topCategories = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.category_name', DB::raw('SUM(order_items.quantity) as total_category_sold'))
            ->where('categories.category_name', '!=', 'Uncategorized') // Pastikan kategori 'Uncategorized' tidak ikut masuk
            ->groupBy('categories.id', 'categories.category_name')
            ->orderByDesc('total_category_sold')
            ->take(3)
            ->get();

        // 3. Loop untuk mencari Top 3 produk di masing-masing kategori tersebut
        foreach ($topCategories as $cat) {
            $bestProducts = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->select('products.pro_name', DB::raw('SUM(order_items.quantity) as total_sold'))
                ->where('products.category_id', $cat->id)
                ->groupBy('products.id', 'products.pro_name')
                ->orderByDesc('total_sold')
                ->take(3) // Top 3 per kategori
                ->get();

            // Bikin slug/key untuk id button di Blade
            $catKey = \Illuminate\Support\Str::slug($cat->category_name);

            $chartDataGroup[$catKey] = [
                'category_name' => $cat->category_name,
                'labels' => $bestProducts->pluck('pro_name')->toArray(),
                'values' => $bestProducts->pluck('total_sold')->map(fn($v) => (int)$v)->toArray()
            ];
        }
        /*
        |--------------------------------------------------------------------------
        | 4. LOW STOCK PRODUCTS (KALKULASI DINAMIS DARI INGREDIENTS)
        |--------------------------------------------------------------------------
        */
        $allProducts = Product::with('ingredients')->get();

        

        $lowStocks = $allProducts
            ->filter(function($product) {
                return $product->calculated_stock <= 10;
            })
            ->sortBy('calculated_stock')
            ->values();

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
            'products' => DB::table('products')->where('pro_name', 'LIKE', "%{$query}%")->take(5)->get(),
            'ingredients' => DB::table('ingredients')->where('name', 'LIKE', "%{$query}%")->take(5)->get(),
            'customers' => DB::table('customers')->where('customer_name', 'LIKE', "%{$query}%")->take(5)->get(),
            'orders' => DB::table('order_histories')->where('order_id', 'LIKE', "%{$query}%")->take(5)->get(),
            
            'reports'     => \App\Models\OrderHistory::with('customer')
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
}