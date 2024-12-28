<?php

namespace App\Http\Pages\Host\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class ViewProperty extends Component
{
    use WireToast;
    #[Url(history: true, keep: true)]
    public $tab = 'overview';
    public $property;

    public function mount($slug)
    {
        $this->property = Property::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('pages.host.properties.view-property');
    }

    #[\Livewire\Attributes\On('property-updated')]
    public function refreshProperty()
    {
        // $this->property = Propert
    }
}
