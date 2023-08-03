@extends('layouts.master')
@section('content')
        <category-products
            breadcrumb="{{ Str::title(request()->segment(4)) }}"
            :sub-cat-route="'{{ route('category.products', [request()->segment(3), request()->segment(4)]) }}?page=1'"
            :product-show-route="'{{ route('products.show', "") }}'"
            :add-wishlist-route="'{{ route('wishlists.store') }}'"
        ></category-products>
@endsection
