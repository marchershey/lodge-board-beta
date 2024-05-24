<?php

use Illuminate\Support\Facades\Route;

Route::name('frontend.')->prefix('/')->middleware('setup.completed')->group(function () {
    Route::name('index')->get('/', App\Http\Pages\Frontend\Index::class);
});
