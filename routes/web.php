<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsCustomer;
use App\Http\Middleware\IsSeller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\IsConnected;

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

Route::get('/sell', [ProductController::class, 'showCreate'])->middleware(IsConnected::class)->middleware(IsSeller::class);


Route::post('/newProduct', function (Request $request) {
    $productController = new ProductController();
    $imageController = new ImageController();
    $imageController->store($request);
    return redirect('/search');
})->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::get('/buy', function () {
    return view('home');
});

Route::get('/getOrder', [OrderController::class, 'getOrder'])->name("getOrder")->middleware(IsConnected::class);

Route::get('/myBasket', [OrderController::class, 'getMyBasket'])->name("myBasket")->middleware(IsConnected::class);

Route::get('/addToBasket', [OrderController::class, 'addToBasket'])->name("addToBasket")->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/boughtProduct', [OrderController::class, 'getAllOrders'])->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/soldProduct', [ProductController::class, 'showAllMyProduct'])->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::get('/filterProduct', [ProductController::class,'filterProduct']);

Route::delete('/deleteFromMyOrder', [OrderController::class,'deleteInstrumentFromOrder'])->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/account',  [UserController::class, 'showMyAccount'])->middleware(IsConnected::class);

Route::get('/accountSeller',  [UserController::class, 'showAccount'])->name("accountSeller");

Route::post('/modifyAccount', [UserController::class, 'modifyAccount'])->name("modifyAccount")->middleware(IsConnected::class);

Route::get('/modifyAccount', [UserController::class, 'showModifyAccount'])->name("modifyAccount")->middleware(IsConnected::class);

Route::get('/modifyProduct', [ProductController::class, 'showModifyProduct'])->name("modifyProduct")->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::post('/modifyProduct', [ProductController::class, 'modifyProduct'])->name("modifyProduct")->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::get('/messaging', function () {
    return view('home');
});


Route::get('/search', [ProductController::class, 'showSearch']);


Route::get('/product', [ProductController::class,'showProduct'])->name('product');

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