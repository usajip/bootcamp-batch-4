<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Contoh2Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/contoh', [ContohController::class, 'logika']);
Route::get('/index/{a}/{b}', [ContohController::class, 'tambah']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ContohController::class, 'index']);

Route::resource('resource', 'App\Http\Controllers\ResourceController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::get('/product/detail/{id}', [ProductController::class, 'show'])
    ->name('product.detail');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('products', ProductController::class);
            Route::resource('product-categories', ProductCategoryController::class);
        });
        Route::get('dashboard/{id}/{name}', [Contoh2Controller::class, 'index'])
        ->name('dashboard.index');
    });
    // {{ route('dashboard.index', ['id' => 1, 'name' => 'John Doe']) }}
    // {{ route('products.edit', ['id' => $product->id]) }}

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';