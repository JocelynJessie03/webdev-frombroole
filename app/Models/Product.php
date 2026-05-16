<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    // Nama tabel (jika di DB namanya 'product' tanpa 's', aktifkan baris bawah)
    // protected $table = 'products'; 

    protected $fillable = [
        'pro_ID',
        'pro_name',
        'pro_description',
        'pro_price',
        'pro_image',
        'category_id' // Pastikan ini ada untuk relasi ke kategori
    ];

    /**
     * Relasi ke Ingredient (Bahan Baku)
     * withPivot digunakan agar kita bisa mengambil kolom 'amount_needed' di tabel perantara
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_product')
                    ->withPivot('amount_needed')
                    ->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getStatusAttribute()
    {
        // Jika stok 0
        if ($this->stock <= 0) return 'Out of Stock';
        
        // Jika stok di bawah 10 (standar untuk produk jadi)
        if ($this->stock <= 10) return 'Low Stock';
        
        return 'In Stock';
    }
}