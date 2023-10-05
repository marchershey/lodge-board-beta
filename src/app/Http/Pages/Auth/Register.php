<?php

namespace App\Http\Pages\Auth;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.auth', ['title' => 'Register', 'text' => 'Create your new account'])]
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
    public $accepted;

    protected $rules = [
        'first_name' => ['required', 'string', 'max:250'],
        'last_name' => ['required', 'string', 'max:250'],
        'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required', 'string', 'min:8'],
        'accepted' => ['required']
    ];

    protected $validationAttributes = [
        'first_name' => 'First Name',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    protected $messages = [
        'email.unique' => 'This email address is already attached to an existing account.',
    ];

    /**
     * Render the page
     *
     * @return View
     */
    function render(): View
    {
        return view('pages.auth.register');
    }

    function mount(): void
    {
        // If application's environment is local, then inject dummy data for testing
        if (app()->isLocal()) {
            $this->first_name = "Host";
            $this->last_name = "Account";
            $this->email = "host@email.com";
            $this->password = "password";
            $this->password_confirmation = "password";
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
     * @param string $property
     * @param string $value
     * @return void
     */
    function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    /**
     * Submit Registration Form
     * 
     * Runs when the user presses the "Create Account" button
     * on the regiration page.
     * 
     * - Validate
     * - Create user
     * - *Add user settings
     * - *Dispatch user created job
     * - Authenticate user
     * - Dispatch Toast
     * - Redirect to dashboard
     * 
     * @throws Throwable
     * @return null | bool
     */
    function submit(): null | bool
    {
        attempt(function () {
            $user = User::create($this->only(['first_name', 'last_name', 'email', 'password']));
        }, 'User creating account');

        return false;

        // Validate
        $this->validate();

        // Create User
        try {
            $user = User::create($this->only(['first_names', 'last_name', 'email', 'password']));
        } catch (Exception $e) {
            report($e);

            if (app()->isLocal()) {
                toast()->debug($e->getMessage())->sticky()->push();
            } else {
                toast()->danger('There was an issue adding your account to the database. Please manually refresh the page and try again.', 'Server Error')->sticky()->push();
            }

            return false;
        }

        // Authenticate user
        Auth::login($user);

        // Dispatch toast
        toast()->success('Your account has been successfully created.', 'Account Created')->pushOnNextPage();

        // Redirect to dashboard
        // return redirect()->route('dashboard');
        return $this->redirect('/dashboard', navigate: true);
    }
}
