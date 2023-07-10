@extends('layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Coming soon page-->
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h2 class="mb-1">Hey {{ auth()->user()->name }}, We encourage you to be patient.</h2>
                            <h2 class="mb-1">We are launching soon 🚀</h2>
                           <img class="img-fluid" src="../../../app-assets/images/pages/coming-soon.svg" alt="Coming soon page" />
                        </div>
                    </div>
                </div>
                <!-- / Coming soon page-->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
