<?php

namespace App\Http\Pages\Host\Properties\NewProperty;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.minimal', ['title' => 'The Basics'])]
class NewPropertyBasics extends Component
{
    public $property;
    public $fees = [];
    public $amenities = [];

    public function render()
    {
        return view('pages.host.properties.new-property.new-property-basics');
    }

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    public function load()
    {
        //
    }

    public function end()
    {
        //
    }
}
