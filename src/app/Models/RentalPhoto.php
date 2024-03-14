<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPhoto extends Model
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
        'rental_id',
        'user_id',
        'order',
    ];
}
