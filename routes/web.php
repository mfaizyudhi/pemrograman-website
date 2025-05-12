<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductController;

Route::get('/p', function () {
    return view('welcome');
})->name('home');


Route::get('/', [HomepageController::class, 'index']); 
Route::get('products', [HomepageController::class, 'products']); 
Route::get('product/{slug}', [HomepageController::class, 'product']); 
Route::get('categories',[HomepageController::class, 'categories']); 
Route::get('category/{slug}', [HomepageController::class, 'category']); 
Route::get('cart', [HomepageController::class, 'cart']); 
Route::get('checkout', [HomepageController::class, 'checkout']); 

// Route::get('/', function () {
//     return view('web.homepage');
// });

// Route::get('/products', function () {
//     return view('web.products');
// });

// Route::get('produk/{slug}', function ($slug) {
//     return view('web.single_products');
// });

// Route::get('/categories', function () {
//     return view('web.categories');
// });

// Route::get('categories/{slug}', function ($slug) {
//     return view('web.single_categories');
// });

// Route::get('/cart', function () {
//     return view('web.cart');
// });

// Route::get('/chekout', function () {
//     return view('web.checkout');
// });

Route::group(['prefix'=>'dashboard'],function(){
    Route::resource('posts', PostsController::class)->names('posts');
})->middleware(['auth', 'verified']);

Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories',ProductCategoryController::class);
    Route::resource('products', ProductController::class);

})->middleware(['auth', 'verified']);


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';