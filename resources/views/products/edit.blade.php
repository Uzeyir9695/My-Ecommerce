@extends('layouts.master')
@section('content')
    <product-edit
        :product-index-route="'{{ route('products.index') }}'"
        :product-id="'{{ request()->segment(2) }}'"
    >
    </product-edit>
@endsection
