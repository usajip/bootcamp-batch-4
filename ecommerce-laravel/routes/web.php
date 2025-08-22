<?php

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

Route::get('/product/detail/kjdhaskjdhasodhaoishdlakshndklasjndlaskjdlasjk', function () {
    return view('products.detail');
})->name('product.detail');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return "Checkout Details";
});

Route::get('page-1', function(){
    return view('page-1');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('product-categories', ProductCategoryController::class);
    });

    Route::get('dashboard/{id}/{name}', [Contoh2Controller::class, 'index'])
        ->name('dashboard.index');
    // {{ route('dashboard.index', ['id' => 1, 'name' => 'John Doe']) }}
    // {{ route('products.edit', ['id' => $product->id]) }}

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';