
<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->


<!-- END: Custom CSS-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>All-On-My-Web</title>
{{--    <title>Shop | {{ (request()->segment(1) == 'category'? collect(request()->segments())->last() : request()->segment(1))}}</title>--}}
    {{--    <title>Shop | {{ request()->path() }}</title>--}}
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-sliders.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-ecommerce-details.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-auth.css">

    {{--    store profile css--}}
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-profile.css">
    {{--    sweet alert css--}}
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    {{--    toastr css--}}
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/product-images-slide.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/stripe.css') }}">
    @yield('styles')
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">--}}
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
<noscript>
    <strong>We're sorry but All-On-My-Web doesn't work properly without
        JavaScript enabled. Please enable it to continue.</strong>
</noscript>

<div id="app">
{{--    <!-- BEGIN: Header-->--}}
{{--    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">--}}
{{--        <div class="navbar-container d-flex content">--}}
{{--            <div class="bookmark-wrapper d-flex align-items-center">--}}
{{--                <ul class="nav navbar-nav d-xl-none">--}}
{{--                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>--}}
{{--                </ul>--}}
{{--                <ul class="nav navbar-nav">--}}
{{--                    <div class="bookmark-input search-input">--}}
{{--                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>--}}
{{--                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">--}}
{{--                        <ul class="search-list search-list-bookmark"></ul>--}}
{{--                    </div>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <ul class="nav navbar-nav align-items-center ml-auto">--}}
{{--                <cart-list></cart-list>--}}
{{--                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"></span><span class="user-status">Customer</span></div><span class="avatar"><img class="round" src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">--}}
{{--                        <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="user"></i> Profile</router-link>--}}
{{--                        <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="shopping-cart"></i>My Stores</router-link>--}}
{{--                        <router-link :to="{name: 'products.index'}" class="dropdown-item"><i class="mr-50" data-feather="box"></i> My Products</router-link>--}}
{{--                        <router-link :to="{name: 'my-orders'}" class="dropdown-item"><i class="mr-50" data-feather="shopping-bag"></i> My Orders</router-link>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="settings"></i> Settings</router-link>--}}

{{--                        <a class="dropdown-item" href="#" @click.prevent="logout">--}}
{{--                            <i class="mr-50" data-feather="power"></i>--}}
{{--                            Logout--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <!-- END: Header-->--}}
{{--    --}}
{{--    <!-- BEGIN: Main Menu-->--}}
{{--    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">--}}
{{--        <div class="navbar-header">--}}
{{--            <ul class="nav navbar-nav flex-row">--}}
{{--                <li class="nav-item mr-auto"><a class="navbar-brand" href="/html/ltr/vertical-menu-template-semi-dark/index.html">--}}
{{--                        <img src="/app-assets/images/logo/favicon.ico" alt="logo">--}}
{{--                        <h2 class="brand-text">Ecommerce</h2>--}}
{{--                    </a></li>--}}
{{--                <li class="nav-item nav-toggle">--}}
{{--                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">--}}
{{--                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>--}}
{{--                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="shadow-bottom"></div>--}}
{{--        <div class="main-menu-content">--}}
{{--            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
{{--                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Categories</span><i data-feather="more-horizontal"></i>--}}
{{--                </li>--}}
{{--                <li class="nav-item mb-2" :class="this.$route.name === 'all-products' ? 'active' : ''">--}}
{{--                    <router-link :to="{ name: 'all-products' }">--}}
{{--                        <i data-feather="grid"></i>--}}
{{--                        <span class="menu-title text-truncate" data-i18n="Kanban">All Categories</span>--}}
{{--                    </router-link>--}}

{{--                </li>--}}
{{--                @foreach($categories as $category)--}}
{{--                    <li class=" nav-item">--}}
{{--                        <a class="d-flex align-items-center" href="#">--}}
{{--                            <img src="{{ asset($category->icon) }} " alt="" style="width: 25px; height: 25px; background-color: floralwhite; padding: 3px; border-radius: 50px; " class="mr-1">--}}
{{--                            <span class="menu-title text-truncate" data-i18n="Invoice">{{ $category->name }}</span>--}}
{{--                        </a>--}}
{{--                        <ul class="menu-content">--}}
{{--                            @foreach($category->subcategories as $subcategory)--}}
{{--                                <li >--}}
{{--                                    <router-link :to="{name: 'subcategory.products', params: { id: '{{$subcategory->id}}', slug: '{{$subcategory->slug}}' }}">--}}
{{--                                    <img src="{{ asset($subcategory->icon) }} " alt="" style="width: 28px; height: 28px; border-radius: 50px; padding: 3px; background-color: floralwhite" class="mr-1">--}}
{{--                                        <span class="menu-item text-truncate" data-i18n="List">{{ $subcategory->name }}</span>--}}
{{--                                    </router-link>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}
    <!-- END: Main Menu-->
{{--    <router-view name="login"></router-view>--}}
{{--<app></app>--}}
{{--    <router-view name="app"></router-view>--}}
</div>
@vite('resources/js/app.js')

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
{{--<footer class="footer footer-static footer-light">--}}
{{--    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">eCommerce</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>--}}
{{--</footer>--}}
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->
{{--@yield('scripts')--}}
<!-- BEGIN: Add product to cart adn remove JS-->
<script type=text/javascript>

    // global app configuration object
    var config = {
        routes: {
            validateOrderAddress: '{{ route('orders.validateOrderAddress') }}',
        },
    };
</script>
{{--<script src="{{ asset('js/product-details-image-carousel.js') }}"></script>--}}

<!-- END: Add product to cart adn remove JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Pages JS-->
<script src="/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
<script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
<script src="/app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
<!-- END: Pages JS-->

<!-- :Sweet alert Page Vendor JS below-->
<script src="/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="/app-assets/vendors/js/extensions/polyfill.min.js"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

</body>
<!-- END: Body-->

</html>
