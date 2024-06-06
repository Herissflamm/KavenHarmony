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
})->name('home');

Route::get('/home', function () {
    return view('home');
});

Route::get('/sell', [ProductController::class, 'showCreate'])->middleware(IsConnected::class)->middleware(IsSeller::class);


Route::post('/newProduct', [ProductController::class, 'createNewProduct'])->name('newProduct')->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::post('/newProductLocation', [ProductController::class, 'createNewProductLocation'])->name('newProductLocation')->middleware(IsConnected::class)->middleware(IsSeller::class);


Route::get('/buy', function () {
    return view('home');
});

Route::get('/getOrder', [OrderController::class, 'getOrder'])->name("getOrder")->middleware(IsConnected::class);

Route::get('/myBasket', [OrderController::class, 'getMyBasket'])->name("myBasket")->middleware(IsConnected::class);

Route::get('/addToBasket', [OrderController::class, 'addToBasket'])->name("addToBasket")->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::post('/addToBasketRent', [OrderController::class, 'addToBasketRent'])->name("addToBasketRent")->middleware(IsConnected::class);

Route::get('/validate', [OrderController::class, 'validateOrder'])->name("validate")->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/boughtProduct', [OrderController::class, 'getAllOrders'])->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/soldProduct', [ProductController::class, 'showAllMyProduct'])->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::get('/filterProduct', [ProductController::class,'filterProduct']);

Route::delete('/deleteFromMyOrder', [OrderController::class,'deleteInstrumentFromOrder'])->middleware(IsConnected::class)->middleware(IsCustomer::class);

Route::get('/account',  [UserController::class, 'showMyAccount'])->name('account')->middleware(IsConnected::class);

Route::get('/accountSeller',  [UserController::class, 'showAccount'])->name("accountSeller");

Route::post('/modifyAccountPost', [UserController::class, 'modifyAccount'])->name("modifyAccountPost")->middleware(IsConnected::class);

Route::get('/modifyAccount', [UserController::class, 'showModifyAccount'])->name("modifyAccount")->middleware(IsConnected::class);

Route::get('/modifyProduct', [ProductController::class, 'showModifyProduct'])->name("modifyProduct")->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::post('/modifyProductPost', [ProductController::class, 'modifyProduct'])->name("modifyProductPost")->middleware(IsConnected::class)->middleware(IsSeller::class);

Route::get('/messaging', function () {
    return view('home');
});

Route::get('/mention', function () {
    return view('/right/legalMention');
});

Route::get('/mention', function () {
    return view('/right/conditionSell');
});

Route::get('/search', [ProductController::class, 'showSearch']);

Route::get('/product', [ProductController::class,'showProduct'])->name('product');

Route::get('/about', function () {
    return view('home');
});

Route::get('/partition', function () {
    return view('home');
});

Route::get('logoutAccount', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logoutAccount');


Route::get('404', function (){
    return view('404');
});

Route::get('/500', fn() => abort(500));