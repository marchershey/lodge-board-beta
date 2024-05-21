<?php

namespace App\Http\Pages\Setup;

use App\Models\Rental;
use Livewire\Attributes\Layout;
use Livewire\Component;

class FirstRental extends Component
{
    public string $rental_name;
    // public string $rental_type;
    public string $rental_street;
    public string $rental_city;
    public string $rental_state;
    public string $rental_zip;

    protected $rules = [
        'rental_name' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        // 'rental_type' => ['required', 'string', 'numeric'],
        'rental_street' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[a-zA-Z0-9\s\-\#]+$/'],
        'rental_city' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'rental_state' => ['required', 'string', 'size:2', 'alpha'],
        'rental_zip' => ['required', 'string', 'digits:5', 'between:501,99734', 'numeric'],
    ];

    protected $validationAttributes = [
        'rental_name' => 'Rental Name',
        // 'rental_type' => 'Rental Type',
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
        // 'rental_type' => [
        //     'required' => 'The :attribute is required.',
        //     'integer' => 'Invalid :attribute',
        //     'numeric' => 'Invalid :attribute',
        // ],
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
            'int' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'digits' => 'The :attribute is invalid.',
            'between' => 'The :attribute is invalid.',
            'numeric' => 'The :attribute is invalid.',

        ]
    ];

    #[Layout('layouts.minimal', ['title' => 'Setup'])]
    public function render()
    {
        return view('pages.setup.first-rental');
    }

    /**
     * Runs on init page load
     *
     * @return void
     */
    public function load()
    {
        // If in local mode, fill test data
        $this->loadDevData();
    }

    /**
     * Injects test data during development, or when the app env is locals
     *
     * @return void
     */
    function loadDevData(): void
    {
        if (app()->isLocal()) {
            $this->rental_name = "Ohana Burnside";
            // $this->rental_type = 19; // 19 = House
            $this->rental_street = "23 S Highland Dr";
            $this->rental_city = "Burnside";
            $this->rental_state = "KY";
            $this->rental_zip = "42519";
            devlog('SiteConfig test data filled');
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

    /**
     * Runs when the user presses the continue button. Validates the form data, checks
     * if there is an existing rental property in the database, if so it sets that as
     * the active rental, if not it creates a new one. Then it either adds or edits
     * the rental data and saves it. Then continues to the next step.
     *
     * @return void
     */
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
        // $rental->type_id = $this->rental_type;
        $rental->host_id = auth()->user()->id;

        // Save the rental
        $rental->save();

        // Go to the next step
        $this->redirect('/setup/listing-details', navigate: true);
    }
}
