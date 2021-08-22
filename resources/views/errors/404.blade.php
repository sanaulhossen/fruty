<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page not found</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashbord') }}/assets/images/logo/favicon.png">
    <!-- Core css -->
    <link href="{{ asset('dashbord') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ asset('dashbord') }}/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-20 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <div class="col-lg-3 col-md-3">
                        <div class="header__logo">
                            <a href="{{ url('/') }}"> <h1> <strong>F</strong> r u t y</h1> </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="p-v-30">
                                <h1 class="font-weight-semibold display-1 text-primary lh-1-2">404</h1>
                                <h2 class="font-weight-light font-size-30">Whoops! Looks like you got lost</h2>
                                <p class="lead m-b-30">We couldnt find what you were looking for.</p>
                                <a href="{{ url('/') }}" class="btn btn-primary btn-tone"><i class="anticon anticon-arrow-left"></i> Go Back Home</a>
                            </div>
                        </div>
                        <div class="col-md-6 m-l-auto">
                            <img class="img-fluid error_image" src="{{ asset('dashbord') }}/image/404.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex  p-h-40 justify-content-between">
                    <span class="">© <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                             Fruty</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ url('faq') }}" class="text-dark">FAQ</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('terms') }}" class="text-dark">Term & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Core Vendors JS -->
    <script src="{{ asset('dashbord') }}/assets/js/vendors.min.js"></script>
    <!-- Core JS -->
    <script src="{{ asset('dashbord') }}/assets/js/app.min.js"></script>
</body>
</html>
