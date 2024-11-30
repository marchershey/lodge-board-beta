<?php

namespace App\Http\Pages\Setup;

use App\Settings\GeneralSettings;
use App\Settings\SetupSettings;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Basics extends Component
{
    use WireToast;

    public $site_name;
    public $site_url;
    public $timezone;

    protected $rules = [
        'site_name' => ['required', 'string', 'min:3', 'max:250'],
        'site_url' => ['required', 'string', 'min:3', 'max:250', 'regex:/^(?:(http|https):\/\/)?(?![-.])(localhost|[\da-z\.-]+(?<!-)\.[a-z]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?$/'],
        'timezone' => ['required', 'string', 'timezone:per_country,US'],
    ];

    protected $validationAttributes = [
        'site_name' => 'Website / Business Name',
        'site_url' => 'Website URL',
        'timezone' => 'Default Timezone',
    ];

    protected $messages = [
        'site_name' => [
            'required' => 'The :attribute is required.',
            'string' => 'That :attribute is invalid.',
            'min' => 'The :attribute must be at least :min characters long.',
            'max' => 'The :attribute cannot exceed :max characters long.',
        ],
        'site_url' => [
            'required' => 'The :attribute is required.',
            'string' => 'That :attribute is invalid.',
            'min' => 'The :attribute must be at least :min characters long.',
            'max' => 'The :attribute cannot exceed :max characters long.',
            'regex' => 'The :attribute is invalid.',
        ],
        'timezone' => [
            'required' => 'The :attribute is required.',
            'string' => 'That :attribute is invalid.',
            'timezone' => 'That :attribute is invalid.',
        ]
    ];


    #[Layout('layouts.minimal', ['title' => 'Setup', 'header' => false])]
    public function render(): View
    {
        return view('pages.setup.basics');
    }

    /**
     * Runs on init page load
     *
     * @return void
     */
    public function load(): void
    {
        $settings = app(GeneralSettings::class);
        $this->site_name = (string) $settings->site_name;
        $this->site_url = (string) $settings->site_url;
        $this->timezone = (string) $settings->timezone;

        // If env local and empty settings, inject testing data
        // $this->loadDevData();
    }

    /**
     * Injects test data during development, or when the app env is locals
     *
     * @return void
     */
    public function loadDevData(): void
    {
        if (app()->isLocal()) {
            $this->site_name = "Demo Name (temp)";
            $this->site_url = url('/');
            $this->timezone = "America/Indiana/Indianapolis";
            devlog('Basics Test Data filled');
        }
    }

    /**
     * Runs when the user presses the continue button. Validates the user's data,
     * updates the settings, continues to next step.
     *
     * @return void
     */
    public function submit(): void
    {
        // Validate the form
        $validated = $this->validate();

        // Save settings
        $settings = app(GeneralSettings::class);
        $settings->site_name = ucwords($validated['site_name']);
        $settings->site_url = $validated['site_url'];
        $settings->timezone = $validated['timezone'];
        $settings->save();

        // Complete Setup
        app(SetupSettings::class)->completed = true;
        // app(SetupSettings::class)->current_step = 0;
        app(SetupSettings::class)->save();

        toast()->success('Setup has been completed.', 'Setup Completed')->pushOnNextPage();

        $this->redirect('/host/dashboard', navigate: true);
    }
}
