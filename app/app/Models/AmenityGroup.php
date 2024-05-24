<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityGroup extends Model
{
    use HasFactory;

    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'group_id');
    }
}
