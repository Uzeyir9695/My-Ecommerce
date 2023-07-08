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
{{--                            <a type="button" class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>--}}
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a>
                                <a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a>
                                <a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a>
                                <a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a>
                            </div>
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
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                        </button>
                                        <div class="search-results">{{ $products->total() }} | results found</div>
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
                        @foreach($products as $product)
                            <div class="card ecommerce-card">
                                <div class="item-img text-center">
                                    <a href="javascript:void(0);">
                                        <img class="img-fluid card-img-top" src="{{ $product->getFirstMediaUrl('productImages') }}" style="width: 450px; height: 290px;" alt="img-placeholder" />
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
                                        <div>
                                            <h6 class="item-price">{{ price($product->price, $product->discount) }} USD</h6>
                                        </div>
                                    </div>
                                    <h6 class="item-name">
                                        <a class="text-body" href="javascript:void(0)">{{ $product->name }}</a>
                                        <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                    </h6>
                                    <p class="card-text item-description">{{ $product->description }}
                                    </p>
                                </div>
                                <div class="item-options text-center">
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <h4 class="item-price">{{ price($product->price, $product->discount) }} USD</h4>
                                        </div>
                                    </div>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-light col-6">
                                        <i data-feather="eye"></i>
                                        <span>View</span>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary col-6">
                                        <i data-feather="edit"></i>
                                        <span class="add-to-cart">Edit</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </section>
                    <!-- E-commerce Products Ends -->

                    <!-- E-commerce Pagination Starts -->
                    <section id="ecommerce-pagination">
                        <div class="row d-flex justify-content-center">
                            {!! $products->onEachSide(5)->links() !!}
                        </div>
                    </section>
                    <!-- E-commerce Pagination Ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content

@endsection
