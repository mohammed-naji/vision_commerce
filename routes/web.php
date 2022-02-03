<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\MainController;

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

});


Route::get('/', [MainController::class, 'index'])->name('site.home');
Route::get('/shop', [MainController::class, 'shop'])->name('site.shop');
Route::get('/blog', [MainController::class, 'blog'])->name('site.blog');
Route::get('/contact', [MainController::class, 'contact'])->name('site.contact');
Route::post('/contact', [MainController::class, 'contactus'])->name('site.contactus');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
