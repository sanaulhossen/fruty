@extends('layouts.frontend_app')

@section('title')
  Customer | Fruty
@endsection

@section('frontend_content')

<section class="breadcrumb-blog set-bg" data-setbg="http://127.0.0.1:8000/frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Account</h2>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-page pt-5 pb-5">
  <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="dashboard_menu bg-dark text-white">
                    <ul class="nav nav-tabs border-0 flex-column" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">
                                My Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true">
                                Account details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
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
                </div>
            </div>
            <div class="col-lg-9 col-md-8 mt-5 mt-lg-0 mt-md-0">
                <div class="tab-content dashboard_content">
                  	<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-md-flex align-items-center">
                                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                                <h2 class="m-b-5">{{ Auth::user()->name }}</h2>
                                                <p class="text-opacity font-size-13">{{ Auth::user()->username }}</p>
                                                <p class="text-dark m-b-20">{{ Auth::user()->profession }}</p>
                                                <a href="tel:{{ Auth::user()->phone }}" class="btn btn-primary btn-tone">Contact</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="d-md-block d-none border-left col-1"></div>
                                            <div class="col">
                                                <ul class="list-unstyled m-t-10">
                                                    <li class="row">
                                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                            <span>Email: </span>
                                                        </p>
                                                        <p class="col font-weight-semibold">{{ Auth::user()->email }}</p>
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
                  	</div>
                  	<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    	<div class="card">
                            <div class="card-body">
                    			<div class="table-responsive">
                                    <table class="table table ">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Invoice</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>#{{ $order->id }}</td>
                                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        @if( $order->payment_status == 2 )
                                                            @if($order->delivery_status == 1)
                                                                <span>Pending</span>
                                                            @elseif(($order->delivery_status == 2))
                                                                <span>Cancel</span>
                                                            @elseif(($order->delivery_status == 3))
                                                                <span>Picked</span>
                                                            @elseif(($order->delivery_status == 4))
                                                                <span>Shipping</span>
                                                            @else
                                                                <span>Delivered</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a href="{{ route('order.invoice',$order->id) }}" class="btn btn-info btn-sm">
                                                            Download
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('view.order',$order->id) }}" class="btn btn-success btn-sm">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                  	</div>
                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                        <div class="card">
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

                                <form id="info_form">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="Name">Name:</label>
                                            <input type="text" class="form-control" name="name" id="Name" placeholder="Name" value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="username">User Name:</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="{{ Auth::user()->username }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="phone">Phone Number:</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="language">Gender</label>
                                            <select id="gender" class="form-control" name="gender">
                                                <option {{ (Auth::user()->gender == 'Male') ? "selected":"" }} value="Male">Male</option>
                                                <option {{ (Auth::user()->gender == 'Female') ? "selected":"" }} value="Female">Female</option>
                                                <option {{ (Auth::user()->gender == 'Others') ? "selected":"" }} value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-semibold" for="Profession">Profession</label>
                                            <input type="text" class="form-control" name="profession" id="profession" placeholder="Profession" value="{{ Auth::user()->profession }}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="submit" class="btn btn-tone btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">

                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>

                                <form method="post" action="{{ route('change.password') }}">
                                @csrf
                                    <div class="form-row ml-3">
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold" for="old_password">Old Password:</label>
                                            <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold" for="password">New Password:</label>
                                            <input type="password" class="form-control" name="password" placeholder="New Password">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold" for="password_confirmation">Confirm Password:</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group col-md-3 mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary m-t-30">Change Password</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="card-title">Address Details</h4>
                            </div>
                            <div class="card-body">

                                <form id="address_form">
                                @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-semibold" for="fullAddress">Address:</label>
                                            <textarea class="form-control" id="fullAddress"  rows="5" placeholder="Full Address">{{ Auth::user()->fullAddress }}</textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-tone btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('footer_scripts')
    <script>


        @if(session('password_old'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Old password and New password is same!!');
		@endif

        @if(session('password_error'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Your old password does not match!!');
		@endif

        @if(session('password_change'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Password changed successfully.');
		@endif

    </script>
    <script>
        //Address section form submit
        $("#info_form").submit(function(e){
            e.preventDefault();

            let username = $("#username").val();
            let phone = $("#phone").val();
            let gender = $("#gender").val();
            let profession = $("#profession").val();
            let _token = $("input[name=_token]").val();

            //alert(username);

            $.ajax({
                url:"{{ route('info.customer') }}",
                type:"POST",
                data:{
                    username:username,
                    phone:phone,
                    gender:gender,
                    profession:profession,
                    _token:_token
                },
                success:function(response){
                    if (response) {
                        alertify.set('notifier','position','top-right');
                        alertify.success('Info add successfully.');
                    }
                }
            });
        });
    </script>
    <script>
        //Address section form submit
        $("#address_form").submit(function(e){
            e.preventDefault();

            let fullAddress = $("#fullAddress").val();
            let _token = $("input[name=_token]").val();

            // alert(fullAddress);

            $.ajax({
                url:"{{ route('address.profile') }}",
                type:"POST",
                data:{
                    fullAddress:fullAddress,
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
