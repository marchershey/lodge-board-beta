<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'setup.completed'])->group(function () {
    Route::get('/login', App\Http\Pages\Auth\Login::class)->name('login');
    Route::get('/register', App\Http\Pages\Auth\Register::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});
