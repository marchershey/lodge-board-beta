<?php

namespace App\Http\Pages\Setup;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Welcome extends Component
{
    #[Layout('layouts.minimal', ['title' => 'Setup', 'header' => false])]
    public function render()
    {
        return view('pages.setup.welcome');
    }

    public function continue()
    {
        $this->redirect(route('setup.host-account'), navigate: true);
    }
}
