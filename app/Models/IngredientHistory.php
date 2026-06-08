<?php

namespace App\Models;

use App\Traits\Syncable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientHistory extends Model
{
    use Syncable;

    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'amount',
        'type',
        'date'
    ];
}