<?php

namespace App\Http\Pages\Host\Listings;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Listings'])]
class ListingsIndex extends Component
{
    public function render()
    {
        return view('pages.host.listings.listings-index');
    }
}
