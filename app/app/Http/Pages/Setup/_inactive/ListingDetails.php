<?php

namespace App\Http\Pages\Setup;

use App\Models\Rental;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class ListingDetails extends Component
{

    public $rental;
    public $listing = [];
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
     * Runs on initial page load, sets the first (and only) rental property
     * as the active property
     *
     * @return void
     */
    public function load()
    {
        $this->rental = Rental::firstOrFail();
    }

    public function initAddRoom($room_type)
    {
        $this->resetValidation();

        $this->active_room = [
            'action' => 'add',
            'room_type' => Str::singular($room_type),
        ];
    }
}
