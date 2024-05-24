<?php

namespace App\Http\Pages\Setup;

use App\Models\Listing;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class ListingDetails extends Component
{

    public $listing;
    public $listings = [];
    public $guest_count = 0;
    public $bed_count = 0;
    public $bedroom_count = 0;
    public $bathroom_count = 0;

    #[Layout('layouts.minimal', ['title' => 'Setup'])]
    public function render()
    {
        return view('pages.setup.listing-details');
    }

    /**
     * Runs on initial page load, sets the first (and only) listing property
     * as the active property
     *
     * @return void
     */
    public function load()
    {
        $this->listing = Listing::firstOrFail();
    }

    public function initAddRoom($room_type)
    {
        $this->resetValidation();

        // $this->active_room = [
        //     'action' => 'add',
        //     'room_type' => Str::singular($room_type),
        // ];
    }
}
