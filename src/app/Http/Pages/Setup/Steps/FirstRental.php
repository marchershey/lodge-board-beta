<?php

namespace App\Http\Pages\Setup\Steps;

use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class FirstRental extends Component
{
    use WireToast;

    public function render()
    {
        return view('pages.setup.steps.first-rental');
    }
}
