<?php

namespace App\Http;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.minimal', ['title' => 'Add Property'])]
class Test extends Component
{
    #[Validate('required', as: 'zip')]
    public $zip = '';

    public $description = '';

    public function render()
    {
        return view('test');
    }

    public function load(): void {}

    public function submit(): void
    {
        $this->validate();
    }
}
