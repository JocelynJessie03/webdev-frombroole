<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 ID Produk dengan kuantitas terjual terbanyak
        $topProductsData = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get()
            ->keyBy('product_id');

        // 2. Tarik data produk lengkap dan map dengan total_sold
        $bestSellers = Product::with('category')
            ->whereIn('id', $topProductsData->keys())
            ->get()
            ->map(function($product) use ($topProductsData) {
                $product->total_sold = (int) ($topProductsData[$product->id]->total_sold ?? 0);
                return $product;
            })
            ->sortByDesc('total_sold')
            ->values();

        // 3. Return data ke view about
        return view('customer.about', compact('bestSellers'));
    }
}