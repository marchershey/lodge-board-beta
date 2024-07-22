<?php

namespace App\Http\Pages\Host\Properties\NewProperty;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.minimal', ['title' => 'New Property'])]
class NewPropertyOverview extends Component
{
    public function render()
    {
        return view('pages.host.properties.new-property.new-property-overview');
    }

    public function start()
    {
        $property = Property::startNewProperty();

        $this->redirect(route('host.properties.new-property.basics', $property), navigate: true);
    }
}
