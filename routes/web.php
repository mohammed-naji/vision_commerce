<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\MainController;

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('blogs', BlogController::class);

    Route::resource('testimonials', TestimonialController::class);

});


Route::get('/', [MainController::class, 'index'])->name('site.home');
Route::get('/shop', [MainController::class, 'shop'])->name('site.shop');
Route::get('/shop/{slug}', [MainController::class, 'shop_details'])->name('site.shop_details');

Route::post('/purchase_product/{id}', [MainController::class, 'purchase_product'])->name('site.purchase_product');

Route::delete('/delete_product/{id}', [MainController::class, 'delete_product'])->name('site.delete_product');

Route::get('/category/{slug}', [MainController::class, 'category_single'])->name('site.category_single');

Route::get('/blog', [MainController::class, 'blog'])->name('site.blog');
Route::get('/blog/{slug}', [MainController::class, 'blog_single'])->name('site.blog_single');

Route::post('/add-comment', [MainController::class, 'add_comment'])->name('site.add_comment');
Route::delete('/delete-comment/{id}', [MainController::class, 'delete_comment'])->name('site.delete_comment');

Route::get('/contact', [MainController::class, 'contact'])->name('site.contact');
Route::post('/contact', [MainController::class, 'contactus'])->name('site.contactus');

Route::get('cart', [MainController::class, 'cart'])->name('site.cart');
Route::post('update_cart', [MainController::class, 'update_cart'])->name('site.update_cart');

Route::get('checkout', [MainController::class, 'checkout'])->name('site.checkout');

Route::get('thanks', [MainController::class, 'thanks'])->name('site.thanks');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


Route::view('invoice', 'front.invoice');
