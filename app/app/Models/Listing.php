<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    /**
     * Automatically generate a unique slug for the listing.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($listing) {
            // Create a slug for the listing
            $listing->slug = self::generateSlug($listing->name);
        });
    }

    public static function generateSlug($listing_name)
    {
        $slug = \Illuminate\Support\Str::slug($listing_name);
        $newSlug = $slug;

        $n = 1;
        while (\App\Models\Listing::whereSlug($newSlug)->exists()) {
            $newSlug = \Illuminate\Support\Str::slug($slug . '-' . $n++);
        }

        return $newSlug;
    }

    /**
     * Get the photos for the listing.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(ListingPhoto::class)->orderBy('order');
    }
}
