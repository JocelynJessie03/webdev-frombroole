<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Customer extends Model
{
    use Syncable;

    protected $fillable = [
    'customer_ID', 'customer_name', 'email', 'phone', 'password',
    'total_spend', 'member_points', 'progress_percentage', 'tier'
    ];
    public function orders()
    {
        return $this->hasMany(OrderHistory::class);
    }
 public function tasks() {
    return $this->belongsToMany(Task::class, 'customer_task')->withPivot(['status', 'coupon_code', 'claimed_at', 'used_at'])->withTimestamps();
}
}