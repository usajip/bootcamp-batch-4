<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\HomeController;

Route::get('/contoh', [ContohController::class, 'logika']);
Route::get('/index/{a}/{b}', [ContohController::class, 'tambah']);

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ContohController::class, 'index']);

Route::resource('resource', 'App\Http\Controllers\ResourceController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::get('/cart', function () {
    return "Cart Details";
});

Route::get('/checkout', function () {
    return "Checkout Details";
});

Route::get('page-1', function(){
    return view('page-1');
});
