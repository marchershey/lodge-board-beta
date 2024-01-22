<?php

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelSettings\Settings;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host.')->middleware(['auth', 'setup'])->prefix('/host')->group(function () {
    // Host Dashboard
    Route::get('/dashboard', App\Http\Pages\Host\Dashboard\DashboardIndex::class)->name('dashboard');

    // Host Rentals
    Route::name('rentals.')->prefix('/rentals')->group(function () {
        Route::get('/', App\Http\Pages\Host\Rentals\RentalsIndex::class)->name('index');
        Route::get('/new', App\Http\Pages\Host\Rentals\AddRental::class)->name('create');
    });
});
