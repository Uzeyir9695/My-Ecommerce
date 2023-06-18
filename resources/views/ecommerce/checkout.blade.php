@extends('layouts.master')
@section('content')
    <checkout
        :product-show-route="'{{ route('products.show', "") }}'"
        :payment-route="'{{ route('stripe.payment') }}'"
    ></checkout>
@endsection
