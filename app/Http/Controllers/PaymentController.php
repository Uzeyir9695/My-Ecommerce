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
        return response()->json(['status' => 'success'], 200);
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
        $paymentMethod = $request->input('payment_method');
        $amount = $request->input('amount');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Perform the payment
            $user->charge($amount *100, $paymentMethod);

            // Payment succeeded
            return response()->json(['message' => 'Thanks for your purchase!']);
        } catch (\Exception $exception) {
            // Payment failed
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
