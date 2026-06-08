<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use Syncable;

    use HasFactory;

    // Mass assignment agar bisa disimpan secara batch/massal
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_at_purchase',
        'sugar_level'
    ];

    /**
     * Relasi balik ke OrderHistory
     */
    public function order()
    {
        return $this->belongsTo(OrderHistory::class, 'order_id');
    }

    /**
     * Relasi ke Product
     * Digunakan agar kita tahu nama produk apa yang dibeli di item ini
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}