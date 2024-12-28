<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_line1',
        'address_line2',
        'address_city',
        'address_state',
        'address_postal',
        'address_country',
        'listing_headline',
        'listing_description',
        'type_id',
        'guest_count',
        'bed_count',
        'bedroom_count',
        'bathroom_count',
        'base_rate',
        'tax_rate',
        'slug',
        'calendar_color',
        'duration_min',
        'duration_max',
        'visibility',
        'host_id',
    ];

    /**
     * Automatically generate a unique slug for the property.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            /**
             * Create the slug based off of the property name
             * ! No longer works due to creating model before having property name.
             * TODO: Need to figure out a way to do this after property has been created
             */
            // $property->slug = self::generateSlug($property->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the photos for the property.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhoto::class)->orderBy('position');
    }

    /**
     * Generate a slug based off of the Property's name
     */
    public static function generateSlug(string $property_name): string
    {
        $slug = Str::slug($property_name);
        $newSlug = $slug;

        $n = 1;

        while (\App\Models\Property::whereSlug($newSlug)->exists()) {
            $newSlug = Str::slug($slug . '-' . $n++);
        }

        return $newSlug;
    }

    // /**
    //  * Return a new or existing property
    //  *
    //  * To prevent a bunch of empty properties in the database, this function checks
    //  * if a property exists in the database that is in progress but doesn't have a name.
    //  * If a property is in progress but has a name, it will be displayed on the property
    //  * index, so no need to return it.
    //  *
    //  * @return Property
    //  */
    // public static function startNewProperty(): Property
    // {
    //     return self::firstOrCreate([
    //         'in_progress' => true,
    //     ]);

    //     // return ($property) ? $property : self::create();
    // }

    public static function saveProperty($form): void
    {
        dd($form);
    }
}
