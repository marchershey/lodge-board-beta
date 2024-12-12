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

Route::get('/test', App\Http\Test::class);

// require __DIR__ . '/_auth.php';
// require __DIR__ . '/_frontend.php';
// require __DIR__ . '/_host.php';
// require __DIR__ . '/_setup.php';
// require __DIR__ . '/_util.php';

Route::get('/showallbanner', function () {
    return session()->all();
    // return "Yay, it worked!";
});

Route::get('/addBanner', function () {
    addBannerNotification('no-property', 'this is a test banner');

    return 'Banner added...';
});

Route::get('/flushbanner', function () {
    session()->forget('banners');

    return 'Banner Flushed...';
});
