<?php

namespace App\Http\Pages\Setup;

use App\Settings\SetupSettings;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class SetupIndex extends Component
{
    use WireToast;

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
        $this->loadCurrentStep();
    }

    function updateDatabaseWithCurrentStep(): void
    {
        app(SetupSettings::class)->current_step = $this->current_step;
        app(SetupSettings::class)->save();
        toast()->debug('Current step updated on database.')->push();
    }

    #[On('next-step')]
    function nextStep(): void
    {
        $this->current_step++;
        $this->updateDatabaseWithCurrentStep();
    }

    #[On('prev-step')]
    function prevStep(): void
    {
        $this->current_step > 1 && $this->current_step--;
        $this->updateDatabaseWithCurrentStep();
    }

    /**
     * Sets the view to the current/latest setup step
     * 
     * Gets the latest setup step the user was on and sets the view to that step
     *
     * @return void
     */
    function loadCurrentStep(): void
    {
        $this->current_step = app(SetupSettings::class)->current_step;

        // If setup was never started, run nextStep() to set first step
        if ($this->current_step === 0) {
            $this->nextStep();
        }
    }
}
