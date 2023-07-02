@extends('layouts.master')
@section('content')
    <product-create
        :product-index-route="'{{ route('products.index') }}'"
        :store-id="'{{ request()->query('store_id') }}'"
    ></product-create>
@endsection
