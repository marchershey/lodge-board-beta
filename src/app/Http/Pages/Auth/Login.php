<?php

namespace App\Http\Pages\Auth;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth', ['title' => 'Login', 'text' => 'Welcome back!'])]
class Login extends Component
{
    public $email;
    public $password;
    public $remember = true;
    function render(): View
    {
        return view('pages.auth.login');
    }
}
