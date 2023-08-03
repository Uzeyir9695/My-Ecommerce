@extends('layouts.master')
@section('content')
    <index
        :product-show-route="'{{ route('products.show', "") }}'"
        :add-wishlist-route="'{{ route('wishlists.store') }}'"
    ></index>
@endsection
