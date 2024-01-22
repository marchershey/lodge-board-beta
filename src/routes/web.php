<?php

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Http;
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

require __DIR__ . '/_auth.php';
require __DIR__ . '/_frontend.php';
require __DIR__ . '/_host.php';
require __DIR__ . '/_setup.php';
require __DIR__ . '/_util.php';

Route::get('/test', function () {
    $data = timezone_list();

    return collect($data)->toJson();
});
