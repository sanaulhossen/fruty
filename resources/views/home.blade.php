@extends('layouts.dashbord_app')

@section('home')
  active
@endsection
@section('title')
  Home | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="card p-3">
                <div class="card-body p-4">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <img src="{{ asset('dashbord') }}/image/profile_photo/{{ Auth::user()->profile_photo }}" alt="{{ Auth::user()->profile_photo }}">
                        </div>
                        <div class="m-l-15">
                            <h4 class="m-b-0">Welcome back, <strong>{{ Auth::user()->name }}</strong></h4>
                            <span class="text-gray"><strong>{{ Auth::user()->profession }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">OUR ADMIN</h5>
                        <div>
                            <a href="{{ route('all.admin') }}" class="btn btn-tone btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="m-t-30">
                        <div class="avatar-string m-l-5">

                            @foreach ($admins as $admin)
                                <a href="javascript:void(0);" data-toggle="tooltip" title="" data-original-title="{{ $admin->name }}">
                                    <div class="avatar avatar-image team-member">
                                        <img src="{{ asset('dashbord') }}/image/profile_photo/{{ $admin->profile_photo }}" alt="{{ $admin->profile_photo }}">
                                    </div>
                                </a>
                            @endforeach

                            <a href="javascript:void(0);" data-toggle="tooltip" title="" data-original-title="Add Member">
                                <div class="avatar avatar-icon avatar-blue team-member">
                                    <i class="anticon anticon-plus font-size-22"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="anticon anticon-dollar"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">${{ total_sell() }}</h2>
                            <p class="m-b-0 text-muted">Sell</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-cyan">
                            <i class="anticon anticon-dollar"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">${{ total_profit() }}</h2>
                            <p class="m-b-0 text-muted">Profit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-gold">
                            <i class="anticon anticon-profile"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ total_product_count() }}</h2>
                            <p class="m-b-0 text-muted">Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-purple">
                            <i class="anticon anticon-user"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ total_customer() }}</h2>
                            <p class="m-b-0 text-muted">Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{--HOME & ORDER SECTION AND TOTAL ORDER --}}

    {{--HOME & ORDER SECTION AND TOTAL ORDER --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="mt-3 text-center">Product Order List</h4>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table" id="category_table">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Order At</th>
                                        <th>Coupon</th>
                                        <th>Pay By</th>
                                        <th>Status</th>
                                        <th>Delivery</th>
                                        <th>Sub-Total</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $order->coupon_name }}</td>
                                            <td>
                                                @if ($order->payment_option == 1)
                                                    COD
                                                @elseif ($order->payment_option == 2)
                                                    Card
                                                @elseif ($order->payment_option == 3)
                                                    SSL
                                                @elseif ($order->payment_option == 4)
                                                    PayPal
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->payment_status == 1)
                                                    <span class="badge badge-pill badge-gold">Unpaid</span>
                                                @elseif(($order->payment_status == 3))
                                                    <span class="badge badge-pill badge-red">Cancel</span>
                                                @else
                                                    <span class="badge badge-pill badge-cyan">Paid</span>
                                                @endif
                                            </td>

                                            <td>

                                                @if( $order->payment_status == 2 )
                                                    @if($order->delivery_status == 1)
                                                        <span class="badge badge-pill badge-gold">Pending</span>
                                                    @elseif(($order->delivery_status == 2))
                                                        <span class="badge badge-pill badge-red">Cancel</span>
                                                    @elseif(($order->delivery_status == 3))
                                                        <span class="badge badge-pill badge-blue">Picked</span>
                                                    @elseif(($order->delivery_status == 4))
                                                        <span class="badge badge-pill badge-cyan">Shipping</span>
                                                    @else
                                                        <span class="badge badge-pill badge-blue">Delivered</span>
                                                    @endif
                                                @endif

                                            </td>

                                            <td>{{ $order->sub_total }}</td>
                                            <td>{{ $order->discount_amount }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>
                                                <div class="dropdown dropdown-animated scale-left">
                                                        <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="anticon anticon-ellipsis"></i>
                                                        </a>
                                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-152px, -83px, 0px);">

                                                        @if( $order->payment_status == 1 )
                                                            <a href="{{ route('order.update',$order->id) }}" class="dropdown-item">
                                                                <i class="fab fa-amazon-pay"></i>
                                                                <span class="m-l-10">Pay</span>
                                                            </a>
                                                        @endif

                                                        @if( $order->payment_status == 1 )
                                                            <a href="{{ route('order.cancel',$order->id) }}" class="dropdown-item">
                                                                <i class="anticon anticon-close"></i>
                                                                <span class="m-l-10">Cancel</span>
                                                            </a>
                                                        @endif

                                                        @if( $order->payment_status == 2 )
                                                            <a href="{{ route('order.edit',$order->id) }}" class="dropdown-item">
                                                                <i class="anticon anticon-plus-circle"></i>
                                                                <span class="m-l-10">Status</span>
                                                            </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data Availabke</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- ########## End: MAIN PANEL ########## -->
@endsection

@section('footer_scripts')
    <script>

        @if(session('payment_update'))
            alertify.set('notifier','position','top-right');
            alertify.success('Payment Status Updated Successfully.');
        @endif
        @if(session('order_delete'))
            alertify.set('notifier','position','top-right');
            alertify.success('Order deleted successfully!');
        @endif
        @if(session('demo_admin'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Sorry! You can not do this action.');
        @endif

    </script>
@endsection
