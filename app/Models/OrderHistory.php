<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use Syncable;

    // Tambahkan points_used dan promo_code, serta payment_status
    protected $fillable = [
        'order_id', 'customer_id', 'order_date', 'total_items', 
        'total_price', 'status', 'payment_method', 'payment_status',
        'points_used', 'promo_code' 
    ];
    
    protected $casts = [
        'order_date' => 'datetime',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}