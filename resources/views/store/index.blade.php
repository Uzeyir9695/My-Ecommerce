@extends('layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <a href="{{ route('stores.create') }}" class="btn btn-primary" type="button">Create a new store</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached content-center">
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <div class="search-results">{{ $stores->total() }} results found</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Content Section Starts -->

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                        @foreach($stores as $store)
                            <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="javascript:void(0);">
                                    <img class="img-fluid card-img-top" src="{{ $store->getFirstMediaUrl('logos') }}" style="width: 450px; height: 290px;" alt="img-placeholder" />
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="app-ecommerce-details.html">{{ $store->name }}</a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                </h6>
                                <p class="card-text item-description">{{ $store->description }}
                                </p>
                            </div>
                            <div class="text-center my-auto">
                                <a href="{{ route('stores.show', $store->id) }}" class="btn btn-primary col-12 ">
                                    <i data-feather="eye"></i>
                                    <span class="add-to-cart">View</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    <!-- E-commerce Products Ends -->
                    <!--  display if product not found-->
                    @if($stores->total() < 1)
                        <div class="row  d-flex justify-content-center">
                            <div>
                                <div class="text-center"><h1 class="mt-2">Store not found!</h1></div>
                            </div>
                        </div>
                    @endif
                    <!-- E-commerce Pagination Starts -->
                    <section id="ecommerce-pagination">
                        <div class="row d-flex justify-content-center">
                            {!! $stores->links() !!}

                        </div>
                    </section>
                    <!-- E-commerce Pagination Ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content

@endsection
