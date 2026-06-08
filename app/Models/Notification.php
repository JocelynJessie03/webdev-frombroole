<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use Syncable;

    protected $fillable = [

        'title',
        'message',
        'type',
        'is_read'

    ];
}