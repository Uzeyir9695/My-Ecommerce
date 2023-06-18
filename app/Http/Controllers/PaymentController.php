<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Cart;

class PaymentController extends Controller
{
    public static function orderDetails(Request $request)
    {
        $orderedItems = $request->orderedItems;

        foreach ($orderedItems as $item){
            OrderDetail::create([
                'user_id' => auth()->id(),
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
            ]);
        }

        // Convert an array to a Laravel collection
        $collection = collect($orderedItems);
        $cartIDs = $collection->pluck('id')->all();
        Cart::where('user_id', auth()->id())->whereIn('id', $cartIDs)->delete(); // Delete all the ordered product from cart after payment
    }

    public static function validateOrderAddress(OrderRequest $request)
    {
        $request->validated();
    }

    public static function orderAddress(OrderRequest $request)
    {
        Order::create([
            'user_id' => auth()->id(),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'city' => $request->city,
            'aptnumber' => $request->aptnumber,
            'zipcode' => $request->zipcode,
            'landmark' => $request->landmark,
        ]);
    }

    public function payment(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method;

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($request->total_price * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
        return back();
    }
}
