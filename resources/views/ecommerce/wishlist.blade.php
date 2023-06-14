@extends('layouts.master')
@section('content')
    <wishlist
        :product-show-route="'{{ route('products.show', "") }}'"
        :wishlist-route="'{{ route('wishlists.index') }}'"
></wishlist>
@endsection
