<?php

namespace App\Http\Pages\Setup\Steps;

use App\Models\Rental;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class FirstRental extends Component
{
    use WireToast;

    public $rental_name;
    public $rental_street;
    public $rental_city;
    public $rental_state;
    public $rental_zip;

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
        $this->autofillTestData();
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

    public function submit(): void
    {
        $validated = $this->validate();

        $new_rental = new Rental();
        $new_rental->name = $this->rental_name;
        $new_rental->address_street = $this->rental_street;
        $new_rental->address_city = $this->rental_city;
        $new_rental->address_state = $this->rental_state;
        $new_rental->address_zip = $this->rental_zip;

        attempt(function ($new_rental) {
            if ($new_rental->save()) {
                dd('yes');
            } else {
                dd('no');
            }
        }, $new_rental, $this->rental_name, 'Adding first rental to database');
    }

    public function autofillTestData(): void
    {
        if (app()->isLocal()) {
            $this->rental_name = "Ohana Burnside";
            $this->rental_street = "23 S Highland Dr";
            $this->rental_city = "Burnside";
            $this->rental_state = "KY";
            $this->rental_zip = "42519";
        }
    }
}
