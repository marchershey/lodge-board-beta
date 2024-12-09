<?php

namespace App\Http;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class Test extends Component
{

    #[Validate('required|string|numeric|digits:5|regex:/^\d{5}$/', as: 'zip / postal code')]
    public ?int $address_postal;

    public function render()
    {
        return view('test');
    }
}
