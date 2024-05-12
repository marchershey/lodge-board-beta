<?php

use Illuminate\Support\Facades\Route;

Route::name('setup')->middleware(['setup.incomplete'])->get('/setup', App\Http\Pages\Setup\SetupIndex::class);
