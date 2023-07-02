<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use http\Client\Request;
use function compact;
use function route;
use function view;

class EcommerceController extends Controller
{
    public function index()
    {
        return view('layouts.master'); // This view automatically gets and renders products from View Composer. path: Ecommerce/app/Views/Composers::class
    }

    public function ecommerceIndex(Subcategory $subcategory)
    {
        if(route('subcategories.index', [$subcategory->id, $subcategory->slug]) !== \request()->url()) {
            return view('error.404');
        }

        return view('ecommerce.index');
    }

    public function getAttributes(Subcategory $subcategory)
    {
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
            $products = Product::with('media')->whereIn('id', $filteredProductsIds)->paginate(21); // get filtered products
        }
        else {
            $products = Product::with(['media', 'carts'])->where('subcategory_id', $subcategory->id)->paginate(21);
        }


        $attributes = $subcategory->attributes()->get()->groupBy(function($data) {
            return $data->name;
        });

        return response()->json(['products' => $products, 'attributes' => $attributes], 200); // Note: No need to check ajax request if we use api routes
    }

}
