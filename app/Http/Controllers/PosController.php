<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk menu filter atas
        $categories = Category::all();

        // Mulai query produk dengan relasi kategori
        $query = Product::with('category');

        // Filter berdasarkan kategori jika user mengklik salah satu kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Ambil produk yang tidak di-delete (bisa pakai query softDeletes bawaan)
        $products = $query->latest()->get();

        return view('pos', compact('products', 'categories'));
    }
}