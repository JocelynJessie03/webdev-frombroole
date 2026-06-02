<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'minimum_purchase',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'expires_at' => 'date',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isAvailable(): bool
    {
        if (! $this->is_active) return false;
        if ($this->isExpired()) return false;
        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) return false;
        return true;
    }
}