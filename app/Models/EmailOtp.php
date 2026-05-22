<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'otp',
    'expires_at',
    ];
}