<?php

namespace App\Http\Pages\Setup\Steps;

use App\Models\Rental;
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
    public $photos = [];

    protected $rules = [
        'rental_name' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'rental_street' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[a-zA-Z0-9\s\-\#]+$/'],
        'rental_city' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'rental_state' => ['required', 'string', 'size:2', 'alpha'],
        'rental_zip' => ['required', 'string', 'digits:5', 'between:501,99734', 'numeric'],
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

        // Init the ability to sort photos
        // $this->dispatch('init-sortable-photos');
        // toast()->debug('Photos initialized')->push();
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

    function nextTab($step): void
    {
        toast()->debug($step)->push();

        switch ($step) {
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

    public function submit(): void
    {
        $validated = $this->validate();

        // Check if a rental already exists
        if (Rental::count() > 0) {
            // A rental record exists, so set that as active rental
            $rental = Rental::first();
        } else {
            // No rentals exists, create a new one.
            $rental = new Rental();
        }

        $rental->name = $this->rental_name;
        $rental->address_street = $this->rental_street;
        $rental->address_city = $this->rental_city;
        $rental->address_state = $this->rental_state;
        $rental->address_zip = $this->rental_zip;

        attempt(function ($rental) {
            if ($rental->save()) {
            } else {
                dd('no');
            }
        }, $rental, 'Adding first rental to database');
    }

    public function autofillTestData(): void
    {
        if (app()->isLocal()) {
            $this->rental_name = "Ohana Burnside";
            $this->rental_street = "23 S Highland Dr";
            $this->rental_city = "Burnside";
            $this->rental_state = "KY";
            $this->rental_zip = "42519";

            toast()->debug('Test Data filled')->push();
        }
    }
}
