<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ingredient;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data dengan Eager Loading
        $allProducts = Product::with(['category', 'ingredients' => function($q) {
            $q->withPivot('amount_needed');
        }])->where('pro_delete', false)->get();

    // 2. Hitung Stok Dinamis & Status
    foreach ($allProducts as $product) {
        if ($product->ingredients->isEmpty()) {
            $product->calculated_stock = 0;
        } else {
            $stocks = [];
            foreach ($product->ingredients as $ingredient) {
                // Pastikan tidak pembagian dengan nol jika data pivot bermasalah
                $needed = $ingredient->pivot->amount_needed ?: 1; 
                $available = floor($ingredient->stock / $needed);
                $stocks[] = $available;
            }
            $product->calculated_stock = (int) max(0, min($stocks));
        }

        // Tentukan Label Status (Harus uppercase agar cocok dengan Blade)
        if ($product->calculated_stock <= 0) {
            $product->status_label = 'OUT OF STOCK';
        } elseif ($product->calculated_stock <= 10) {
            $product->status_label = 'LOW STOCK';
        } else {
            $product->status_label = 'IN STOCK';
        }
    }

    // 3. Logika Filter (Menggunakan koleksi yang sudah dihitung stoknya)
    $products = $allProducts;
    if ($request->filter == 'low_stock') {
        $products = $allProducts->filter(fn($p) => $p->calculated_stock > 0 && $p->calculated_stock <= 10);
    } elseif ($request->filter == 'out_of_stock') {
        $products = $allProducts->filter(fn($p) => $p->calculated_stock <= 0);
    }

    // 4. Hitung Statistik untuk Card Atas
    $totalProducts = $allProducts->count();
    $lowStockCount = $allProducts->filter(fn($p) => $p->calculated_stock > 0 && $p->calculated_stock <= 10)->count();
    
    // Hitung Total Value (Harga Produk x Stok Dinamis)
    $totalValue = $allProducts->sum(function($p) {
        return $p->pro_price * $p->calculated_stock;
    });

    return view('product.inventory', [
        'products' => $products,
        'totalProducts' => $totalProducts,
        'lowStockCount' => $lowStockCount,
        'totalValue' => $totalValue // Tambahkan ini untuk Card Value
    ]);
}

    public function create()
    {
        // Ambil semua bahan baku untuk dipilih di form create product
        $ingredients = Ingredient::all();
        $categories = \App\Models\Category::all();

        return view('product.create', compact('ingredients', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'pro_price' => 'required|numeric',
            'pro_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ingredients' => 'required|array', // Validasi input resep
        ]);

        $imageName = null;
        if($request->hasFile('pro_image')) {
            $imageName = time().'.'.$request->pro_image->extension();
            $request->pro_image->move(public_path('products'), $imageName);
        }
            $cleanName = str_replace(' ', '', $request->pro_name);
            $uniqueCode = strtoupper(substr($cleanName, 0, 3) . substr($cleanName, -3));
            $generatedID = 'PRO-' . $uniqueCode . rand(1000, 9999);
        // 1. Simpan Data Produk
        $product = Product::create([
            'pro_ID' => $generatedID,
            'category_id' => $request->category_id,
            'pro_name' => $request->pro_name,
            'pro_description' => $request->pro_description,
            'pro_price' => $request->pro_price,
            'pro_image' => $imageName,
            'pro_delete' => false,
        ]);

        // 2. Simpan Relasi Bahan Baku (Resep) ke tabel pivot
        // Asumsi input form: ingredients[id_bahan] = jumlah_butuh
        foreach ($request->ingredients as $ingredientId => $amount) {
            if ($amount > 0) {
                $product->ingredients()->attach($ingredientId, ['amount_needed' => $amount]);
            }
        }

        return redirect('/pos')->with('success', 'Produk dan Resep berhasil disimpan!');
    }
    public function edit($id)
{
    $product = Product::with('ingredients')->findOrFail($id);
    $categories = \App\Models\Category::all();
    $ingredients = Ingredient::all();
    
    return view('product.edit', compact('product', 'categories', 'ingredients'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'pro_name' => 'required',
        'category_id' => 'required|exists:categories,id',
        'pro_price' => 'required|numeric',
        'pro_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'ingredients' => 'required|array',
    ]);

    if ($request->hasFile('pro_image')) {
        // Hapus gambar lama jika ada
        if ($product->pro_image && file_exists(public_path('products/' . $product->pro_image))) {
            unlink(public_path('products/' . $product->pro_image));
        }
        $imageName = time().'.'.$request->pro_image->extension();
        $request->pro_image->move(public_path('products'), $imageName);
        $product->pro_image = $imageName;
    }

    $product->update([
        'category_id' => $request->category_id,
        'pro_name' => $request->pro_name,
        'pro_description' => $request->pro_description,
        'pro_price' => $request->pro_price,
        'pro_image' => $product->pro_image,
    ]);

    // Sync relasi pivot bahan baku
    $syncData = [];
    foreach ($request->ingredients as $ingredientId => $amount) {
        if ($amount > 0) {
            $syncData[$ingredientId] = ['amount_needed' => $amount];
        }
    }
    $product->ingredients()->sync($syncData);

    return redirect()->route('product.inventory')->with('success', 'Product updated successfully!');
}


}