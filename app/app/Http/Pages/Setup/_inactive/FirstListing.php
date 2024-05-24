<?php

namespace App\Http\Pages\Setup;

use App\Models\Listing;
use Livewire\Attributes\Layout;
use Livewire\Component;

class FirstListing extends Component
{
    public string $listing_name;
    // public string $listing_type;
    public string $listing_street;
    public string $listing_city;
    public string $listing_state;
    public string $listing_zip;

    protected $rules = [
        'listing_name' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        // 'listing_type' => ['required', 'string', 'numeric'],
        'listing_street' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[a-zA-Z0-9\s\-\#]+$/'],
        'listing_city' => ['required', 'string', 'min:3', 'max:250', 'regex:/^[\p{L}\p{M}\p{N}\'\s]+$/u'],
        'listing_state' => ['required', 'string', 'size:2', 'alpha'],
        'listing_zip' => ['required', 'string', 'digits:5', 'between:501,99734', 'numeric'],
    ];

    protected $validationAttributes = [
        'listing_name' => 'Listing Name',
        // 'listing_type' => 'Listing Type',
        'listing_street' => 'Street Address',
        'listing_city' => 'City',
        'listing_state' => 'State',
        'listing_zip' => 'Zip Code',
    ];

    protected $messages = [
        'listing_name' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        // 'listing_type' => [
        //     'required' => 'The :attribute is required.',
        //     'integer' => 'Invalid :attribute',
        //     'numeric' => 'Invalid :attribute',
        // ],
        'listing_street' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'listing_city' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'min' => 'The :attribute is too short. (Min :min characters)',
            'max' => 'The :attribute is too long. (Max :max characters)',
            'regex' => 'The :attribute is invalid. (Illegal characters)',
        ],
        'listing_state' => [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'size' => 'The :attribute is invalid. (Stop it, you script kiddy)',
            'alpha' => 'The :attribute is invalid. (Stop it, you script kiddy)',
        ],
        'listing_zip' => [
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
        return view('pages.setup.first-listing');
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
            $this->listing_name = "Ohana Burnside";
            // $this->listing_type = 19; // 19 = House
            $this->listing_street = "23 S Highland Dr";
            $this->listing_city = "Burnside";
            $this->listing_state = "KY";
            $this->listing_zip = "42519";
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
     * if there is an existing listing property in the database, if so it sets that as
     * the active listing, if not it creates a new one. Then it either adds or edits
     * the listing data and saves it. Then continues to the next step.
     *
     * @return void
     */
    public function submit(): void
    {
        // Validate the listing information
        $this->validate();

        // Check if a listing already exists
        if (Listing::count() > 0) {
            // A listing exists, so set that as active listing
            $listing = Listing::first();
        } else {
            // No listings exists, create a new one.
            $listing = new Listing();
        }

        // Update the listing's information
        $listing->name = ucwords($this->listing_name);
        $listing->address_street = ucwords($this->listing_street);
        $listing->address_city = ucwords($this->listing_city);
        $listing->address_state = $this->listing_state;
        $listing->address_zip = $this->listing_zip;
        // $listing->type_id = $this->listing_type;
        $listing->host_id = auth()->user()->id;

        // Save the listing
        $listing->save();

        // Go to the next step
        $this->redirect('/setup/listing-details', navigate: true);
    }
}
