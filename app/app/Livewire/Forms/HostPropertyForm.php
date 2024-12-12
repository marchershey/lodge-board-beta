<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class HostPropertyForm extends Form
{
    // Basic
    #[Validate('required|string|max:250|unique:properties,name', as: 'property name')]
    public ?string $name;

    #[Validate('required|string|max:250', as: 'street address')]
    public ?string $address_line1;

    #[Validate('nullable|string|max:250', as: 'address line 2')]
    public ?string $address_line2;

    #[Validate('required|string|max:250', as: 'city')]
    public ?string $address_city;

    #[Validate('required|string|alpha|size:2', as: 'state')]
    public ?string $address_state;

    #[Validate('required|string|numeric|digits:5|regex:/^\d{5}$/', as: 'zip / postal code')]
    public $address_postal = "";
    // would love to make this "public ?int $address_postal" but... https://github.com/livewire/flux/issues/829

    #[Validate('required|string|alpha|size:2', as: 'country')]
    public ?string $address_country;


    // Listing
    #[Validate('required|string|max:250', as: 'headline')]
    public ?string $listing_headline;

    #[Validate('required|string|max:3000', as: 'description')]
    public string $listing_description = "";

    #[Validate('required|integer|numeric|min:1|max:16', as: 'guest count')]
    public int $guest_count = 1;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bed count')]
    public int $bed_count = 0;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bedroom count')]
    public int $bedroom_count = 0;

    #[Validate('required|decimal:0,1|numeric|min:0|max:99', as: 'bathroom count')]
    public int $bathroom_count = 0;

    #[Validate('required|integer|exists:App\Models\PropertyType,id', as: 'property type')]
    public ?int $property_type;

    // #[Validate('required|array', as: 'amenities')]
    #[Validate([
        'amenities' => 'required|array',
        'amenities.*' => 'required'
    ], as: [
        'amenities' => 'amenities',
        'amenities.*' => 'amenity item',
    ], message: [
        'amenities.required' => 'Amenities are required.',
    ])]
    public array $amenities = [];

    // Rates
    #[Validate('required|numeric|min:1|max:1000|decimal:0,2', as: 'base rate')]
    public int|string $base_rate = "";

    #[Validate('required|numeric|min:0|max:99', as: 'tax rate')]
    public int|string $tax_rate = "";

    #[Validate([
        'fees' => 'nullable|array:name,amount,type',
        'fees.*.name' => 'required|string|max:250',
        'fees.*.amount' => 'required|numeric|min:0|max:1000|decimal:0,2',
        'fees.*.type' => 'required|in:fixed,variable',
    ], as: [
        'fees.*.name' => 'fee name',
        'fees.*.amount' => 'fee amount',
        'fees.*.type' => 'fee type',
    ])]
    public array $fees = [];

    // Photos
    #[Validate([
        'photos' => 'required',
        'photos.*' => 'required|image|mimes:jpg,jpeg,png,webp,bmp|extensions:jpg,jpeg,png,webp,bmp|max:10240',
    ], as: [
        'photos.' => 'photos',
        'photos.*' => 'photo',
    ])]
    public array $photos = [];

    // Options
    #[Validate('required|string|max:250|unique:properties,slug|regex:^[a-z0-9]+(?:-[a-z0-9]+)*$', as: 'url', onUpdate: false)]
    public ?string $slug;

    #[Validate('required|integer|min:1|max:99', as: 'minimum nights')]
    public int $duration_min = 1;

    #[Validate('required|integer|min:1|max:99', as: 'maximum nights')]
    public int $duration_max = 14;

    #[Validate('required|string|in:private,unlisted,public', as: 'visibility')]
    public ?string $visibility;

    #[Validate('required|regex:/^#[0-9A-Fa-f]{6}$/', as: 'color')]
    public string $calendar_color = "#2563eb";
}
