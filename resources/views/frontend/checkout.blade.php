@extends('layouts.frontend_app')
@section('checkout')
  active
@endsection
@section('title')
  Checkout | Fruty
@endsection

@section('frontend_content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{ url('checkout/post') }}" method="post">
            @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="checkout__input">
                            <p>Name<span>*</span></p>
                            <input type="text" placeholder="Enter Your Name" name="name" value="{{ $user->name }}" class="checkout__input__add">
                        </div>
                        @php
                            session(['name'  => $user->name]);
                        @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="number" placeholder="Enter your Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            @php
                                session(['email'  => $user->email]);
                            @endphp
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" name="address" class="checkout__input__add">
                            <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="address2">
                        </div>

                        <div class="checkout__input">
                            <h5 class="text-info">Note about your order, e.g, special note for delivery.......</h5>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes</p>
                            <textarea class="form-control" name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">

                                @foreach ($cart_data as $data)

                                    <li>0{{ $loop->index + 1 }}.
                                        {{ $data['item_name'] }} x {{ number_format($data['item_quantity']) }}
                                        <span>$ {{ number_format($data['item_price'], 2) * number_format($data['item_quantity']) }}</span>
                                    </li>

                                @endforeach

                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>${{ session('cart_sub_total') }}</span></li>
                                <li>Discount({{ session('coupon_name') }})<span>${{ session('discount') }}</span></li>
                                <li>Total <span>${{ session('total') }}</span></li>
                            </ul>
                            <ul class="payment-method">
                                <li>
                                    <input id="delivery" class="mr-2" name="payment_option" type="radio" value="1" checked>
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                                <li>
                                    <input id="card" class="mr-2" name="payment_option" type="radio" value="2">
                                    <label for="card">Credit Card</label>
                                </li>
                                <li>
                                    <input id="Commerz" class="mr-2" name="payment_option" type="radio" value="3">
                                    <label for="Commerz">SSL Commerz</label>
                                </li>
                                <li>
                                    <input id="paypal" class="mr-2" name="payment_option" type="radio" value="4">
                                    <label for="paypal">PayPal</label>
                                </li>

                            </ul>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection
@section('footer_scripts')
    <script>

        alertify.success('Buddy, Your in checkout Page....');

        $(document).ready(function(){

            $('#country_list_1').change(function(){
                var country_id = $(this).val();

                //Ajax setup

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //ajax response start
                $.ajax({
                    type : 'POST',
                    url : '/get/city/list/ajax',
                    data : {country_id:country_id},
                    success : function(data){
                        $('#city_list').html(data);
                    }
                });
                //ajax response end
            });
        });
    </script>
@endsection


