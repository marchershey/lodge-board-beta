<?php

namespace App\Http\Pages\Setup\Steps;

use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class SiteConfig extends Component
{
    use WireToast;

    public $site_name;
    public $site_url;
    public $timezone;
    public $site_active;
    public $reservation_active;
    public $registration_active;

    protected $rules = [
        'site_name' => ['required', 'string', 'min:3', 'max:250'],
        // 'site_url' => ['required', 'string', 'min:3', 'max:250', 'regex:/^(https?:\/\/)?(?![-.])([\da-z\.-]+(?<!-)\.[a-z]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?$/'],
        'site_url' => ['required', 'string', 'min:3', 'max:250', 'regex:/^(https?:\/\/)?(?![-.])(localhost|[\da-z\.-]+(?<!-)\.[a-z]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?$/'],
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
            'regex' => 'That :attribute is invalid.',
        ],
        'timezone' => [
            'required' => 'The :attribute is required.',
            'string' => 'That :attribute is invalid.',
            'timezone' => 'That :attribute is invalid.',
        ]
    ];

    public function render(): View
    {
        return view('pages.setup.steps.site-config');
    }

    public function load(): void
    {
        $this->autofillTestData();

        $settings = app(GeneralSettings::class);
        $this->site_name = (string) $settings->site_name;
        $this->site_url = (string) $settings->site_url;
        $this->timezone = (string) $settings->timezone;
    }

    public function autofillTestData(): void
    {
        if (app()->isLocal()) {
            $this->site_name = "Demo Name (temp)";
            $this->site_url = "http://demo.com";
            $this->timezone = "America/Indiana/Indianapolis";

            toast()->debug('SiteConfig test data filled.')->push();
        }
    }

    /**
     * Runs when a component has been updated/changed.
     * 
     * After validation, if a property is invalid then the user updates the property,
     * reset the property's validation, but do not rerun validation until the user
     * resubmits the form
     *
     * @param string $property
     * @param string $value
     * @return void
     */
    function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

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

        $this->dispatch('next-step');
    }
}
