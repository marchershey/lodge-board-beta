<?php

namespace App\Http\Pages\Setup\_inactive;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;

class FirstProperty extends Component
{
    public string $property_name;
    // public string $property_type;
    public string $property_street;
    public string $property_city;
    public string $property_state;
    public string $property_zip;

    protected $rules = [
        'property_name' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        // 'property_type' => ['required', 'string', 'numeric'],
        'property_street' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[a-zA-Z0-9\s\-\#]+$/'],
        'property_city' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'property_state' => ['required', 'string', 'size:2', 'alpha'],
        'property_zip' => ['required', 'string', 'digits:5', 'between:501,99734', 'numeric'],
    ];

    protected $validationAttributes = [
        'property_name' => 'Property Name',
        // 'property_type' => 'Property Type',
        'property_street' => 'Street Address',
        'property_city' => 'City',
        'property_state' => 'State',
        'property_zip' => 'Zip Code',
    ];

    protected $messages = [
        'property_name' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        // 'property_type' => [
        //     'required' => 'The :attribute is required.',
        //     'integer' => 'Invalid :attribute',
        //     'numeric' => 'Invalid :attribute',
        // ],
        'property_street' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'property_city' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'property_state' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'size' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'alpha' => 'The :attribute is invalid. (Stop it, you script kiddy)',
        ],
        'property_zip' => [
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
        return view('pages.setup.first-property');
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
            $this->property_name = "Ohana Burnside";
            // $this->property_type = 19; // 19 = House
            $this->property_street = "23 S Highland Dr";
            $this->property_city = "Burnside";
            $this->property_state = "KY";
            $this->property_zip = "42519";
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
     * if there is an existing property property in the database, if so it sets that as
     * the active property, if not it creates a new one. Then it either adds or edits
     * the property data and saves it. Then continues to the next step.
     *
     * @return void
     */
    public function submit(): void
    {
        // Validate the property information
        $this->validate();

        // Check if a property already exists
        if (Property::count() > 0) {
            // A property exists, so set that as active property
            $property = Property::first();
        } else {
            // No properties exists, create a new one.
            $property = new Property();
        }

        // Update the property's information
        $property->name = ucwords($this->property_name);
        $property->address_street = ucwords($this->property_street);
        $property->address_city = ucwords($this->property_city);
        $property->address_state = $this->property_state;
        $property->address_zip = $this->property_zip;
        // $property->type_id = $this->property_type;
        $property->host_id = auth()->user()->id;

        // Save the property
        $property->save();

        // Go to the next step
        $this->redirect('/setup/property-details', navigate: true);
    }
}
