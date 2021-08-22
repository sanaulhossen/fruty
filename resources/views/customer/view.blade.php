@extends('layouts.frontend_app')

@section('title')
  Customer | Fruty
@endsection

@section('frontend_content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Order Details</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('shop') }}">Shop</a>
                        <span>Your details order here</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="card bg-light mt-5 mb-5">
        <div class="card-body pb-5 pr-5 pl-5">
            <div id="invoice" class="p-h-30">
                <div class="m-t-15 lh-2">
                    <div class="inline-block">
                        <div class="header__logo">
                            <a href="{{ url('/') }}"> <h5> <strong>F</strong> r u t y</h5> </a>
                        </div>
                        <address class="p-l-10">
                            <span class="font-weight-semibold text-dark">F r u t y, Inc.</span><br>
                            <span>9498 KDA Street</span><br>
                            <span>Fairfield, Chicago Town 06824</span><br>
                            <abbr class="text-dark" title="Phone">Phone:</abbr>
                            <span>(+880) 152-141-1145</span>
                        </address>
                    </div>
                </div>
                <div class="row m-t-20 lh-2">
                    <div class="col-sm-9">
                        <h3 class="p-l-10 m-t-10">Invoice To:</h3>
                        <address class="p-l-10 m-t-10">
                            <span class="font-weight-semibold text-dark">{{ App\Billing::find($order_info->billing_id)->name }}</span><br>
                            <span>{{ App\Billing::find($order_info->billing_id)->email }}</span><br>
                            <span>{{ App\Billing::find($order_info->billing_id)->address }},</span><br>
                            <span>{{ App\Billing::find($order_info->billing_id)->address2 }}</span>
                        </address>
                    </div>
                    <div class="col-sm-3">
                        <div class="m-t-80">
                            <div class="text-dark text-uppercase d-inline-block">
                                <span class="font-weight-semibold text-dark">Invoice No :</span></div>
                            <div class="float-right">#{{ $order_info->id }}</div>
                        </div>
                        <div class="text-dark text-uppercase d-inline-block">
                            <span class="font-weight-semibold text-dark">Date :</span>
                        </div>
                        <div class="float-right">{{ $order_info->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="m-t-20">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Items</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                     <tr>
                                        <th>{{ $loop->index + 1 }}</th>
                                        <th>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/product_image') }}/{{ $order->product->product_thumbnail_photo }}" alt="{{ $order->product->product_thumbnail_photo }}">
                                            </div>
                                        </th>
                                        <td>{{ $order->product->product_name  }}</td>
                                        <td>{{ $order->product_quantity }}</td>
                                        <td>${{ $order->product_price }}</td>
                                        <td>${{ $order->product_quantity * $order->product_price }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row m-t-30 lh-1-8">
                        <div class="col-sm-12">
                            <div class="float-right text-right">
                                <p>Sub - Total amount: ${{ $order_info->sub_total }}</p>
                                <p>Discount (coupon: {{ $order_info->coupon_name }}) : ${{ $order_info->discount_amount }} </p>
                                <hr>
                                <h3><span class="font-weight-semibold text-dark">Total :</span> ${{ $order_info->total }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-30 lh-2">
                        <div class="col-sm-12">
                            <div class="border-bottom p-v-20">
                                <p class="text-opacity"><small>In exceptional circumstances, Financial Services can provide an urgent manually processed special cheque. Note, however, that urgent special cheques should be requested only on an emergency basis as manually produced cheques involve duplication of effort and considerable staff resources. Requests need to be supported by a letter explaining the circumstances to justify the special cheque payment.</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="row m-v-20">
                        <div class="col-sm-6">
                            <div class="header__logo">
                                <a href="{{ url('/') }}"> <h5> <strong>F</strong> r u t y</h5> </a>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right mt-4">
                            <small><span class="font-weight-semibold text-dark">Phone:</span> <span>(+880) 152-141-1145</span></small>
                            <br>
                            <small>fruty@hingtu.xyz</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
