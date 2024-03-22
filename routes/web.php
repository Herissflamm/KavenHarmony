<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/account', function (Request $request) {
    $userController = new UserController();
    return $userController->showMyAccount($request);
});

Route::get('/modifyAccount', function (Request $request) {
    $userController = new UserController();
    return $userController->showModifyAccount($request);
});

Route::get('/messaging', function () {
    return view('home');
});

Route::get('/search', function () {
    return view('market/listIntrument');
});

Route::get('/product', function () {
    return view('market/product');
});

Route::get('/about', function () {
    return view('home');
});

Route::get('/partition', function () {
    return view('home');
});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');