<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product.media')->where('user_id', auth()->id())->latest()->paginate(21);

        if (request()->ajax()) {
            return response()->json(['wishlists' => $wishlists], 200);
        }
        return view('ecommerce.wishlist');
    }

    public function addToWishlist(Request $request)
    {
        $wishlist = Wishlist::create([
           'user_id' => auth()->id(),
           'product_id' => $request->id
        ]);
        $wishlist_id = $wishlist->id;
        return response()->json(['message' => 'Added to wishlist!', 'wishlist_id' => $wishlist_id], 201);
    }

    public function destroy($id)
    {
        Wishlist::where('product_id', $id)->delete();

        return response()->json(['message' => 'Removed from wishlist'], 200);
    }
}
