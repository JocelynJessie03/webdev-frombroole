<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Memproses data tambah kategori baru dari form instan di pop-up modal
    public function store(Request $request)
    {
        $request->validate([
            // Tambahkan validasi unique agar user tidak bisa input nama yang sama persis
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        // FIX UTAMA: Gunakan withTrashed() agar data yang di-soft delete tetap dihitung nomor ID-nya!
        $lastCategory = Category::withTrashed()->orderBy('category_ID', 'desc')->first();

        if ($lastCategory && $lastCategory->category_ID) {
            // Mengambil angka di belakang 'CAT-', contoh 'CAT-004' diambil angka 4
            $lastNumber = (int) substr($lastCategory->category_ID, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Generate ID baru secara berurutan tanpa takut duplikat (contoh: CAT-005)
        $newCategoryID = 'CAT-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        
        Category::create([
            'category_name' => $request->category_name,
            'category_ID' => $newCategoryID
        ]);

        return redirect()->back()->with('success', 'New Category Succesfully Added!');
    }

    // Memproses perubahan nama kategori dari inline modal
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,'.$id
        ]);

        $category = Category::findOrFail($id);
        
        $category->update([
            'category_name' => $request->category_name
        ]);

        return redirect()->back()->with('success', 'Category Succesfully Updated!');
    }

    // Memproses hapus kategori
    public function destroy($id)
    {
        // Gunakan withTrashed() saat mencari atau membuat kategori penampung
        $uncategorized = Category::withTrashed()->firstOrCreate(
            ['category_name' => 'Uncategorized'],
            ['category_ID' => 'CAT-000'] 
        );

        $category = Category::findOrFail($id);

        // JANGAN HAPUS jika yang mau dihapus adalah kategori penampung itu sendiri
        if ($category->id == $uncategorized->id) {
            return redirect()->back()->with('error', 'Uncategorized Cannot be Deleted!');
        }

        // Pindahkan semua produk dari kategori yang mau dihapus ke 'Uncategorized'
        DB::table('products')->where('category_id', $id)->update(['category_id' => $uncategorized->id]);
        // Perbaikan alur penghapusan ganda (Bawaan Laravel + Kolom manual kamu)
        $category->category_delete = true; // 1. Tandai kolom boolean manualmu
        $category->save();                 // 2. Simpan perubahannya dulu

        $category->delete();               // 3. Jalankan softDeletes bawaan Laravel (mengisi kolom deleted_at)

        return redirect()->back()->with('success', 'Category Succesfully Deleted and Products Moved to Uncategorized!');
    }
    public function restore($id)
{
    // Mencari kategori yang statusnya terhapus (soft deleted)
    $category = Category::withTrashed()->findOrFail($id);
    
    // Kembalikan statusnya menjadi aktif lagi
    $category->restore();
    
    // Kembalikan status boolean manual kamu ke false
    $category->category_delete = false;
    $category->save();

    return redirect()->back()->with('success', 'Old Category Succesfully Restored!');
}
    
}