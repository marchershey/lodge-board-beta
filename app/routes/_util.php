<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

// Dashboard
// Redirect to user type's dashboard
Route::get('/dashboard', function (): RedirectResponse {
    return redirect()->route('host.dashboard');
})->name('dashboard');
