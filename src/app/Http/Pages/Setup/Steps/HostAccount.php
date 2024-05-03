<?php

namespace App\Http\Pages\Setup\Steps;

use Livewire\Component;

class HostAccount extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public function render()
    {
        return view('pages.setup.steps.host');
    }

    function changedesc(): void
    {
        $this->dispatch('update-page-desc', string: 'test');
    }
}
