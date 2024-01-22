<?php

use Illuminate\Support\Facades\Route;

Route::name('setup')->middleware(['auth'])->get('/setup', App\Http\Pages\Setup\SetupIndex::class);
