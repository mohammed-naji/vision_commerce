<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('/', function() {
    return 'Home';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
