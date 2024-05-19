<?php

namespace App\Http\Pages\Setup\Steps;

use App\Models\Rental;
use Livewire\Component;

class RentalDetails extends Component
{

    public $rental;

    public function render()
    {
        return view('pages.setup.steps.rental-details');
    }

    /**
     * Runs on initial page load, sets the first (and only) rental property
     * as the active property
     *
     * @return void
     */
    public function load()
    {
        $this->rental = Rental::firstOrFail();
    }
}
