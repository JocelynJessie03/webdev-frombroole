<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'stock',
        'unit'
    ];

    /**
     * Relasi balik ke Product
     * Untuk melihat bahan ini dipakai di produk apa saja
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'ingredient_product')
                    ->withPivot('amount_needed')
                    ->withTimestamps();
    }
    public function getIsLowStockAttribute()
    {
        return match ($this->unit) {
            'pcs'  => $this->stock <= 100,
            'ml'   => $this->stock <= 2000,
            'gr'   => $this->stock <= 2000,
            'pack' => $this->stock <= 5, // Tambahan untuk unit pack
            default => $this->stock <= 10,
        };
    }
}