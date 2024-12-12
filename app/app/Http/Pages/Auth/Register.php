<?php

namespace App\Http\Pages\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.minimal', ['title' => 'Register', 'header' => false])]
class Register extends Component
{
    /**
     * Todo list
     *
     * - Add activity tracking
     * - Add ability to disable form when an error has occured.
     */
    use WireToast;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms;
    protected $rules = [
        'first_name' => ['required', 'string', 'max:250'],
        'last_name' => ['required', 'string', 'max:250'],
        'email' => ['required', 'string', 'email:rfc,strict,spoof,filter,filter_unicode', 'max:250', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required', 'string', 'min:8'],
        'terms' => ['accepted'],
    ];
    protected $validationAttributes = [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email Address',
        'password' => 'Password',
        'password_confirmation' => 'Password',
        'terms' => 'Terms of Service',
    ];
    protected $messages = [
        'first_name.required' => 'Please enter your first name.',
        'first_name.string' => 'The first name you entered is invalid.',
        'first_name.max' => 'Your first name is too long. Max 250 characters.',

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
        'password.confirmed' => 'The passwords you entered do not match.',

        'password_confirmation.required' => 'Please enter a password for your account.',
        'password_confirmation.string' => 'The password above is invalid.',
        'password_confirmation.min' => 'The password above is too short. Min 8 characters.',

        'terms.accepted' => 'Please agree to the Terms of Service.',
    ];

    /**
     * Render the page
     */
    public function render(): View
    {
        return view('pages.auth.register');
    }

    /**
     * FOR DEV TESTING ONLY
     * If the app's environment is local, dummy data will be loaded
     */
    public function mount(): void
    {
        // If application's environment is local, then inject dummy data for testing
        if (app()->isLocal()) {
            $this->first_name = 'Marc';
            $this->last_name = 'Hershey';
            $this->email = 'host@email.com';
            $this->password = 'password';
            $this->password_confirmation = 'password';
        }
    }

    // function dehydrate()
    // {
    // toast()->info('This is a test info toast.')->sticky()->push();
    // toast()->success('This is a test success toast.')->sticky()->push();
    // toast()->warning('This is a test warning toast.')->sticky()->push();
    // toast()->danger('This is a test danger toast.')->sticky()->push();
    // toast()->debug('This is a test debug toast.')->sticky()->push();

    // toast()->info('This is a test info toast with a title.', 'Info Toast')->sticky()->push();
    // toast()->success('That reservation has been approved successfully.', 'Reservation Approved')->sticky()->push();
    // toast()->warning('This is a test warning toast with a title.', 'Warning Toast')->sticky()->push();
    // toast()->danger('This is a test danger toast with a title.', 'Danger Toast')->sticky()->push();
    // toast()->debug('This is a test debug toast with a title.', 'Debug Toast')->sticky()->push();
    // }

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
     * Submit the Registration Form
     *
     * Runs when the user presses the "Create Account" button
     * on the regiration page.
     *
     * - Validate user data
     * - Create user
     * - TODO: Add user settings
     * - TODO: Dispatch NewUserCreated job
     * - Authenticate user
     * - Dispatch Toast
     * - Redirect to dashboard
     *
     * @return  mixed
     *
     * @throws  Throwable
     */
    public function submit(): void
    {
        // Validate user data
        $this->validate();

        attempt(function () {
            // Create user
            $user = User::create($this->only(['first_name', 'last_name', 'email', 'password']));

            // TODO
            // Insert user settings??? (we'll come back to this)
            // Dispatch NewUserCreated job

            // Authenticate user
            Auth::login($user);
        }, 'Account registration');

        // Dispatch toast to user
        toast()->success('Your account has been successfully created.', 'Account Created')->pushOnNextPage();

        // Redirect to dashboard
        $this->redirect('/dashboard', navigate: true);
    }
}
