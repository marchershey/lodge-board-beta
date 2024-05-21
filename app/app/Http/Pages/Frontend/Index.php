<?php

namespace App\Http\Pages\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Welcome'])]
class Index extends Component
{
    public $properties;

    public function render()
    {
        return view('pages.frontend.index');
    }

    function loadProperties(): void
    {
        //
    }
}
