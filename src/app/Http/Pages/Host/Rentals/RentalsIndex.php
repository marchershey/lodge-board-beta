<?php

namespace App\Http\Pages\Host\Rentals;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Rentals'])]
class RentalsIndex extends Component
{
    public function render()
    {
        return view('pages.host.rentals.rentals-index');
    }
}
