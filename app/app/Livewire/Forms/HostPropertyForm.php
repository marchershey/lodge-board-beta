<?php

namespace App\Livewire\Forms;

use App\Models\Amenity;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HostPropertyForm extends Form
{
    // Basic
    #[Validate('required|string|max:250|unique:properties,name', as: 'property name')]
    public $name;

    #[Validate('required|string|max:250', as: 'street address')]
    public $address_line1;

    #[Validate('nullable|string|max:250', as: 'address line 2')]
    public $address_line2;

    #[Validate('required|string|max:250', as: 'city')]
    public $address_city;

    #[Validate('required|string|alpha|size:2', as: 'state')]
    public $address_state;

    #[Validate('required|string|numeric|digits:5|regex:/^\d{5}$/', as: 'zip / postal code', onUpdate: false)]
    public $address_postal;

    #[Validate('required|string|alpha|size:2', as: 'country')]
    public $address_country;


    // Listing

    #[Validate('required|string|max:250', as: 'headline')]
    public $listing_headline;

    #[Validate('required|string|max:3000', as: 'description')]
    public $listing_description;

    #[Validate('required|integer|numeric|min:1|max:16', as: 'guest count')]
    public $guest_count;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bed count')]
    public $bed_count;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bedroom count')]
    public $bedroom_count;

    #[Validate('required|decimal:0,1|numeric|min:0|max:99', as: 'bathroom count')]
    public $bathroom_count;

    #[Validate('required|string', as: 'property type')]
    public $property_type;

    // #[Validate('required|array', as: 'amenities')]
    #[Validate([
        'amenities' => 'required|array',
        'amenities.*' => 'required|integer'
    ], as: [
        'amenities' => 'amenities',
        'amenities.*' => 'amenities',
    ])]
    public $amenities;

    // Rates
    #[Validate('required|', as: '')]
    public $base_rate;

    #[Validate('required|', as: '')]
    public $tax_rate;

    #[Validate('required|', as: '')]
    public $fees;
    // Photos
    #[Validate('required|', as: '')]
    public $temp_photos;

    #[Validate('required|', as: '')]
    public $selected_photos;

    // Options
    #[Validate('required|', as: '')]
    public $duration_min;

    #[Validate('required|', as: '')]
    public $duration_max;

    #[Validate('required|', as: '')]
    public $slug;

    #[Validate('required|', as: '')]
    public $visibility;

    #[Validate('required|', as: '')]
    public $calendar_color;
}
