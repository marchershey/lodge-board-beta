<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * Automatically generate a unique slug for the property.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            // Create a slug for the property
            $property->slug = self::generateSlug($property->name);
        });
    }

    public static function generateSlug($property_name)
    {
        $slug = \Illuminate\Support\Str::slug($property_name);
        $newSlug = $slug;

        $n = 1;
        while (\App\Models\Property::whereSlug($newSlug)->exists()) {
            $newSlug = \Illuminate\Support\Str::slug($slug . '-' . $n++);
        }

        return $newSlug;
    }

    /**
     * Get the photos for the property.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhoto::class)->orderBy('order');
    }
}
