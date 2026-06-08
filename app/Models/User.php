<?php

namespace App\Models;

use App\Traits\Syncable;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Syncable;

    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'google_id',
    'avatar',
    'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the associated customer record (matched by email)
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'email', 'email');
    }

    /**
     * Get all orders for this user through the customer relationship
     */
    public function orders()
    {
        // Get the customer associated with this user's email
        $customer = Customer::Query()->where('email', $this->email)->first();
        
        if (!$customer) {
            // Return empty collection if no customer found
            return collect();
        }
        
        return $customer->orders();
    }

    /**
     * Get all tasks for this user through the customer relationship
     */
    public function tasks()
    {
        // Get the customer associated with this user's email
        $customer = Customer::Query()->where('email', $this->email)->first();
        
        if (!$customer) {
            // Return empty collection if no customer found
            return collect();
        }
        
        return $customer->tasks();
    }

    /**
     * Access customer attributes as if they were on the user
     */
    public function __get($key)
    {
        // First check if this is a user attribute
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key] ?? null;
        }

        // If not, try to get from the associated customer
        $customer = Customer::Query()->where('email', $this->email)->first();
        if ($customer && isset($customer->$key)) {
            return $customer->$key;
        }

        return null;
    }
}
