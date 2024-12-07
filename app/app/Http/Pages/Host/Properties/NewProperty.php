<?php

namespace App\Http\Pages\Host\Properties;

use App\Livewire\Forms\HostPropertyForm;
use App\Models\Amenity;
use App\Models\AmenityGroup;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class NewProperty extends Component
{
    use WireToast, WithFileUploads;

    public HostPropertyForm $form;
    public Collection $all_amenities;
    public $selected_amenities;
    public $temp_photos;

    // protected function rules()
    // {
    //     return [
    //         'property.name' => ['required', 'string', 'max:60', 'unique:properties.name'],
    //         'property.address.line_1' => ['required', 'string', 'max:250'],
    //         'property.address.line_2' => ['nullable', 'string', 'max:250'],
    //         'property.address.city' => ['required', 'string', 'max:250'],
    //         'property.address.state' => ['required', 'string', 'alpha', 'size:2'],
    //         'property.address.postal' => ['required', 'string', 'numeric', 'digits:5', 'regex:/^\d{5}$/'],
    //         'property.address.country' => ['required', 'string', 'alpha', 'size:2'],
    //         // Listing
    //         'property.listing.type' => ['required'],
    //         'property.listing.headline' => ['required', 'string', 'max:250'],
    //         'property.listing.description' => ['nullable', 'string', 'max:3000'],
    //         'property.listing.guests' => ['required', 'numeric', 'min:1', 'max:16'],
    //         'property.listing.beds' => ['required', 'numeric', 'min:0', 'max:99'],
    //         'property.listing.bedrooms' => ['required', 'numeric', 'min:0', 'max:99'],
    //         'property.listing.bathrooms' => ['required', 'numeric', 'min:0', 'max:99'],
    //         'property.listing.amenities' => ['required'],
    //         'property.listing.amenities.*' => [],
    //         // Pricing
    //         'property.rates.base' => ['required', 'numeric'],
    //         'property.rates.tax' => ['required', 'numeric'],
    //         'property.rates.fees' => [''],
    //         'property.rates.fees.*' => [''],
    //         'property.rates.fees.*.name' => ['required', 'string', 'max:250'],
    //         'property.rates.fees.*.amount' => ['required', 'numeric'],
    //         'property.rates.fees.*.type' => ['required', 'string'],
    //         'property.photos' => ['required'],
    //         'property.photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'extensions:jpg,jpeg,png,webp', 'max:6144'],
    //         'temp_photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'extensions:jpg,jpeg,png,webp', 'max:6144'],
    //         'property.options.visibility' => ['required'],
    //         'property.options.min-nights' => ['required', 'numeric', 'min:1', 'max:30'],
    //         'property.options.max-nights' => ['required', 'numeric', 'min:1', 'max:30'],
    //         'property.options.slug' => ['required'],
    //         'property.options.color' => ['required'],
    //     ];
    // }

    // protected function messages()
    // {
    //     return [
    //         'property.rates.base.required' => 'Base rate required',
    //         'property.rates.tax.required' => 'Tax rate required',
    //     ];
    // }

    // protected function validationAttributes()
    // {
    //     return [
    //         'property.name' => 'Property Name',
    //         'property.address.line_1' => 'Address Line 1',
    //         'property.address.line_2' => 'Address Line 2',
    //         'property.address.city' => 'City',
    //         'property.address.state' => 'State',
    //         'property.address.postal' => 'ZIP Code',
    //         'property.address.country' => 'Country',
    //         'property.listing.headline' => 'Listing Headline',
    //         'property.listing.description' => 'Listing Description',

    //         'property.listing.guests' => 'number of guests',
    //         'property.listing.beds' => 'number of beds',
    //         'property.listing.bedrooms' => 'number of bedrooms',
    //         'property.listing.bathrooms' => 'number of bathrooms',

    //         'property.listing.amenities' => 'amenities',
    //         'property.listing.amenities.*' => 'amenity',
    //         'property.rates.base' => 'base rate',
    //         'property.rates.tax' => 'tax rate',
    //         'property.rates.fees' => 'fees',
    //         'property.rates.fees.*' => 'fee',
    //         'property.rates.fees.*.name' => 'fee name',
    //         'property.rates.fees.*.amount' => 'fee amount',
    //         'property.rates.fees.*.type' => 'fee type',
    //         'property.photos' => 'photos',
    //         'property.photos.*' => 'photo',
    //         'temp_photos.*' => 'photo',
    //         'property.options.visibility' => 'visibility',
    //         'property.options.min-nights' => 'minimum nights',
    //         'property.options.max-nights' => 'maximum nights',
    //     ];
    // }


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

        $this->loadAmenities();
        // $this->property = [
        //     'name' => '',
        //     'address' => [
        //         'street_1' => '',
        //         'street_2' => '',
        //         'city' => '',
        //         'state' => '',
        //         'postal' => '',
        //         'country' => '',
        //     ],
        //     'listing' => [
        //         'headline' => '',
        //         'description' => '',
        //         'guests' => 1,
        //         'beds' => 0,
        //         'bedrooms' => 0,
        //         'bathrooms' => 0,
        //         'amenities' => [],
        //     ],
        //     'rates' => [
        //         'base' => '',
        //         'tax' => '',
        //         'fees' => [],
        //     ],
        //     'photos' => [],
        //     'options' => [
        //         'duration-min' => 1,
        //         'duration-max' => 14,
        //         'visibility' => 'private',
        //     ],
        // ];
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
    public function loadAmenities(): void
    {
        $this->all_amenities = AmenityGroup::with('amenities')->get();
        $this->form->amenities = [];
    }
    public function openAmenitiesModal(): void
    {
        // Loading the amenities if not already
        if (!$this->all_amenities) {
            $this->loadAmenities();
        }

        $this->selected_amenities = [];

        foreach ($this->form->amenities as $amenity) {
            $this->selected_amenities[] = $amenity->id;
        }

        $this->modal('amenities-modal')->show();
    }

    /**
     * ! asdf
     */
    public function updateAmenities(): void
    {
        $this->form->reset('amenities');

        $selected_amenities = $this->selected_amenities;
        $this->form->amenities = $this->all_amenities->flatMap(function ($amenity_group) use ($selected_amenities) {
            return $amenity_group->amenities->filter(function ($amenity) use ($selected_amenities) {
                return in_array($amenity->id, $selected_amenities);
            });
        });

        $this->validateOnly('amenities');

        $this->modal('amenities-modal')->close();
    }

    public function removeAmenity($amenity_id): void
    {
        $this->form->amenities = $this->form->amenities->filter(function ($amenity) use ($amenity_id) {
            return $amenity->id != $amenity_id;
        });
    }

    /**
     * Rates & Fees
     */

    public function addFee(): void
    {
        array_push($this->form->fees, [
            'name' => '',
            'amount' => '',
            'type' => 'fixed',
        ]);
    }

    public function removeFee($key): void
    {
        unset($this->form->fees[$key]);
    }

    /**
     * Photos
     *
     * When the user uploads photos, $temp_photos are cleared and only shows new photos.
     * This takes all photos from $temp_photos and adds them to $photos so when the user
     * uploads more photos, the previous photos are not cleared.
     *
     * @return void
     */
    function updatedTempPhotos(): void
    {
        $this->validateOnly('temp_photos.*');

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
