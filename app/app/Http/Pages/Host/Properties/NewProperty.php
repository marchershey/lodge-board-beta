<?php

namespace App\Http\Pages\Host\Properties;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class NewProperty extends Component
{
    use WireToast, WithFileUploads;

    // Property
    public $property = [
        'listing' => [
            'description' => '',
            'guests' => null,
            'bedrooms' => null,
            'beds' => null,
            'bathrooms' => null
        ],
    ];
    public $amenities = [];
    public $pending_amenities = [];
    public $fees = [];
    public $temp_photos = [];

    protected function rules()
    {
        return [
            'property.name' => ['required', 'string', 'max:60', 'unique:properties.name'],
            'property.address.line_1' => ['required', 'string', 'max:250'],
            'property.address.line_2' => ['nullable', 'string', 'max:250'],
            'property.address.city' => ['required', 'string', 'max:250'],
            'property.address.state' => ['required', 'string', 'alpha', 'size:2'],
            'property.address.zip' => ['required', 'string', 'numeric', 'digits:5', 'regex:/^\d{5}$/'],
            'property.address.country' => ['required', 'string', 'alpha', 'size:2'],
            'property.listing.headline' => ['required', 'string', 'max:250'],
            'property.listing.description' => ['required', 'string', 'max:2000'],
            'property.listing.guests' => ['required', 'numeric', 'min:1', 'max:99'],
            'property.listing.bedrooms' => ['required', 'numeric', 'min:1', 'max:99'],
            'property.listing.beds' => ['required', 'numeric', 'min:1', 'max:99'],
            'property.listing.bathrooms' => ['required', 'numeric', 'min:1', 'max:99'],
            'property.listing.amenities' => ['required'],
            'property.listing.amenities.*' => [],
            'property.rates.base' => ['required', 'numeric'],
            'property.rates.tax' => ['required', 'numeric'],
            'property.rates.fees' => [''],
            'property.rates.fees.*' => [''],
            'property.rates.fees.*.name' => ['required', 'string', 'max:250'],
            'property.rates.fees.*.amount' => ['required', 'numeric'],
            'property.rates.fees.*.type' => ['required', 'string'],
            'property.photos' => [],
            'property.photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'extensions:jpg,jpeg,png,webp', 'max:6000'],
            'temp_photos' => [],
            'temp_photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'extensions:jpg,jpeg,png,webp', 'max:6000'],
            // 'property.options' => [''],
            'property.options.visibility' => [''],
        ];
    }

    protected function messages()
    {
        return [
            'property.rates.base.required' => 'Base rate required',
            'property' => [
                'name' => [
                    'required' => 'rquired'
                ],
                'rates' => [
                    'base' => [
                        'required' => 'test',
                    ]
                ]
            ],
        ];
    }

    protected function validationAttributes()
    {
        return [
            '' => '',
        ];
    }


    public function mount(): void
    {
        // Need to init this so the char counter will work.
        // WHAT?
    }

    public function render()
    {
        return view('pages.host.properties.new-property');
    }

    public function load(): void
    {
        $this->property = [
            'name' => '',
            'address' => [
                'street_1' => '',
                'street_2' => '',
                'city' => '',
                'state' => '',
                'postal' => '',
                'country' => '',
            ],
            'listing' => [
                'headline' => '',
                'description' => '',
                'guests' => 0,
                'bedrooms' => 0,
                'beds' => 0,
                'bathrooms' => 0,
                'amenities' => [],
            ],
            'rates' => [
                'base' => '',
                'tax' => '',
                'fees' => [],
            ],
            'photos' => [],
            'options' => [
                'visibility' => 'private',
            ],
        ];
    }

    public function reload(): void
    {
        $this->property = [];
        $this->load();
        $this->modal('reset-modal')->close();
    }


    /**
     * Amenities
     */
    public function openAmenitiesModal(): void
    {
        // Loading the amenities if not already
        if (!$this->amenities) {
            $this->amenities = AmenityGroup::all();
        }

        $this->pending_amenities = [];

        foreach ($this->property['listing']['amenities'] as $amenity_id => $amenity) {
            $this->pending_amenities[] = $amenity_id;
        }

        $this->modal('amenities-modal')->show();
    }

    public function updateAmenities(): void
    {
        // clear existing amenities
        $this->property['listing']['amenities'] = [];

        // Add amenities
        foreach ($this->pending_amenities as $pending_amenity_id) {
            $amenity = Amenity::find($pending_amenity_id);
            $this->property['listing']['amenities'][$amenity['id']] = $amenity;
        }

        $this->modal('amenities-modal')->close();
    }

    public function removeAmenity($amenity_id): void
    {
        // Unset the amenity
        unset($this->property['listing']['amenities'][$amenity_id]);
    }

    /**
     * Rates & Fees
     */

    public function addFee(): void
    {
        array_push($this->property['rates']['fees'], [
            'name' => '',
            'amount' => '',
            'type' => 'fixed',
        ]);
    }

    public function removeFee($key): void
    {
        unset($this->property['rates']['fees'][$key]);
    }

    /**
     * Photos
     */
    public function updatingTempPhotos($a, $b): void
    {
        toast()->debug($a)->push();
        toast()->debug($b)->push();
    }
    /**
     * When the user uploads photos, $temp_photos are cleared and only shows new photos.
     * This takes all photos from $temp_photos and adds them to $photos so when the user
     * uploads more photos, the previous photos are not cleared.
     *
     * @return void
     */
    function updatedTempPhotos(): void
    {
        // $this->validateOnly('temp_photos.*');
        foreach ($this->temp_photos as $temp_photo) {
            $this->property['photos'][] = $temp_photo;
        }

        $this->temp_photos = [];
    }

    /**
     * Runs when the user deletes a specific photo from the photo's grid
     *
     * @param int $key The array key of the photo the user wants to delete
     * @return void
     */
    public function deletePhoto($key): void
    {
        // remove the photo
        unset($this->property['photos'][$key]);

        // reset the array keys to
        $this->property['photos'] = array_values($this->property['photos']);
    }

    /**
     * Runs when the user reorders photos.
     *
     * @param array $data
     * @return void
     */
    function updatePhotoOrder(array $data): void
    {
        $this->property['photos'] = array_map(fn($item) => $this->property['photos'][$item['value']], $data);
        toast()->debug('test')->push();
    }

    /**
     * Submit
     */
    public function submit(): void
    {
        $this->validate();

        dd($this->property);
    }
}
