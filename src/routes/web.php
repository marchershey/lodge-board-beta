<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return redirect()->route('host.dashboard');
});

require __DIR__ . '/_auth.php';
require __DIR__ . '/_frontend.php';
require __DIR__ . '/_guest.php';
require __DIR__ . '/_host.php';
require __DIR__ . '/_util.php';
