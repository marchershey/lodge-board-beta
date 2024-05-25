<?php

use Illuminate\Support\Facades\Route;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host.')->middleware(['auth', 'setup.completed'])->prefix('/host')->group(function () {
    // Host Dashboard
    Route::name('dashboard')->get('/dashboard', App\Http\Pages\Host\Dashboard\DashboardIndex::class);

    // Host Listings
    Route::name('listings.')->prefix('/listings')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Listings\ListingsIndex::class);
        Route::name('create')->get('/add-listing', App\Http\Pages\Host\Listings\AddListing::class);
        // Route::name('create-old')->get('/add-listing-old', App\Http\Pages\Host\Listings\AddListingOld::class);
    });

    Route::name('settings.')->prefix('/settings')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Settings\SettingsIndex::class);
    });
});
