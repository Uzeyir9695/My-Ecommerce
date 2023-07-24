<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });

    Route::controller(\App\Http\Controllers\EcommerceController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/all-products', 'allProducts')->name('all-products');
        Route::get('/category/subcategory/{subcategory}/{slug}', 'getAttributes')->name('subcategories.products');
        Route::get('/my-orders', 'myOrders')->name('my-orders')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group( function () {
        Route::resource('stores', \App\Http\Controllers\StoreController::class);
        Route::resource('products', \App\Http\Controllers\ProductController::class);

        Route::controller(\App\Http\Controllers\CartController::class)->group(function () {
            Route::get('/navbar-carts', 'navbarCart')->name('navbar.carts');
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
    });

//    Route::resource('stores', \App\Http\Controllers\StoreController::class)->only(['index', 'show']);
//    Route::resource('products', \App\Http\Controllers\ProductController::class)->only(['index', 'show']);

    Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/subcategories', 'getSubcategories')->name('products.subcategories');
        Route::get('/attributes-values', 'getAttributesValues')->name('products.attributes');
    });

    Route::view('/payment-success', 'payment-success');

Route::view('coming-999ac779-3b4c-49d8-8c77-d352bb3d52a3-soon', 'coming-soon')->name('coming-soon');

//Route::get('/', function () {
//    return redirect()->route('login');
//});

//Route::fallback(function () {
//    return view('error.404');
//})->name('error');
