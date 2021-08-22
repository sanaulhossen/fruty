
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title','Fruty | Dashbord')
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashbord') }}/assets/images/logo/favicon.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ asset('dashbord') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ asset('dashbord') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('dashbord') }}/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('dashbord') }}/assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/alertify.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark header__logo mt-3">
                    <a href="{{ url('/') }}"> <h3 class="text-dark"> <strong>F</strong> r u t y</h3> </a>
                </div>
                <div class="logo logo-white header__logo mt-3">
                    <a href="{{ url('/') }}"> <h3 class="text-dark"> <strong>F</strong> r u t y</h3> </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <a href="javascript:void(0);" data-toggle="dropdown">
                                <i class="anticon anticon-bell notification-badge"></i>
                            </a>
                            <div class="dropdown-menu pop-notification">
                                <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                    <p class="text-dark font-weight-semibold m-b-0">
                                        <i class="anticon anticon-bell"></i>
                                        <span class="m-l-10">Notification</span>
                                    </p>
                                    <a class="btn-sm btn-default btn" href="javascript:void(0);">
                                        <small>View All</small>
                                    </a>
                                </div>
                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                    <i class="anticon anticon-mail"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">You received a new message</p>
                                                    <p class="m-b-0"><small>8 min ago</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">

                                    @auth
                                        <img src="{{ asset('dashbord') }}/image/profile_photo/{{ Auth::user()->profile_photo }}"  alt="{{ Auth::user()->profile_photo }}">
                                    @endauth
                                    @guest
                                        <img src="{{ asset('dashbord') }}/image/profile_photo/default_pic.jpg"  alt="default_pic.jpg">
                                    @endguest

                                </div>
                            </div>

                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-60">
                                        <div class="avatar avatar-lg avatar-image">
                                            @auth
                                                <img src="{{ asset('dashbord') }}/image/profile_photo/{{ Auth::user()->profile_photo }}"  alt="{{ Auth::user()->profile_photo }}">
                                            @endauth
                                            @guest
                                                <img src="{{ asset('dashbord') }}/image/profile_photo/default_pic.jpg"  alt="default_pic.jpg">
                                            @endguest
                                        </div>
                                        <div class="m-l-10">

                                            @auth
                                                <p class="mt-2">{{ Auth::user()->name }}</p>
                                            @endauth
                                            @guest
                                                <p class="mt-2">-----</p>
                                            @endguest


                                            @auth
                                                <p class="opacity-07">{{ Auth::user()->profession }}</p>
                                            @endauth
                                            @guest
                                                <p class="opacity-07">--,---</p>
                                            @endguest

                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('profile') }}" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                            <span class="m-l-10">Edit Profile</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">{{ __('Logout') }}</span>
                                        </div>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>


                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                                <i class="anticon anticon-appstore"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{ url('/home') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Home</span>
                            </a>
                        </li>

                        {{--  Product dropdown start --}}
                        <li class="nav-item dropdown @yield('product_main')">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-product-hunt"></i>
                                </span>
                                <span class="title">Product</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown @yield('product')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fab fa-product-hunt"></i>
                                        </span>
                                        <span class="title">Product</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addproduct')">
                                            <a href="{{ url('add/product') }}">Add Product</a>
                                        </li>
                                        <li class="@yield('indexproduct')">
                                            <a href="{{ route('product.index') }}">Details Product</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('category')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fas fa-radiation"></i>
                                        </span>
                                        <span class="title"> Category</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addcategory')">
                                            <a href="{{ url('add/category') }}">Add Category</a>
                                        </li>
                                        <li class="@yield('indexcategory')">
                                            <a href="{{ route('category.index') }}">Details Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('tag')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        <span class="title"> Tag</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addtag')">
                                            <a href="{{ url('add/tag') }}">Add Tag</a>
                                        </li>
                                        <li class="@yield('indextag')">
                                            <a href="{{ route('tag.index') }}">Details Tag</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('type')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fas fa-spray-can"></i>
                                        </span>
                                        <span class="title"> Product Type</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addtype')">
                                            <a href="{{ url('add/product_type') }}">Add Product Type</a>
                                        </li>
                                        <li class="@yield('indextype')">
                                            <a href="{{ route('productType.index') }}">Product Type</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{--  Product dropdown finished --}}

                        {{--  About dropdown start --}}
                        <li class="nav-item dropdown @yield('about_main')">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-connectdevelop"></i>
                                </span>
                                <span class="title">About</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu ">
                                <li class="nav-item dropdown @yield('about')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fab fa-connectdevelop"></i>
                                        </span>
                                        <span class="title">About</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addabout')">
                                            <a href="{{ route('about.add') }}">Add About</a>
                                        </li>
                                        <li class="@yield('indexabout')">
                                            <a href="{{ route('about.index') }}">Details About</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('testimonials')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fab fa-codiepie"></i>
                                        </span>
                                        <span class="title">Testimonials</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addtestimonials')">
                                            <a href="{{ route('add.testimonial') }}">Testimonials</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('team')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fab fa-teamspeak"></i>
                                        </span>
                                        <span class="title">Team</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('indexteam')">
                                            <a href="{{ route('team.index') }}">Team</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('client')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fas fa-people-carry"></i>
                                        </span>
                                        <span class="title">Client</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addclient')">
                                            <a href="{{ route('client.add') }}">Add Client</a>
                                        </li>
                                        <li class="@yield('indexclient')">
                                            <a href="{{ route('client.index') }}">Details Client</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('review')">
                                    <a class="dropdown-toggle" href="{{ route('review.index') }}">
                                        <span class="icon-holder">
                                           <i class="fas fa-sun"></i>
                                        </span>
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--  about dropdown finished --}}

                        {{--  Blog dropdown start --}}
                        <li class="nav-item dropdown @yield('main_blog')">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-blogger"></i>
                                </span>
                                <span class="title">Blog</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown @yield('blog')">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="icon-holder">
                                            <i class="fab fa-blogger"></i>
                                        </span>
                                        <span class="title">Blog</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="@yield('addblog')">
                                            <a href="{{ route('add.blog') }}">Add Blog</a>
                                        </li>
                                        <li class="@yield('indexblog')">
                                            <a href="{{ route('blog.index') }}">Details Blog</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @yield('blog_category')">
                                    <a class="dropdown-toggle" href="{{ route('blogCategory.index') }}">
                                        <span class="icon-holder">
                                            <i class="fas fa-radiation"></i>
                                        </span>
                                        <span class="title"> Blog Category</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--  Blog dropdown finished --}}

                        {{--  Slider dropdown Start --}}
                        <li class="nav-item dropdown @yield('main_slider')">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-holder">
                                    <i class="fab fa-slideshare"></i>
                                </span>
                                <span class="title">Slider</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="@yield('addslider')">
                                    <a href="{{ url('add/slider') }}">Add Slider</a>
                                </li>
                                <li class="@yield('indexslider')">
                                    <a href="{{ route('slider.index') }}">Details Slider</a>
                                </li>
                            </ul>
                        </li>
                        {{--  Slider dropdown finished --}}

                        {{--  Coupon dropdown Start --}}
                        <li class="nav-item dropdown @yield('main_coupon')">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-holder">
                                    <i class="fas fa-frog"></i>
                                </span>
                                <span class="title">Coupon</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="@yield('addcoupon')">
                                    <a href="{{ url('add/coupon') }}">Add Coupon</a>
                                </li>
                                <li class="@yield('indexcoupon')">
                                    <a href="{{ route('coupon.index') }}">Details Coupon</a>
                                </li>
                            </ul>
                        </li>
                        {{--  Coupon dropdown Finished --}}

                        {{--  Instagram dropdown Start --}}
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-holder">
                                    <i class="fab fa-instagram"></i>
                                </span>
                                <span class="title">Instagram</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="@yield('instagramadd')">
                                    <a href="{{ route('instagram.add') }}">Add Post</a>
                                </li>
                                <li class="@yield('instagramindex')">
                                    <a href="{{ route('instagram.index') }}">Details Post</a>
                                </li>
                            </ul>
                        </li>
                        {{--  Instagram dropdown Finished --}}

                        {{--  Contact Message Start --}}
                        <li class="nav-item dropdown @yield('message')">
                            <a class="dropdown-toggle" href="{{ url('contact/message/show') }}">
                                <span class="icon-holder">
                                    <i class="fab fa-facebook-messenger"></i>
                                </span>
                                <span class="title">Contact Message</span>
                            </a>
                        </li>
                        {{--  Contact Message Start --}}

                        {{--  Users area Start --}}
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{ url('user') }}">
                                <span class="icon-holder">
                                    <i class="fas fa-user-astronaut"></i>
                                </span>
                                <span class="title">Users</span>
                            </a>
                        </li>
                        {{--  Users area Start --}}

                        {{--  Subscriber area Start --}}
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{ url('subscriber') }}">
                                <span class="icon-holder">
                                    <i class="fas fa-users"></i>
                                </span>
                                <span class="title">Subscriber</span>
                            </a>
                        </li>
                        {{--  Subscriber area Start --}}


                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->





            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="row">

                        @yield('dashbord_content')

                    </div>
                </div>

            <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © 2021 Frutika. All rights reserved.</p>
                        <span>
                            <a href="{{ url('faq') }}" class="text-gray m-r-15" href="">FAQ</a>
                            <a href="{{ url('terms') }}" class="text-gray">Term & Conditions</a>
                        </span>
                    </div>
                </footer>
                <!-- Footer END -->
            </div>

            <!-- Search Start-->
            <div class="modal modal-left fade search" id="search-drawer">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between align-items-center">
                            <h5 class="modal-title">Search</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search End-->

            <!-- Quick View START -->
            <div class="modal modal-right fade quick-view" id="quick-view">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between align-items-center">
                            <h5 class="modal-title">Theme Config</h5>
                        </div>
                        <div class="modal-body scrollable">
                            <div class="m-b-30">
                                <h5 class="m-b-0">Header Color</h5>
                                <p>Config header background color</p>
                                <div class="theme-configurator d-flex m-t-10">
                                    <div class="radio">
                                        <input id="header-default" name="header-theme" type="radio" checked value="default">
                                        <label for="header-default"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-primary" name="header-theme" type="radio" value="primary">
                                        <label for="header-primary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-success" name="header-theme" type="radio" value="success">
                                        <label for="header-success"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-secondary" name="header-theme" type="radio" value="secondary">
                                        <label for="header-secondary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-danger" name="header-theme" type="radio" value="danger">
                                        <label for="header-danger"></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="m-b-0">Side Nav Dark</h5>
                                <p>Change Side Nav to dark</p>
                                <div class="switch d-inline">
                                    <input type="checkbox" name="side-nav-theme-toogle" id="side-nav-theme-toogle">
                                    <label for="side-nav-theme-toogle"></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="m-b-0">Folded Menu</h5>
                                <p>Toggle Folded Menu</p>
                                <div class="switch d-inline">
                                    <input type="checkbox" name="side-nav-fold-toogle" id="side-nav-fold-toogle">
                                    <label for="side-nav-fold-toogle"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View END -->
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('dashbord') }}/assets/js/vendors.min.js"></script>
    <script src="{{ asset('dashbord') }}/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ asset('dashbord') }}/assets/js/pages/dashboard-default.js"></script>
    <script src="{{ asset('dashbord') }}/assets/js/app.min.js"></script>
    <script src="{{ asset('frontend') }}/js/alertify.min.js"></script>
    <script src="{{ asset('dashbord') }}/assets/js/ckeditor.js"></script>
    <script src="{{ asset('dashbord') }}/assets/js/pages/profile.js"></script>

    @yield('footer_scripts')
</body>
</html>
