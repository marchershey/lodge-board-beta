<?php

namespace App\Http\Pages\Setup\Steps;

use App\Models\Rental;
use App\Models\RentalPhoto;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads as SupportFileUploadsWithFileUploads;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class FirstRental extends Component
{
    use WireToast, SupportFileUploadsWithFileUploads;

    public $rental_name;
    public $rental_street;
    public $rental_city;
    public $rental_state;
    public $rental_zip;
    // public $photos = [];

    protected $rules = [
        'rental_name' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'rental_street' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[a-zA-Z0-9\s\-\#]+$/'],
        'rental_city' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'rental_state' => ['required', 'string', 'size:2', 'alpha'],
        'rental_zip' => ['required', 'string', 'digits:5', 'between:501,99734', 'numeric'],
        // 'photos.*' => ['required', 'image', 'mimes:png,jpeg,jpg,webp', 'max:12288']
    ];

    protected $validationAttributes = [
        'rental_name' => 'Rental Name',
        'rental_street' => 'Street Address',
        'rental_city' => 'City',
        'rental_state' => 'State',
        'rental_zip' => 'Zip Code',
    ];

    protected $messages = [
        'rental_name' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'rental_street' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'rental_city' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'rental_state' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'size' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'alpha' => 'The :attribute is invalid. (Stop it, you script kiddy)',
        ],
        'rental_zip' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'digits' => 'The :attribute is invalid.',
            'between' => 'The :attribute is invalid.',
            'numeric' => 'The :attribute is invalid.',

        ]
    ];

    public function render()
    {
        return view('pages.setup.steps.first-rental');
    }

    public function load()
    {
        // If in local mode, fill test data
        $this->autofillTestData();
    }

    public function autofillTestData(): void
    {
        if (app()->isLocal()) {
            $this->rental_name = "Ohana Burnside";
            $this->rental_street = "23 S Highland Dr";
            $this->rental_city = "Burnside";
            $this->rental_state = "KY";
            $this->rental_zip = "42519";

            toast()->debug('FirstRental test data filled.')->push();
        }
    }

    /**
     * Runs when a component has been updated/changed.
     * 
     * After validation, if a property is invalid then the user updates the property,
     * reset the property's validation, but do not rerun validation until the user
     * resubmits the form
     *
     * @param string $property
     * @param string $value
     * @return void
     */
    function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    function validateStep($currentStep): void
    {
        toast()->debug('Next Step...')->push();

        switch ($currentStep) {
            case 'name':
                $this->validateOnly('rental_name');
                break;
            case 'address':
                $this->validate();
                break;
        }

        $this->dispatch('next-tab');
    }

    public function upload($name): void
    {
        toast()->debug($name)->push();
    }

    public function deletePhoto($key): void
    {
        unset($this->photos[$key]);
        toast()->info('Photo was successfully removed.', 'Photo removed')->push();
    }

    function updatePhotoOrder(array $data): void
    {
        $this->photos = array_map(fn ($item) => $this->photos[$item['value']], $data);
    }

    public function submit(): void
    {
        // Validate the rental information
        $this->validate();

        // Check if a rental already exists
        if (Rental::count() > 0) {
            // A rental exists, so set that as active rental
            $rental = Rental::first();
        } else {
            // No rentals exists, create a new one.
            $rental = new Rental();
        }

        // Update the rental's information
        $rental->name = ucwords($this->rental_name);
        $rental->address_street = ucwords($this->rental_street);
        $rental->address_city = ucwords($this->rental_city);
        $rental->address_state = $this->rental_state;
        $rental->address_zip = $this->rental_zip;

        // Save the rental
        $rental->save();

        // Save temp photos
        foreach ($this->photos as $order => $photo) {
            // Upload photo
            $path = $photo->store($rental->id, 'photos');

            $data = [
                'url' => '/photos/' . $rental->id . '/' . $photo->hashName(),
                'path' => $path,
                'hashName' => $photo->hashName(),
                'extension' => $photo->extension(),
                'origName' => $photo->getClientOriginalName(),
                'origExtension' => $photo->getClientOriginalExtension(),
                'size' => $photo->getSize(),
                'mime' => $photo->getMimeType(),
                'rental_id' => $rental->id,
                'user_id' => auth()->user()->id,
                'order' => $order,
            ];

            RentalPhoto::create($data);
        }

        $this->dispatch('next-step');
    }
}
