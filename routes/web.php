<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CoustomerController;


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

// auth route start here
Auth::routes();

// auth route end here

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('category/details/{slug}', [FrontendController::class, 'category_details'])->name('category.details');
Route::get('product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/get/size', [FrontendController::class, 'getsize'])->name('get.size');
Route::post('/get/stock', [FrontendController::class, 'getstock'])->name('get.stock');
Route::post('/add/to/cart', [FrontendController::class, 'add_to_cart'])->name('add.to.cart');
Route::post('/get/city', [FrontendController::class, 'get_city'])->name('get.city');
Route::post('/check/cuppon', [FrontendController::class, 'check_cuppon'])->name('check.cuppon');
Route::post('/checkout/redirect', [FrontendController::class, 'checkout_redirect'])->name('checkout.redirect');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('change/name', [HomeController::class, 'change_name'])->name('change_name');
    Route::post('change/pasword', [HomeController::class, 'change_password'])->name('change_password');
    Route::get('shipping', [HomeController::class, 'shipping'])->name('shipping');
    Route::post('add/shipping', [HomeController::class, 'add_shipping'])->name('add.shipping');
});

Route::delete('category/hard/delete/{id}', [CategoryController::class, 'harddelete'])->name('category.harddelete');
Route::resource('category', CategoryController::class);

Route::resource('subcategory', SubcategoryController::class);
Route::delete('subcategory/hard/delete/{id}', [SubcategoryController::class, 'harddelete'])->name('subcategory.harddelete');

Route::resource('coupon', CouponController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class);
    Route::get('/color',[ ProductController::class, 'color'])->name('product.color');
    Route::get('/size', [ProductController::class, 'size'])->name('product.size');
    Route::post('/product/color/store', [ProductController::class, 'colorstore'])->name('product.color.store');
    Route::post('/product/size/store', [ProductController::class, 'sizestore'])->name('product.size.store');
    Route::get('/product/add/inventory/{id}', [ProductController::class, 'addinventory'])->name('product.add.inventory');
    Route::post('/product/add/inventory/{id}', [ProductController::class, 'addinventorypost'])->name('product.add.inventory.post');
    Route::delete('product/hard/delete/{id}', [ProductController::class, 'harddelete'])->name('product.harddelete');
    Route::post('/get/subcategory', [ProductController::class, 'get_subcategory'])->name('get.subcategory');
});



Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/remove/cart/{id}', [CartController::class, 'remove_cart'])->name('remove.cart');
Route::get('/clear/cart', [CartController::class, 'clear_cart'])->name('clear.cart');
Route::post('/cart/item/all/update', [CartController::class, 'cart_item_all_update'])->name('cart.item.all.update');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout/post', [CheckoutController::class, 'checkout_post'])->name('checkout.post');


Route::get('coustomer', [CoustomerController::class, 'coustomer'])->name('coustomer');
Route::post('coustomer/register', [CoustomerController::class, 'coustomer_register'])->name('coustomer.register');
Route::get('coustomer.dashboard', [CoustomerController::class, 'coustomer_dashboard']);







