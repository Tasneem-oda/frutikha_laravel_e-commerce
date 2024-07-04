<?php

use App\Http\Controllers\ProductController;
use App\Models\product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class , 'index'])->name('welcome');
Route::get('/shop',[ProductController::class,'show'])->name('shop');
Route::get('/contact',[ProductController::class,'contact'])->name('contact');
Route::get('/about',[productController::class , 'about'])->name('about');
Route::get('/cart',[productController::class , 'cart'])->name('cart');
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::post('add-to-cart', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::post('remove-from-cart', [ProductController::class, 'removeFromCart'])->name('remove.from.cart');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [productController::class, 'send'])->name('contact.send');