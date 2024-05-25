<?php

use Illuminate\Support\Facades\Route;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host.')->middleware(['auth', 'setup.completed'])->prefix('/host')->group(function () {
    // Host Dashboard
    Route::name('dashboard')->get('/dashboard', App\Http\Pages\Host\Dashboard\DashboardIndex::class);

    // Host Properties
    Route::name('properties.')->prefix('/properties')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Properties\PropertiesIndex::class);
        Route::name('create')->get('/add-property', App\Http\Pages\Host\Properties\AddProperty::class);
        // Route::name('create-old')->get('/add-property-old', App\Http\Pages\Host\Properties\AddPropertyOld::class);
    });

    Route::name('settings.')->prefix('/settings')->group(function () {
        Route::name('index')->get('/', App\Http\Pages\Host\Settings\SettingsIndex::class);
    });
});
