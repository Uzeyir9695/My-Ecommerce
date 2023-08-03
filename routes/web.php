<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
Route::middleware('guest')->controller(ForgotPasswordController::class)->group(function () {
    Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});

Route::middleware('auth')->group(function () {
    Route::controller(\App\Http\Controllers\EcommerceController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/all-products', 'allProducts')->name('all-products');
        Route::get('/subcategory/products/{subcategory}/{slug}', 'categoryProducts')->name('category.products');
        Route::get('/my-orders', 'myOrders')->name('my-orders');
    });

    Route::get('store-editor/{id}', [\App\Http\Controllers\StoreController::class, 'storeEditor']);
    Route::resource('stores', \App\Http\Controllers\StoreController::class);

    Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/subcategories', 'getSubcategories')->name('products.subcategories');
        Route::get('/attributes-values', 'getAttributesValues')->name('products.attributes');
        Route::get('/product-editor/{id}', 'productEditor')->name('product.editor');
    });
    Route::resource('products', \App\Http\Controllers\ProductController::class);

    Route::controller(\App\Http\Controllers\CartController::class)->group(function () {
        Route::get('/carts', 'index')->name('carts.checkout');
        Route::delete('/carts/{cart}', 'destroy')->name('navbar.carts.destroy');
        Route::post('/carts', 'addToCart')->name('carts.store');
        Route::put('/carts/{cart}', 'updateCart')->name('carts.update');
    });

    Route::controller(\App\Http\Controllers\PaymentController::class)->group(function () {
        Route::post('/orders/detail', 'orderDetails')->name('orders.orderDetails');
        Route::post('/orders/address/validate', 'validateOrderAddress')->name('orders.validateOrderAddress');
        Route::post('/orders/address', 'orderAddress')->name('orders.orderAddress');
        Route::post('/payment', 'payment')->name('stripe.payment');

    });
    Route::controller(\App\Http\Controllers\WishlistController::class)->group(function () {
        Route::get('/wishlists', 'index')->name('wishlists.index');
        Route::post('/wishlists', 'addToWishlist')->name('wishlists.store');
        Route::delete('/wishlists/{wishlist}', 'destroy')->name('wishlists.destroy');
    });

    Route::view('/payment-success', 'payment-success');
});

// Laravel socialite routes
Route::controller(\App\Http\Controllers\SocialController::class)->group(function () {
    Route::get('auth/{social}/redirect', 'redirect')->name('social.redirect');
    Route::get('auth/{social}/callback', 'callback')->name('social.callback');
});

Route::view('coming-999ac779-3b4c-49d8-8c77-d352bb3d52a3-soon', 'coming-soon')->name('coming-soon');

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::fallback(function () {
    return view('error.404');
})->name('error');
