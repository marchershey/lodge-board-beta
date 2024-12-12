<?php

namespace App\Http\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.minimal', ['title' => 'Login', 'header' => false])]
class Login extends Component
{
    /**
     * TODO LIST
     *
     * - Add activity tracking
     * - Add throttling / rate limiting
     * - figure out if you want to use "exists" rule on email
     */
    use WireToast;

    public $email;
    public $password;
    public $remember = false;
    protected $rules = [
        // 'email' => ['required', 'string', 'email', 'max:250', 'exists:users'],
        'email' => ['required', 'string', 'email:rfc,strict,spoof,filter,filter_unicode', 'max:250'],
        'password' => ['required', 'string', 'max:250'],
        'remember' => ['boolean'],
    ];
    protected $validationAttributes = [
        'email' => 'Email Address',
        'password' => 'Password',
    ];
    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.string' => 'The email address you entered is invalid.',
        // 'email.email' => 'The email address you entered is invalid.',
        'email.email' => [
            'rfc' => 'Your email address is not valid. (RFC)',
            'strict' => 'Your email address is not valid. (SRFC)',
            'dns' => 'Your email address is not associated with a valid domain.',
            'spoof' => 'Your email address is a spoofed email address.',
        ],
        'email.max' => 'Your email address is too long. Max 250 characters.',
        // 'email.exists' => 'We couldn\'t find an account with this email address.',

        'password.required' => 'Please enter your password.',
        'password.string' => 'The password you entered is invalid.',
        'password.max' => 'The password you entered is invalid.',
    ];

    /**
     * Render the page
     */
    public function render(): View
    {
        return view('pages.auth.login');
    }

    /**
     * FOR DEV TESTING ONLY
     * If the app's environment is local, dummy data will be loaded
     */
    public function mount(): void
    {
        // If application's environment is local, then inject dummy data for testing
        if (app()->isLocal()) {
            $this->email = 'host@email.com';
            $this->password = 'password';
            $this->remember = true;
        }
    }

    /**
     * Runs when a component has been updated/changed.
     *
     * After validation, if a property is invalid then the user updates the property,
     * reset the property's validation, but do not rerun validation until the user
     * resubmits the form
     *
     * @param  string  $property
     * @param  string  $value
     */
    public function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    /**
     * Submit the Sign In Form
     *
     * Runs when the user presses the "Sign in" button
     * on the login page.
     *
     * - Validate user data
     * - Check user credentials
     * - Redirect to dashboard
     *
     * @throws  Throwable
     */
    public function submit(): mixed
    {
        // Validate user data
        $this->validate();

        attempt(function () {
            // Check user credentials
            if (Auth::attempt($this->only(['email', 'password'], $this->remember))) {
                // Valid Credentials

                // regenerate the session
                session()->regenerate();

                // Dispatch toast notification
                toast()->success('You have successfully signed into your account.', 'Welcome back, ' . auth()->user()->first_name . '!')->pushOnNextPage();

                // Redirect to dashboard/intended
                return $this->redirect('/dashboard', navigate: true);
            } else {
                // Invalid credentials

                // Reset all properties
                $this->resetExcept('remember');

                // Add error to errorbag
                $this->addError('email', 'Invalid email address or password.');

                // Dispatch notification
                toast()->danger('The email or password you entered is incorrect.', 'Invalid Credentials')->push();
            }
        }, 'Account signin');

        return false;
    }
}
