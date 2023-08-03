<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use http\Client\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        return redirect()->route('all-products');
    }

    public function allProducts()
    {
        $query = Product::whereNot('user_id', auth()->id())->with('media')->select('id', 'price', 'discount', 'quantity', 'description');

        $searchQuery = request('search');
        if (!empty($searchQuery)) {
            $query->where('name', 'like', $searchQuery . '%');
        }

        $products = $query->paginate(21);
        if (request()->ajax()) {
            return response()->json(['products' => $products], 200);
        }

        return view('ecommerce.index');
    }

    public function categoryProducts(Subcategory $subcategory)
    {
        if(route('category.products', [$subcategory->id, $subcategory->slug]) !== \request()->url()) {
            return view('error.404');
        }

        // Filter according to the attribute-values
        if(\request()->has('filters')) {
            // convert filtered data to an array
            $attribute_values = json_decode(\request('filters'));
            $products = Product::where('subcategory_id', $subcategory->id)->pluck('id');

            // Loop and separate attributes and values and push them in an appropriate array
            $attrNames = [];
            $attrValues = [];

            foreach ($attribute_values as $attributeName => $attributeValues) {
                array_push($attrNames, $attributeName);
                foreach ($attributeValues as $attributeValue) {
                    array_push($attrValues, $attributeValue);
                }
            }

            $query =  ProductAttribute::whereIn('product_id', $products)->whereIn('name', $attrNames)->whereIn('value', $attrValues);
            $filteredProductsIds = $query->pluck('product_id')->unique(); // get filtered products' IDs
            $products = Product::with('media')
                ->whereIn('id', $filteredProductsIds)
                ->select('id', 'price', 'discount', 'description')
                ->paginate(21);
        }
        else {
            $products = Product::with(['media', 'carts'])
                ->select('id', 'price', 'discount', 'description')
                ->where('subcategory_id', $subcategory->id)
                ->paginate(21);
        }


        $attributes = $subcategory->attributes()->get()->groupBy(function($data) {
            return $data->name;
        });

        if (request()->ajax()) {
            return response()->json(['products' => $products, 'attributes' => $attributes], 200); // Note: No need to check ajax request if we use api routes
        }

        return view('ecommerce.category-products');

    }

    public function myOrders()
    {
        $orders = OrderDetail::where('user_id', auth()->id())->get();
        return view('ecommerce.orders', compact('orders'));
    }

}
