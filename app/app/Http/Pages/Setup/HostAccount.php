<?php

namespace App\Http\Pages\Setup;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class HostAccount extends Component
{
    use WireToast;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    // public $password_confirmation;

    protected $rules = [
        'first_name' => ['required', 'string', 'max:250', 'alpha'],
        'last_name' => ['required', 'string', 'max:250'],
        'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ];

    protected $validationAttributes = [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email Address',
        'password' => 'Password',
    ];

    protected $messages = [
        'first_name.required' => 'Please enter your first name.',
        'first_name.string' => 'The first name you entered is invalid.',
        'first_name.max' => 'Your first name is too long. Max 250 characters.',
        'first_name.alpha' => 'Your first name is too long. Max 250 characters.',


        'last_name.required' => 'Please enter your last name.',
        'last_name.string' => 'The last name you entered is invalid.',
        'last_name.max' => 'Your last name is too long. Max 250 characters.',

        'email.required' => 'Please enter your email address.',
        'email.string' => 'The email address you entered is invalid.',
        'email.email' => 'The email address you enetered is invalid.',
        'email.max' => 'Your email address is too long. Max 250 characters.',
        'email.unique' => 'An account with this email address already exists.',

        'password.required' => 'Please confirm your password.',
        'password.string' => 'The password above is invalid.',
        'password.min' => 'This password is too short. Min 8 characters.',
        // 'password.confirmed' => 'The passwords you entered do not match.',

        // 'password_confirmation.required' => 'Please enter a password for your account.',
        // 'password_confirmation.string' => 'The password above is invalid.',
        // 'password_confirmation.min' => 'The password above is too short. Min 8 characters.',
    ];

    /**
     * Render the page
     *
     * @return View
     */
    #[Layout('layouts.minimal', ['title' => 'Setup'])]
    function render(): View
    {
        return view('pages.setup.host-account');
    }

    function load(): void
    {
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
            $this->first_name = "John";
            $this->last_name = "Smith";
            $this->email = "jsmith2000@email.com";
            $this->password = "password";
            // $this->password_confirmation = "password";
            devlog('HostAccount Test Data filled');
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

    function submit(): void
    {
        // Validate user data
        $this->validate();

        attempt(function () {
            // Create user
            $user = User::create($this->only(['first_name', 'last_name', 'email', 'password']));

            // TODO
            // Insert user settings
            // Dispatch NewUserCreated/NewHostCreated Job

            // Authenticate user
            Auth::login($user);
        });

        toast()->success('Your account was successfully created.', 'Welcome ' . ucwords($this->first_name) . '!')->push();

        $this->redirect('/setup/basics', navigate: true);
    }
}
