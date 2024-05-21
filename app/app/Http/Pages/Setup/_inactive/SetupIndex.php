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

    #[Layout('layouts.minimal', ['title' => 'Setup'])]
    public function render()
    {
        return view('pages.setup.setup-index');
    }

    /**
     * Loads the current setup step, or redirects to dashboard
     * if the setup has already been completed
     *
     * @return void
     */
    function load()
    {
        if (app(SetupSettings::class)->completed) {
            return $this->redirectRoute('dashboard');
        }

        $this->loadCurrentStep();
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

    /**
     * Goes to the next setup step
     *
     * @return void
     */
    #[On('next-step')]
    function nextStep(): void
    {
        $this->current_step++;
        $this->updateDatabaseWithCurrentStep();
    }

    /**
     * Retrun to the previous setup step
     *
     * @return void
     */
    #[On('prev-step')]
    function prevStep(): void
    {
        $this->current_step > 1 && $this->current_step--;
        $this->updateDatabaseWithCurrentStep();
    }

    /**
     * Updates the database with the current setup step
     *
     * @return void
     */
    function updateDatabaseWithCurrentStep(): void
    {
        app(SetupSettings::class)->current_step = $this->current_step;
        app(SetupSettings::class)->save();
    }

    /**
     * Runs when the setup has been completed. Updates the setup settings
     *
     * @return void
     */
    #[On('setup-completed')]
    function setupCompleted(): void
    {
        app(SetupSettings::class)->completed = true;
        app(SetupSettings::class)->current_step = 0;
        app(SetupSettings::class)->save();
    }
}
