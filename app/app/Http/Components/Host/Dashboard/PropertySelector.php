<?php

namespace App\Http\Components\Host\Dashboard;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PropertySelector extends Component
{
    public bool $loaded = false;
    public $properties;
    public $property; // Active property

    public function render()
    {
        return view('components.host.dashboard.property-selector');
    }

    function load(): void
    {
        // Load Active Property
        $this->property = ['test' => 'test'];

        // Load All Properties
        $this->properties = Property::all();
    }
}
