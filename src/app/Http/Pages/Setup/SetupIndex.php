<?php

namespace App\Http\Pages\Setup;

use App\Settings\SetupSettings;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SetupIndex extends Component
{
    public $current_step = null;

    #[Layout('layouts.min', ['title' => 'Setup'])]
    public function render()
    {
        return view('pages.setup.setup-index');
    }

    /**
     * Loads the current setup step
     *
     * @return void
     */
    function load(): void
    {
        $this->current_step = app(SetupSettings::class)->current_step;
        if ($this->current_step === 0) {
            $this->nextStep();
        }
    }

    function updateDatabaseWithCurrentStep(): void
    {
        app(SetupSettings::class)->current_step = $this->current_step;
        app(SetupSettings::class)->save();
    }

    #[On('next-step')]
    function nextStep(): void
    {
        $this->current_step++;
        $this->updateDatabaseWithCurrentStep();
    }

    function previousStep(): void
    {
        $this->current_step--;
        $this->updateDatabaseWithCurrentStep();
    }

    /**
     * Sets the view to the current/latest setup step
     * 
     * Gets the latest setup step the user was on and sets the view to that step
     *
     * @return void
     */
    function setCurrentStep($value): void
    {
        // app(SetupSettings::class)->set('')
        // $this->step = $value;
    }
}
