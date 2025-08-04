<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
    // return "Welcome to the E-commerce Application!";
});

Route::get('/products', function () {
    return view('products.index');
    // return "Product Details for: ";
});

Route::get('/cart', function () {
    return "Cart Details";
});

Route::get('/checkout', function () {
    return "Checkout Details";
});
