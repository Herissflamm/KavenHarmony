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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/sell', function () {
    return view('home');
});

Route::get('/buy', function () {
    return view('home');
});

Route::get('/account', function () {
    return view('home');
});

Route::get('/messaging', function () {
    return view('home');
});

Route::get('/search', function () {
    return view('market/listIntrument');
});

Route::get('/about', function () {
    return view('home');
});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');