<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(AmenityGroup::class);
    }

    public static function getPrimaryAmenities(): array
    {
        return self::where('primary', true)->get()->toArray();
    }
}
