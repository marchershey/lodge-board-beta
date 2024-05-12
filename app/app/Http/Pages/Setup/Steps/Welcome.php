<?php

namespace App\Http\Pages\Setup\Steps;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('pages.setup.steps.welcome');
    }

    function continue()
    {
        $this->dispatch('next-step');
    }
}
