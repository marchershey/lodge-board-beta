<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'path',
        'disk_path',
        'name',
        'extension',
        'size',
        'mime',
        'orig_name',
        'orig_extension',
        'dimensions',
        'property_id',
        'user_id',
        'position',
    ];

    /**
     * Encode / Decode the dimensions json
     */
    protected function dimensions(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
