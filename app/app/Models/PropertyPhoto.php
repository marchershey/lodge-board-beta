<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'path',
        'hashName',
        'extension',
        'origName',
        'origExtension',
        'size',
        'mime',
        'property_id',
        'user_id',
        'order',
    ];
}
