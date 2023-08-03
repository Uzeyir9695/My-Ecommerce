<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product.media')->where('user_id', auth()->id())->get();
        if (request()->ajax()) {
            return response()->json(['carts' => $carts]);
        }
        return view('ecommerce.checkout');
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => request('quantity', 1),
            'discount' => $request->discount
        ]);

        $cart = $cart->load('product.media');

        return response()->json(['message' => 'Added to cart!', 'cart' => $cart], 201);
    }

    public function updateCart(Cart $cart, Request $request)
    {
        $cart->update([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => request('quantity', 1),
            'discount' => $request->discount
        ]);
        $cart = $cart->load('product.media');

        return response()->json(['cart' => $cart], 200);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(['message' => 'Removed from cart'], 201);
    }
}
