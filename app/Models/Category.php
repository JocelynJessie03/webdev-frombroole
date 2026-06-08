<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Syncable;

    use SoftDeletes;
    protected $fillable = ['category_name', 'category_ID'];
    
    // Relasi: Satu kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}