<?php

namespace App\Http\Pages\Host\Rentals;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Add Rental'])]
class AddRental extends Component
{
    public function render()
    {
        return view('pages.host.rentals.add-rental');
    }
}
