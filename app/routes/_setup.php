<?php

use Illuminate\Support\Facades\Route;

// Route::name('setup')->middleware(['setup.incomplete'])->get('/setup', App\Http\Pages\Setup\SetupIndex::class);

Route::name('setup.')->prefix('setup')->middleware(['setup.incomplete'])->group(function () {
    Route::name('index')->get('/', function () {
        return redirect('/setup/welcome');
    });
    Route::name('welcome')->get('/welcome', App\Http\Pages\Setup\Welcome::class);
    Route::name('host-account')->get('/host-account', App\Http\Pages\Setup\HostAccount::class);
    Route::name('basics')->get('/basics', App\Http\Pages\Setup\Basics::class);
    // Route::name('first-listing')->get('/first-listing', App\Http\Pages\Setup\FirstListing::class);
    // Route::name('listing-details')->get('/listing-details', App\Http\Pages\Setup\ListingDetails::class);
});
