<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashbord') }}/assets/images/logo/favicon.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ asset('dashbord') }}/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{ asset('dashbord') }}/assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="{{ asset('dashbord') }}/assets/images/logo/logo.png">
                                        <h2 class="m-b-0">Reset Password</h2>
                                    </div>


                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="email" class="font-weight-semibold"></label>

                                                <div class="col-md-12">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail Address">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 m-auto">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Send Password Reset Link') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2021 Frutika</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ url('faq') }}" class="text-dark text-link" href="">FAQ</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('terms') }}" class="text-dark text-link">Term & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('dashbord') }}/assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ asset('dashbord') }}/assets/js/app.min.js"></script>

</body>

</html>
