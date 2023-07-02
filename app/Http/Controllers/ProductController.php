<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use function dd;
use function json_decode;
use function json_encode;
use function request;
use function response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->with('productAttributes')->paginate(21);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        if (request()->ajax()) {
            return response()->json(['categories' => $categories], 200);
        }

        return view('products.create', compact('categories'));
    }


    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->get(['id', 'name']);
        return response()->json(['subcategories' => $subcategories], 200);
    }


    public function getAttributesValues(Request $request)
    {
        $attributes = Attribute::where('subcategory_id', $request->subcategory_id)->get()->groupBy(function($data) {
            return $data->name;
        });
        return response()->json(['attributes' => $attributes], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $validatedData = $request->validated();

        $staticData = $request->only(['store_id', 'category_id','subcategory_id', 'name', 'price', 'discount', 'description', 'quantity']);
        $product = Product::create(array_merge(['user_id' => auth()->id()], $staticData));
        // Insert product's attribute-values into product_attributes table
        $attributes = $request->only('attributes')['attributes'];
        foreach (json_decode($attributes) as $key => $value) {
            ProductAttribute::create([
                'product_id' => $product->id,
                'name' => $key,
                'value' => $value
            ]);
        }

        if($request->hasFile('images')){
            $product->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) use($product){
                    $image->usingName('image'.$product->id)->toMediaCollection('productImages');
            });
        }

        return response()->json(['message' => 'Product added successfuly'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('ecommerce.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     *
     */
    public function edit()
    {
        return view('products.edit');
    }

    // Method to fetch the product using Vue axios
    public function productEditor($id)
    {
        $product = Product::with('media')->findOrFail($id);
        return response()->json(['product' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $request->validated();
        $data = $request->only(['name', 'price', 'description', 'quantity', 'discount']);
        $product->update($data);

        if($request->hasFile('images')){
//            $product->clearMediaCollection('productImages');
            $product->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) use($product){
                    $image->usingName('image'.$product->id)->toMediaCollection('productImages');
                });
        }

        return response()->json(['message' => 'Product updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        // Note: this deletes only product image(s) not product
        if($request->media_id) {
            $collection = collect($product->getMedia('productImages'));
            $collect = [];
            foreach ($collection as $media) {
                if(in_array($media->id, \request('media_id'))) continue;
                $collect[] = $media;
            }

            $product->clearMediaCollectionExcept('productImages', $collect);

            return response()->json(['message' => 'Deleted Successfully!']);
        }
            return redirect()->back();
    }
}
