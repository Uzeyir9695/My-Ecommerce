@extends('layouts.master')
@section('content')
    <index
        :products-index-route="'{{ route('all-products-view') }}'"
        :product-show-route="'{{ route('products.show', "") }}'"
        :add-wishlist-route="'{{ route('wishlists.store') }}'"
    ></index>
@endsection
