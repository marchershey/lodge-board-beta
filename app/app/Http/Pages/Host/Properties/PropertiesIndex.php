<?php

namespace App\Http\Pages\Host\Properties;

use App\Models\Property;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.app', ['title' => 'Properties'])]
class PropertiesIndex extends Component
{
    use WireToast;

    public $loading = false;
    public $properties = [];

    public function mount()
    {
        $this->properties = Property::all();
    }

    /**
     * Render the view
     *
     * @return  Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('pages.host.properties.properties-index');
    }

    public function archiveProperty($property_id): void
    {
        // Archive property
        // Dispatch archive property job

        // Reload properties

        // Close the modal
        // $this->modal('archive-property-' . $property_id)->close();

        // Dispatch notification
        // toast()->danger('Property was deleted.')->push();
    }
}
