<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    'customer_ID', 'customer_name', 'email', 'phone', 'password',
    'total_spend', 'member_points', 'progress_percentage', 'tier'
    ];
    public function orders()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
