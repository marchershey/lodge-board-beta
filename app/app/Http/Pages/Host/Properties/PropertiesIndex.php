<?php

namespace App\Http\Pages\Host\Properties;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Properties'])]
class PropertiesIndex extends Component
{
    public function render()
    {
        return view('pages.host.properties.properties-index');
    }
}
