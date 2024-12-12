<?php

namespace App\Http\Pages\Setup\_inactive;

use App\Models\Property;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PropertyDetails extends Component
{
    public $property;
    public $properties = [];
    public $guest_count = 0;
    public $bed_count = 0;
    public $bedroom_count = 0;
    public $bathroom_count = 0;

    #[Layout('layouts.minimal', ['title' => 'Setup'])]
    public function render()
    {
        return view('pages.setup.property-details');
    }

    /**
     * Runs on initial page load, sets the first (and only) property property
     * as the active property
     *
     * @return  void
     */
    public function load()
    {
        $this->property = Property::firstOrFail();
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
