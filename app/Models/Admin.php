<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Agar bisa login
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Helper untuk cek apakah dia Super Admin
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    // Helper untuk cek apakah dia Admin Biasa
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}