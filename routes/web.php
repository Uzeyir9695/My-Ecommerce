<?php

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
Route::middleware('auth')->group(function () {
    Route::controller(\App\Http\Controllers\EcommerceController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/all-categories-products', 'allProductsView')->name('all-products-view');
        Route::get('/all-products', 'allProducts')->name('all-products');
        Route::get('/category/subcategory/{subcategory}/{slug}', 'ecommerceIndex')->name('subcategories.index');
        Route::get('/subcategory/products/{subcategory}/{slug}', 'getAttributes')->name('subcategories.products');
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
        Route::get('/carts/checkout', 'checkout')->name('carts.checkout');
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

    Route::view('/payment-success', 'payment-success');
});

// Laravel socialite routes
Route::controller(\App\Http\Controllers\SocialController::class)->group(function () {
    Route::get('auth/{social}/redirect', 'redirect')->name('social.redirect');
    Route::get('auth/{social}/callback', 'callback')->name('social.callback');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::fallback(function () {
    return view('error.404');
})->name('error');
