
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Frutika - Admin Dashboard Template</title>

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
                                    <div class="d-flex align-items-center justify-content-between m-b-10">
                                        <h1 class="text-muted"><strong class="text-info">F</strong>rutika</h1>
                                        <h2 class="m-b-0 text-muted">Sign In</h2>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label class="font-weight-semibold">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="email" id="main_email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>

                                            @if (Route::has('password.request'))
                                                    <a class="float-right font-size-13 text-muted" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif

                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" id="main_password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    Don't have an account?
                                                    <a href="{{ route('register') }}"> Signup</a>
                                                </span>
                                                <button type="submit" class="btn btn-primary btn-tone">Sign In</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row copy_data">
                                        <div class="form-group col-md-5">
                                            <input type="text" class="form-control" id="admin_email" value="sen.pstu@gmail.com" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control" id="admin_password" value="123456789" readonly>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="submit" class="copy_btn btn btn-primary btn-tone">Copy</button>
                                        </div>
                                    </div>


                                    {{-- Start Login with social media --}}

                                    <div class="pb-3">
                                        <div>
                                            <div class="row justify-content-center">
                                                <h3><strong>Login</strong></h3>
                                            </div>
                                            <div class="row justify-content-center pb-2">
                                                <h5>With your social media account</h5>
                                            </div> <!-- Social Media Login buttons -->
                                            <div class="row justify-content-center">
                                                <div class="col-10">
                                                    <div class="row justify-content-center">
                                                        <!-- GitHub Connect -->
                                                        <div class="col-7 col-sm-4 px-1">
                                                            <a href="{{ url('login/github') }}" class="btn btn-block btn-dark btn-twitter btn-tone">
                                                                <i class="fab fa-github"></i> GitHub
                                                            </a>
                                                        </div>
                                                        <!-- Google Connect -->
                                                        <div class="col-7 col-sm-4 px-1">
                                                            <a href="{{ url('auth/google') }}" class="btn btn-block btn-danger btn-google btn-tone">
                                                                <i class="fab fa-google"></i> Google
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- Horizontal Line -->
                                    </div>

                                    {{-- End Login with social media --}}

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

    <script>
        $(document).ready(function(){
             $(document).on('click','.copy_btn', function(e){
                e.preventDefault();

                var email = $(this).closest('.copy_data').find('#admin_email').val();
                var password = $(this).closest('.copy_data').find('#admin_password').val();

                $('#main_email').val(email);
                $('#main_password').val(password);

            })
        });
    </script>

</body>

</html>
