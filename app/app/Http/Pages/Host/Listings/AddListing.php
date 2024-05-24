<?php

namespace App\Http\Pages\Host\Listings;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Add Listing'])]
class AddListing extends Component
{
    // Basic Information
    public string $name;
    public array $address = [];

    // Listing Information
    public string $listing_headline;
    public string $listing_description = '';

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
        return view('pages.host.listings.add-listing');
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
