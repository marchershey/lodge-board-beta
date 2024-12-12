<?php

namespace App\Http\Pages\Host\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Dashboard'])]
class DashboardIndex extends Component
{
    public function render()
    {
        return view('pages.host.dashboard.dashboard-index');
    }
}
