<?php

namespace App\Http\Pages\Host\Properties;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class AddPropertyOld extends Component
{
    // Basic Information
    public string $name;
    public array $address = [];

    // Property Information
    public string $property_headline;
    public string $property_description = '';

    // Pricing Information
    public float $base_rate;
    public int $tax_rate;
    public array $fees = [];

    // Amenities
    public string $amenity;
    public array $primaryAmenities = [];
    public array $amenities = [];


    public function mount(): void
    {
        // Need to init this so the char counter will work.
        $this->addAdditionalFee();
    }

    public function render()
    {
        return view('pages.host.properties.add-property-old');
    }

    public function load(): void
    {
        $this->amenities = Amenity::getPrimaryAmenities();
    }

    public function addAdditionalFee(): void
    {
        array_push($this->fees, [
            'name' => '',
            'amount' => '',
            'type' => 'fixed',
        ]);
    }

    public function removeAdditionalFee($key): void
    {
        unset($this->fees[$key]);
    }

    public function submit(): void
    {
        $return = $this->fees[0]['amount'];

        dd($return);
    }
}
