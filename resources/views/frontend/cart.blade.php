@extends('layouts.frontend_app')
@section('cart')
  active
@endsection
@section('title')
  Cart | Fruty
@endsection

@section('frontend_content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('shop') }}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">

            @if(isset($cart_data))
                @if(Cookie::get('shopping_cart'))

                    <div class="col-lg-8">
                        <div class="shopping__cart__table">

                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th class="total">Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @php
                                        $cart_sub_total = 0;
                                    @endphp

                                    @forelse ($cart_data as $data)

                                        <tr class="cartpage">
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ asset('dashbord/image/product_image/'.$data['item_image']) }}" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $data['item_name'] }}</h6>
                                                    <h5>${{ number_format($data['item_price'], 2) }}</h5>
                                                </div>
                                            </td>
                                            <td class="cart-product-quantity" width="110px">
                                                <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >
                                                <div class="input-group quantity">
                                                    <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                                                        <span class="input-group-text">-</span>
                                                    </div>
                                                    <input type="text" class="qty-input form-control" maxlength="2" max="100" value="{{ number_format($data['item_quantity']) }}">
                                                    <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                                                        <span class="input-group-text">+</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price pl-3"> ${{ number_format($data['item_price'], 2) * number_format($data['item_quantity']) }}</td>
                                            <td class="cart__close">
                                                <button class="btn btn-white btn-sm delete_cart_data"><i class="fa fa-close"></i></button>
                                            </td>
                                        </tr>

                                        @php
                                            $cart_sub_total = $cart_sub_total + ( number_format($data['item_quantity']) * number_format($data['item_price'], 2) );
                                        @endphp

                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data Availabke</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{ url('shop') }}">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cart__total__id" class="col-lg-4">
                        <div class="cart_total_all">
                            <div class="cart__discount">
                                <h6>Discount codes</h6>
                                <input type="text" class="coupon_code" placeholder="Enter Cupon Code" value="{{ $coupon_name }}">
                                <button type="button" class="coupon_btn">Apply</button>
                            </div>
                            <div class="cart__total">
                                <h6>Cart totals</h6>
                                <ul>
                                    <li>Subtotal <span>$ {{ $cart_sub_total }}</span></li><hr>
                                        @php
                                            session(['cart_sub_total'  => $cart_sub_total]);
                                        @endphp
                                    <li>Discount({{ $coupon_name }}) <span>${{ ($cart_sub_total * $discount_amount)/100 }}</span></li><hr>
                                        @php
                                            session(['coupon_name'  => (($coupon_name) ? $coupon_name:'-') ]);
                                        @endphp
                                        @php
                                            session(['discount_amount'  => $discount_amount]);
                                        @endphp
                                        @php
                                            session(['discount'  => ($cart_sub_total * $discount_amount)/100]);
                                        @endphp
                                    <li>Total <span>$ {{ $cart_sub_total - (($cart_sub_total * $discount_amount)/100) }}</span></li><hr>
                                        @php
                                            session(['total'  => ($cart_sub_total - (($cart_sub_total * $discount_amount)/100))]);
                                        @endphp
                                </ul>
                                <a href="{{ url('checkout') }}" class="primary-btn">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>

                @endif
            @else
                <div class="col-lg-12">
                    <h4 class="text-danger text-center">Cart list is empty</h4>
                </div>
            @endif

        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection
@section('footer_scripts')
    <script>

        $(document).ready(function(){
            $('.coupon_btn').click(function(){
                var coupon_code = $('.coupon_code').val();
                var link_to_go = "{{ url('/cart') }}/"+coupon_code;
                window.location.href = link_to_go;
            });
        });

    </script>
@endsection

