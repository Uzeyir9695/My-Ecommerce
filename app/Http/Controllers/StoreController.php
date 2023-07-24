<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with('media')->where('user_id', auth()->id())->paginate(21);
        return response()->json(['stores' => $stores], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
       $data = $request->validated();
       $store = Store::create(array_merge(['user_id' => auth()->id()], $data));

        if($request->hasFile('logoImage') && $request->file('logoImage')->isValid()){
            $store->addMediaFromRequest('logoImage')->toMediaCollection('logos');
        }
        if($request->hasFile('coverImage') && $request->file('coverImage')->isValid()){
            $store->addMediaFromRequest('coverImage')->toMediaCollection('covers');
        }
        return response()->json(['message' => 'Store created successfuly']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $store->load('media');
        $products = $store->products()->paginate(12);
        return response()->json(['store' => $store, 'products' => $products], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $store->load('media');
        return response()->json(['store' => $store], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $validator = $request->validated();

        $store->update($validator);

        if($request->hasFile('logoImage') && $request->file('logoImage')->isValid()){
            $store->clearMediaCollection('logos');
            $store->addMediaFromRequest('logoImage')->toMediaCollection('logos');
        }
        if($request->hasFile('coverImage') && $request->file('coverImage')->isValid()){
            $store->clearMediaCollection('covers');
            $store->addMediaFromRequest('coverImage')->toMediaCollection('covers');
        }
        return response()->json(['message' => 'Store updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if(request('word') == 'Delete'){
            $store->delete();
            return response()->json(['success' => 'Store named '.$store->name.' deleted successfully.'], 201);
        }
    }
}
