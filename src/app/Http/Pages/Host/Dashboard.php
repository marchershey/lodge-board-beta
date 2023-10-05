<?php

namespace App\Http\Pages\Host;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.host', ['title' => 'Register', 'text' => 'Create your new account'])]
class Dashboard extends Component
{
    public function render()
    {
        return view('pages.host.dashboard',);
    }
}
