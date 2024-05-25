<?php

namespace App\Http\Pages\Host\Listings;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.minimal', ['title' => 'Add a new listing'])]
class AddListing extends Component
{
    public function render()
    {
        return view('pages.host.listings.add-listing');
    }

    public function load(): void
    {
        //
    }
}
