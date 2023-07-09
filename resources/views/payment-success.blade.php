@extends('layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="d-flex flex-column align-items-center">
                <h1 class="d-block text-success mb-1">Payment was successfull!</h1>
                <h3 class="d-block mb-1">Thanks for your purchase!</h3>
                <h4 class="d-block">Continue <a href="{{ route('all-products-view') }}"> Shopping!</a></h4>
            </div>
        </div>
    </div>
@endsection
