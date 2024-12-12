<?php

namespace App\Http\Components\Host\Dashboard;

use App\Models\Property;
use Livewire\Component;

class PropertySelector extends Component
{
    public bool $loading = true;
    public $properties;
    public $property; // Active property

    public function render()
    {
        return view('components.host.dashboard.property-selector');
    }

    public function load(): void
    {
        // Load All Properties
        $this->properties = Property::all()->toArray();

        // Load Active Property
        $this->property = [];

        // Disable Lo
        $this->loading = false;
    }
}
