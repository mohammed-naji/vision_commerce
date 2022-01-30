<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);

});

Route::get('/', function() {
    // dd(Auth::user()->type);
    return 'Home';
});

Route::get('/user/{id}', function() {
    return 'Welcome ' . Auth::user()->name;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
