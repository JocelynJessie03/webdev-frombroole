<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use Syncable;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
        'status'
    ];
}
