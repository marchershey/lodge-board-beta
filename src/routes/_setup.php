<?php

use Illuminate\Support\Facades\Route;

Route::name('setup')->middleware(['guest'])->get('/setup', App\Http\Pages\Setup\SetupIndex::class);
