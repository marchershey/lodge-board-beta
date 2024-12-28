<?php

namespace App\Http\Pages\Host\Properties;

use App\Forms\HostPropertyForm;
use App\Models\Property;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ViewPropertyDetails extends Component
{
    use WireToast;

    public Property $property;
    public HostPropertyForm $form;
    public string $name;
    public array $address = [];


    public function mount(Property $property)
    {
        $this->property = $property;
        $this->name = $property->name;
        $this->address = [
            'line1' => $property->address_line1,
            'line2' => $property->address_line2,
            'city' => $property->address_city,
            'state' => $property->address_state,
            'postal' => $property->address_postal,
            'country' => $property->address_country,
        ];
    }

    public function render()
    {
        return view('pages.host.properties.view-property-details');
    }

    public function updateName()
    {
        $this->property->name = $this->name;
        $this->property->save();
        $this->dispatch('property-updated');
    }

    public function updateAddress()
    {
        foreach ($this->address as $key => $value) {
            $address_type = 'address_' . $key;
            $this->property->$address_type = $value;
        }

        $this->property->save();
        $this->dispatch('property-updated');
    }
}
