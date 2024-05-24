<?php

use Illuminate\Support\Facades\Route;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host.')->middleware(['auth', 'setup.completed'])->prefix('/host')->group(function () {
    // Host Dashboard
    Route::name('dashboard')->get('/dashboard', App\Http\Pages\Host\Dashboard\DashboardIndex::class);

    // Host Rentals
    Route::name('rentals.')->prefix('/rentals')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Rentals\RentalsIndex::class);
        Route::name('create')->get('/new', App\Http\Pages\Host\Rentals\AddRental::class);
    });

    Route::name('settings.')->prefix('/settings')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Settings\SettingsIndex::class);
    });
});
