<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'pro_ID';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'pro_ID',
        'pro_name',
        'pro_description',
        'pro_price',
        'pro_currstock',
        'pro_delete'
    ];
}