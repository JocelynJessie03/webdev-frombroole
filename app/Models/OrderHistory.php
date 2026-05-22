<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderHistory extends Model
{
    protected $fillable = ['order_id', 'customer_id', 'order_date', 'total_items', 'total_price', 'status'];
    protected $casts = [
    'order_date' => 'datetime',];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
    return $this->hasMany(OrderItem::class, 'order_id');
    }
}
