<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use Syncable;

    protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'otp',
    'expires_at',
    ];
}