<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFee extends Model
{
    protected $fillable = [
        'position',
        'property_id',
        'name',
        'amount',
        'type',
    ];
}
