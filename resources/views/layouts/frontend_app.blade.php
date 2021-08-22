<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title','Fruty | Home')
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashbord') }}/assets/images/logo/favicon.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/core-style.css" type="text/css">
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/alertify.min.css"/>
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/custom.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('frontend') }}/img/icon/search.png" alt=""></a>
            <a href="#"><img src="{{ asset('frontend') }}/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="{{ asset('frontend') }}/img/icon/cart.png" alt="">
                <span class="basket-item-count">
                    <span id="cart_total_item">0</span>
                </span>
            </a>

        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Info: mdsanaul.pstu@gmail.com</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Info: mdsanaul.pstu@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__hover">

                               @auth
                                    <a href="#" class="text-white auth_name_login">

                                        @auth
                                            {{ Auth::user()->name }}
                                        @endauth

                                        <i class="arrow_carrot-down"></i>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('profile/page') }}"> Profile </a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                @endauth
                                @guest
                                    <a href="{{ url('/login') }}" class="text-white"> Login </a>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"> <h5> <strong>F</strong> r u t y</h5> </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="@yield('home')"><a href="{{ url('/') }}">Home</a></li>
                            <li class="@yield('shop')"><a href="{{ url('shop') }}">Shop</a></li>
                            <li class="@yield('about')"><a href="{{ url('about') }}">About</a></li>
                            <li class="@yield('blog')"><a href="{{ url('blog') }}">Blog</a></li>
                            <li class="@yield('contact')"><a href="{{ url('contact') }}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">

                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{ asset('frontend') }}/img/icon/search.png" alt=""></a>
                        <a href="{{ url('wish') }}"><img src="{{ asset('frontend') }}/img/icon/heart.png" alt="">
                            <span class="wish-item-count">
                                <span id="cart_total_item">0</span>
                            </span>
                        </a>
                        <a href="{{ url('cart') }}"><img src="{{ asset('frontend') }}/img/icon/cart.png" alt="">
                            <span class="basket-item-count">
                                <span id="cart_total_item">0</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->




@yield('frontend_content')




    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{ url('/') }}"> <h4 class="text-white"> <strong>F</strong> r u t y</h4> </a>
                        </div>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay strict attention.</p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="{{ url('cart') }}">Cart</a></li>
                            <li><a href="{{ url('wish') }}">Wish</a></li>
                            <li><a href="{{ url('terms') }}">Term & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Page</h6>
                        <ul>
                            <li><a href="{{ url('about') }}">About</a></li>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Connected with us ...</p>

                            <form id="footer__newslatter">

                                <input required type="email" id="subscriber_email" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | Fruty is made by <a href="https://portfolio.hingtu.xyz" target="_blank">subbir_sanaul</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- ****** Quick View Modal Area Start ****** -->
    @include('frontend.includes.quickview')
    <!-- ****** Quick View Modal Area End ****** -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('frontend') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script src="{{ asset('frontend') }}/js/alertify.min.js"></script>
    <script src="{{ asset('frontend') }}/js/active.js"></script>
    <script src="{{ asset('frontend') }}/js/custom.js"></script>


    @yield('footer_scripts')

</body>
</html>
