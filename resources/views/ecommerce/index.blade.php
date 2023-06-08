@extends('layouts.master')
@section('content')
{{--    <h2 class="content-header-title float-left mb-0">{{ Str::title(request()->segment(5)) }} Shop</h2>--}}
        <product-index
            breadcrumb="{{ Str::title(request()->segment(4)) }}"
            :sub-cat-route="'{{ route('subcategories.index', ["", ""]) }}'"
            :product-show-route="'{{ route('products.show', "") }}'"
            :wishlist-route="'{{ route('wishlists.store') }}'"
            :products="{{ json_encode($products) }}"
            :attributes="{{ $attributes }}"
        ></product-index>
@endsection

