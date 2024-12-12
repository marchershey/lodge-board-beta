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

    // public static function getPrimaryAmenities(): mixed
    // {
    //     return self::where('primary', true)->get();
    // }

    // public static function getOtherAmenities(): mixed
    // {
    //     return self::where('primary', false)->get();
    // }

    // public static function getSortedAmenities(): mixed
    // {
    //     $groups = self::all()->groupBy('group_id')->mapWithKeys(function ($amenities, $group_id) {
    //         return [AmenityGroup::find($group_id)->name => $amenities];
    //     });

    //     return $groups;
    // }
}
