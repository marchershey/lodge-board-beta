<?php

namespace App\Forms;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyFee;
use App\Models\PropertyPhoto;
use App\Traits\WithValidationToasts;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HostPropertyForm extends Form
{
    use WithValidationToasts;

    // Basic
    #[Validate('required|string|max:250|unique:properties,name', as: 'property name')]
    public string $name;

    #[Validate('required|string|max:250', as: 'street address')]
    public string $address_line1;

    #[Validate('nullable|string|max:250', as: 'address line 2')]
    public string $address_line2;

    #[Validate('required|string|max:250', as: 'city')]
    public string $address_city;

    #[Validate('required|string|alpha|size:2', as: 'state')]
    public string $address_state;

    /**
     * HAS MAKS
     *
     * If it has a mask, it must be declared as string
     * https://github.com/livewire/flux/issues/829
     */
    #[Validate('required|string|numeric|digits:5|regex:/^\d{5}$/', as: 'zip / postal code')]
    public string $address_postal = '';

    #[Validate('required|string|alpha|size:2', as: 'country')]
    public string $address_country;

    // Listing
    #[Validate('required|string|max:250', as: 'headline')]
    public string $listing_headline;

    /**
     * Must declare due to character counter
     */
    #[Validate('required|string|max:3000', as: 'description')]
    public string $listing_description = '';

    #[Validate('required|integer|exists:App\Models\PropertyType,id', as: 'property type')]
    public int $property_type;

    // #[Validate('required|array', as: 'amenities')]
    #[Validate([
        'amenities' => 'required|array',
        'amenities.*' => 'required',
    ], as: [
        'amenities' => 'amenities',
        'amenities.*' => 'amenity item',
    ], message: [
        'amenities.required' => 'Amenities are required.',
    ])]
    public array $amenities = [];

    #[Validate('required|integer|numeric|min:1|max:16', as: 'guest count')]
    public int $guest_count = 1;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bed count')]
    public int $bed_count = 0;

    #[Validate('required|integer|numeric|min:0|max:99', as: 'bedroom count')]
    public int $bedroom_count = 0;

    #[Validate('required|numeric|min:0|max:9.5', as: 'bathroom count')]
    public float $bathroom_count = 0;

    // Rates

    /**
     * HAS MAKS
     *
     * If it has a mask, it must be declared as string
     * https://github.com/livewire/flux/issues/829
     */
    #[Validate([
        'base_rate' => [
            'required',
            'numeric',
            'min:1',
            'max:1000',
            'regex:/^(0|[1-9]\d{0,2}(,\d{3})*)(\.\d{1,2})?$/',
        ],
    ])]
    public ?string $base_rate = '';

    #[Validate('required|numeric|min:0|max:99', as: 'tax rate')]
    public int|string|null $tax_rate = '';

    #[Validate([
        'fees' => 'nullable|array',
        'fees.*' => 'array:name,amount,type',
        'fees.*.name' => 'required|string|max:250',
        'fees.*.amount' => 'required|numeric|min:0|max:1000|decimal:0,2',
        'fees.*.type' => 'required|in:fixed,variable',
    ], as: [
        'fees.*.name' => 'fee name',
        'fees.*.amount' => 'fee amount',
        'fees.*.type' => 'fee type',
    ])]
    public $fees;

    // Photos
    // #[Validate([
    //     'photos' => 'nullable|array',
    //     'photos.*' => 'image|mimetypes:image/jpeg,image/jpg,image/png,image/webp,image/bmp|mimes:jpg,jpeg,png,webp,bmp|extensions:jpg,jpeg,png,webp,bmp|max:12288',
    // ], message: [
    //     'photos.*.image' => 'Only image files are permitted for upload.',
    //     'photos.*.max' => 'Uploaded images can not exceed a max file size of 12MB.',
    //     'photos.*.mimes' => '1Images must be in a common image format. (e.g., jpeg, jpg, png, webp, and bmp)',
    //     'photos.*.extensions' => '2Images must be in a common image format. (e.g., jpeg, jpg, png, webp, and bmp)',
    // ], as: [
    //     'photos' => 'selected photos',
    //     'photos.*' => 'selected photo',
    // ], attribute: [
    //     'photos' => 'selected photos',
    //     'photos.*' => 'selected photo',
    // ])]
    public array $photos = [];

    // Options
    #[Validate('required|string|max:250|unique:properties,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', as: 'url', onUpdate: false)]
    public ?string $slug;

    #[Validate('required|integer|min:1|max:99', as: 'minimum nights')]
    public int $duration_min = 1;

    #[Validate('required|integer|min:1|max:99', as: 'maximum nights')]
    public int $duration_max = 14;

    #[Validate('required|string|in:private,unlisted,public', as: 'visibility')]
    public ?string $visibility;

    #[Validate('required|regex:/^#[0-9A-Fa-f]{6}$/', as: 'color')]
    public string $calendar_color = '#2563eb';

    public function loadDevData(): void
    {
        $rand = rand(100, 999);

        // Basic information
        $this->name = 'Sunset Cabin-' . $rand;
        $this->address_line1 = '123 Main St';
        $this->address_line2 = '';
        $this->address_city = 'San Francisco';
        $this->address_state = 'AL';
        $this->address_postal = '12345';
        $this->address_country = 'US';

        // Listing information
        $this->listing_headline = 'An amazing summer getaway!';
        $this->listing_description = '<p>This is the listing description for Sunset Cabin, located in San Francisco, AL. </p>';
        $this->property_type = 7;

        // Amenities
        $amenities = Amenity::all()->random(\rand(5, 30));

        foreach ($amenities as $amenity) {
            $this->amenities[] = $amenity;
        }

        // Counts
        $this->guest_count = 8;
        $this->bed_count = 4;
        $this->bedroom_count = 4;
        $this->bathroom_count = 3.5;

        // Rates & Fees
        $this->base_rate = '320';
        $this->tax_rate = '7';
        $this->fees = [
            [
                'name' => 'Cleaning fee',
                'amount' => 150,
                'type' => 'fixed',
            ],
            [
                'name' => 'Admin fee',
                'amount' => 5,
                'type' => 'variable',
            ],
        ];

        // Photos
        // We'll come back to this

        // Options
        $this->slug = 'sunset-cabin-' . $rand;
        $this->calendar_color = '#ff6700';
        $this->duration_min = 3;
        $this->duration_max = 30;
        $this->visibility = 'public';
    }

    public function saveProperty(): Property
    {
        // Validate all form data
        $validated = $this->validate();

        $property = Property::create([
            'name' => $validated['name'],
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'],
            'address_city' => $validated['address_city'],
            'address_state' => $validated['address_state'],
            'address_postal' => $validated['address_postal'],
            'address_country' => $validated['address_country'],
            'listing_headline' => $validated['listing_headline'],
            'listing_description' => $validated['listing_description'],
            'type_id' => $validated['property_type'],
            'guest_count' => $validated['guest_count'],
            'bed_count' => $validated['bed_count'],
            'bedroom_count' => $validated['bedroom_count'],
            'bathroom_count' => $validated['bathroom_count'],
            'base_rate' => $validated['base_rate'],
            'tax_rate' => $validated['tax_rate'],
            'slug' => $validated['slug'],
            'calendar_color' => $validated['calendar_color'],
            'duration_min' => $validated['duration_min'],
            'duration_max' => $validated['duration_max'],
            'visibility' => $validated['visibility'],
            'host_id' => auth()->user()->id,
        ]);

        // Amenities
        foreach ($this->amenities as $amenity) {
            $amenity = PropertyAmenity::create([
                'property_id' => $property->id,
                'amenity_id' => $amenity->id,
            ]);
        }

        // Fees
        foreach ($this->fees as $position => $fee) {
            $fee = PropertyFee::create([
                'position' => (int) $position,
                'property_id' => $property->id,
                'name' => $fee['name'],
                'amount' => $fee['amount'],
                'type' => $fee['type'],
            ]);
        }

        // Photos
        foreach ($this->photos as $position => $temp_photo) {
            $path = $temp_photo->store(path: 'photos');

            $photo = PropertyPhoto::create([
                'url' => settings()->site_url . '/' . $path,
                'path' => $path,
                'disk_path' => Storage::path($path),
                'name' => $temp_photo->hashName(),
                'extension' => $temp_photo->extension(),
                'size' => $temp_photo->getSize(),
                'mime' => $temp_photo->getMimeType(),
                'orig_name' => $temp_photo->getClientOriginalName(),
                'orig_extension' => $temp_photo->getClientOriginalExtension(),
                'dimensions' => $temp_photo->dimensions(),
                'property_id' => $property->id,
                'user_id' => auth()->user()->id,
                'position' => $position,
            ]);
        }

        return $property;

        // $results = Property::saveProperty($this->all());
    }
}
