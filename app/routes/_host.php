<?php

use Illuminate\Support\Facades\Route;

// Route::name('host.')->middleware(['auth', 'host'])->prefix('/host')->group(function () {
Route::name('host')->middleware(['auth', 'setup.completed'])->prefix('/host')->group(function () {
    Route::redirect('/', '/host/dashboard');

    // Host Dashboard
    Route::name('.dashboard')->get('/dashboard', App\Http\Pages\Host\Dashboard\DashboardIndex::class);

    // Host Properties
    Route::name('.properties')->prefix('/properties')->group(function () {
        Route::name('.index')->get('/', App\Http\Pages\Host\Properties\PropertiesIndex::class);

        // New Property
        Route::name('.new-property')->prefix('/new')->group(function () {
            Route::name('.overview')->get('/overview', App\Http\Pages\Host\Properties\NewProperty\NewPropertyOverview::class);
            Route::name('.basics')->get('/{property}/the-basics', App\Http\Pages\Host\Properties\NewProperty\NewPropertyBasics::class);
            Route::redirect('/', route('host.properties.new-property.overview'));
        });



        // Route::name('new-property.')->prefix('/app-property')->group(function () {
        //     // Route::name('')
        //     Route::name('create')->get('/add-property', App\Http\Pages\Host\Properties\AddPropertyIndex::class);
        // });
    });

    // Add Property

    Route::name('.settings')->prefix('/settings')->group(function () {
        Route::name('.index')->get('/', App\Http\Pages\Host\Settings\SettingsIndex::class);
    });
});
