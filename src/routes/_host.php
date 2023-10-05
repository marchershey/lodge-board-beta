<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host.')->middleware(['auth'])->prefix('/host')->group(function () {
    // Host Dashboard
    Route::get('/dashboard', App\Http\Pages\Host\Dashboard::class)->name('dashboard');
});
