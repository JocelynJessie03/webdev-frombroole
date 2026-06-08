<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use Syncable;

    protected $fillable = [
        'title',
        'description',
        'required_tier',
        'task_type',
        'points_reward',
        'coupon_code',
        'is_active',
        'min_purchases_required',
        'order_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'task_type' => 'string',
    ];

    // Tier hierarchy: Bronze < Silver < Gold
    public static array $tierRank = [
        'Bronze' => 1,
        'Silver' => 2,
        'Gold'   => 3,
    ];

    /**
     * Check if a customer tier unlocks this task.
     * Gold unlocks all; Bronze only unlocks Bronze tasks, etc.
     */
    public function isUnlockedFor(string|null $customerTier): bool
    {
        if (!$customerTier) {
            return false;
        }

        $customerRank = self::$tierRank[$customerTier] ?? 0;
        $requiredRank = self::$tierRank[$this->required_tier] ?? 99;

        return $customerRank >= $requiredRank;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'task_product');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_task')
            ->withPivot(['status', 'coupon_code', 'claimed_at', 'used_at'])
            ->withTimestamps();
    }
}