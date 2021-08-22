@extends('layouts.dashbord_app')

@section('title')
  Profile | Dashbord
@endsection

@section('dashbord_content')

    <!-- Content Wrapper START -->
        <div class="container">
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="tab-account">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="d-md-flex align-items-center">
                                        <div class="text-center text-sm-left ">
                                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                               <img src="{{ asset('dashbord') }}/image/profile_photo/{{ Auth::user()->profile_photo }}" alt="{{ Auth::user()->profile_photo }}">
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-left m-v-15 p-l-30">
                                            <h2 class="m-b-5">{{ Auth::user()->name }}</h2>
                                            <p class="text-opacity font-size-13">{{ Auth::user()->username }}</p>
                                            <p class="text-dark m-b-20">{{ Auth::user()->profession }}</p>
                                            <button class="btn btn-primary btn-tone">Contact</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="d-md-block d-none border-left col-1"></div>
                                        <div class="col">
                                            <ul class="list-unstyled m-t-10">
                                                <li class="row">
                                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                        <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                        <span>Email: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold"> {{ Auth::user()->email }}</p>
                                                </li>
                                                <li class="row">
                                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                        <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                                        <span>Phone: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold"> {{ Auth::user()->phone }}</p>
                                                </li>
                                                <li class="row">
                                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                        <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                                        <span>Location: </span>
                                                    </p>
                                                    <p class="col font-weight-semibold">
                                                        @if ( Auth::user()->fullAddress )
                                                            {{ Auth::user()->fullAddress }},
                                                        @else
                                                            --
                                                        @endif
                                                        @if ( Auth::user()->city_list )
                                                            {{ App\City::find(Auth::user()->city_list)->name }},
                                                        @else
                                                            ---
                                                        @endif
                                                        @if ( Auth::user()->country_list )
                                                            {{ App\Country::find(Auth::user()->country_list)->name }}
                                                        @else
                                                            ---
                                                        @endif
                                                    </p>
                                                </li>
                                            </ul>
                                            <div class="d-flex font-size-22 m-t-15">
                                                <a href="" class="text-gray p-r-20">
                                                    <i class="anticon anticon-facebook"></i>
                                                </a>
                                                <a href="" class="text-gray p-r-20">
                                                    <i class="anticon anticon-twitter"></i>
                                                </a>
                                                <a href="" class="text-gray p-r-20">
                                                    <i class="anticon anticon-behance"></i>
                                                </a>
                                                <a href="" class="text-gray p-r-20">
                                                    <i class="anticon anticon-dribbble"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        @if(session('profile_status'))
                            <div class="alert alert-success">
                                {{ session('profile_status') }}
                            </div>
                        @endif

                        <div class="card-header">
                            <h4 class="card-title">Account Infomation</h4>
                        </div>
                        <div class="card-body">
                            <div class="media align-items-center">
                                <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                    <img src="{{ asset('dashbord') }}/image/profile_photo/{{ Auth::user()->profile_photo }}" alt="{{ Auth::user()->profile_photo }}">
                                </div>
                                <div class="m-l-20 m-r-20">
                                    <h5 class="m-b-5 font-size-18">Change Avatar</h5>
                                    <p class="opacity-07 font-size-13 m-b-0">
                                        Recommended Dimensions: <br>
                                        120x120 Max fil size: 5MB
                                    </p>
                                </div>
                                <div>

                                    <form method="post" action="{{ route('profile.photo') }}" enctype="multipart/form-data">
                                    @csrf
                                        <input type="file" name="profile_photo">
                                        <button type="submit" class="btn btn-tone btn-primary">Upload</button>
                                    </form>

                                </div>
                            </div>
                            <hr class="m-v-25">

                            <form method="post" action="{{ route('profile.info') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="Name">Name:</label>
                                        <input type="text" class="form-control" name="name" id="Name" placeholder="Name" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="userName">User Name:</label>
                                        <input type="text" class="form-control" name="username" id="userName" placeholder="User Name" value="{{ Auth::user()->username }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="phoneNumber">Phone Number:</label>
                                        <input type="text" class="form-control" name="phone" id="phoneNumber" placeholder="Phone Number" value="{{ Auth::user()->phone }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="dob">Date of Birth:</label>
                                        <input type="date" class="form-control" name="dateOfBirth" id="dob" placeholder="Date of Birth" value="{{ Auth::user()->dateOfBirth }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="language">Gender</label>
                                        <select id="language" class="form-control" name="gender">
                                            <option {{ (Auth::user()->gender == 'Male') ? "selected":"" }} value="Male">Male</option>
                                            <option {{ (Auth::user()->gender == 'Female') ? "selected":"" }} value="Female">Female</option>
                                            <option {{ (Auth::user()->gender == 'Others') ? "selected":"" }} value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="font-weight-semibold" for="Profession">Profession</label>
                                        <input type="text" class="form-control" name="profession" id="Profession" placeholder="Profession" value="{{ Auth::user()->profession }}">
                                    </div>
                                    <div class="form-group col-md-1 pt-2">
                                        <button type="submit" class="btn btn-tone btn-primary mt-4">Update</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="oldPassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Old Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary m-t-30">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Address Details</h4>
                        </div>
                        <div class="card-body">

                            <form id="address_form">
                            @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-semibold" for="fullAddress">Address:</label>
                                        <input type="text" class="form-control" id="fullAddress" value="{{ Auth::user()->fullAddress }}" placeholder="Full Address">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="font-weight-semibold" for="country_list">Country</label>
                                        <select id="country_list" class="form-control">

                                            @if ( Auth::user()->country_list )
                                                <option value="Auth::user()->country_list">{{ App\Country::find(Auth::user()->country_list)->name }}</option>
                                            @else
                                                <option value="">Select your country</option>
                                            @endif

                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="font-weight-semibold" for="city_list">State &amp; City:</label>
                                        <select id="city_list" class="form-control">

                                            @if ( Auth::user()->city_list )
                                                <option value="Auth::user()->city_list">{{ App\City::find(Auth::user()->city_list)->name }}</option>
                                            @else
                                                <option value="">Select your City</option>
                                            @endif

                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 pt-2">
                                        <button type="submit" class="btn btn-tone btn-primary mt-4">Update</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Content Wrapper END -->
@endsection
@section('footer_scripts')
    <script>

        alertify.success('Buddy, Your in profile Page....');

        $(document).ready(function(){

            $('#country_list').change(function(){
                var country_id = $(this).val();

                //alert(country);

                //Ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //ajax response start
                $.ajax({
                    type : 'POST',
                    url : '/get/city/list/ajax/profile',
                    data : {country_id:country_id},
                    success : function(data){
                        $('#city_list').html(data);
                    }
                });
                //ajax response end
            });

        });
    </script>
    <script>
        //Address section form submit
        $("#address_form").submit(function(e){
            e.preventDefault();

            let fullAddress = $("#fullAddress").val();
            let country_list = $("#country_list").val();
            let city_list = $("#city_list").val();
            let _token = $("input[name=_token]").val();

            // alert(city_list);

            $.ajax({
                url:"{{ route('address.store') }}",
                type:"POST",
                data:{
                    fullAddress:fullAddress,
                    country_list:country_list,
                    city_list:city_list,
                    _token:_token
                },
                success:function(response){
                    if (response) {
                        alertify.set('notifier','position','top-right');
                        alertify.success('Address add successfully.');
                    }
                }
            });
        });
    </script>
@endsection
