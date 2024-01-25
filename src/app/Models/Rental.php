<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    /**
     * Automatically generate a unique slug for the rental.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($rental) {
            // Create a slug for the rental
            $rental->slug = self::generateSlug($rental->name);
        });
    }

    public static function generateSlug($rental_name)
    {
        $slug = \Illuminate\Support\Str::slug($rental_name);
        $newSlug = $slug;

        $n = 1;
        while (\App\Models\Rental::whereSlug($newSlug)->exists()) {
            $newSlug = \Illuminate\Support\Str::slug($slug . '-' . $n++);
        }

        return $newSlug;
    }
}
