<?php

namespace App\Http\Pages\Host\Properties;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.minimal', ['title' => 'Add a new property'])]
class AddProperty extends Component
{
    public function render()
    {
        return view('pages.host.properties.add-property');
    }

    public function load(): void
    {
        //
    }
}
