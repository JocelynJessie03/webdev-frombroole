<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan halaman form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Memproses data yang dikirim dari form
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        $lastCategory = \App\Models\Category::orderBy('category_ID', 'desc')->first();

        // 2. Tentukan angka urutan berikutnya
        if ($lastCategory && $lastCategory->category_ID) {
            // Jika sudah ada data (misal: "CAT-004"), ambil angkanya saja ("004" menjadi 4), lalu tambah 1
            $lastNumber = (int) substr($lastCategory->category_ID, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            // Jika tabel categories masih kosong sama sekali
            $nextNumber = 1;
        }

        // 3. Gabungkan "CAT-" dengan angka yang sudah diformat (misal: 1 menjadi "001")
        $newCategoryID = 'CAT-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        Category::create([
            'category_name' => $request->category_name,
            'category_ID' => $newCategoryID
        ]);

        // Setelah berhasil simpan, arahkan kembali ke halaman form tambah produk
        return redirect()->route('products.create')->with('success', 'Kategori baru berhasil ditambahkan!');
    }
}