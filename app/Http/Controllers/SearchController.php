<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = str_replace(['%', '_'], ['\%', '\_'], $request->input('query'));

        $products = Product::with('category')
            ->where('pro_name', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        // $categories = Category::where('category_name', 'like', "%{$query}%")
        //     ->limit(5)
        //     ->get();

        $categories = Category::query()
            ->where('category_name', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        $pages = collect([
            [
                'title' => 'Home',
                'url' => route('customer.home')
            ],
            [
                'title' => 'Shop',
                'url' => route('customer.shop')
            ],
            [
                'title' => 'About Us',
                'url' => route('customer.about')
            ],
            [
                'title' => 'Contact',
                'url' => route('customer.contact')
            ],
            [
                'title' => 'Transaction History',
                'url' => route('customer.transactions_history')
            ]
        ])->filter(function ($page) use ($query) {
            return str_contains(
                strtolower($page['title']),
                strtolower($query)
            );
        })->values();

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'pages' => $pages
        ]);
    }
}