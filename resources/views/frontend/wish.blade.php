@extends('layouts.frontend_app')

@section('title')
  Wish | Fruty
@endsection

@section('frontend_content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Wish</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="{{ url('shop') }}">Shop</a>
                            <span>Shopping Wish</span>
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

                @if(isset($wish_data))
                    @if(Cookie::get('shopping_wish'))

                        <div class="col-lg-12">
                            <div class="shopping__cart__table">
                                <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Add To Cart</th>
                                            <th>remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wish_data as $data)

                                            <tr class="wishTableRaw">
                                                <td class="product__wish__item">
                                                    <div class="product__wish__item__pic">
                                                        <img src="{{ asset('dashbord/image/product_image/'.$data['item_image']) }}" alt="">
                                                    </div>
                                                </td>
                                                <td class="name__item">
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $data['item_name'] }}</h6>
                                                    </div>
                                                </td>
                                                <td class="wish__price">${{ number_format($data['item_price'], 2) }}</td>
                                                <td class="wish__add product_data">
                                                    <input type="hidden" class="product_id" value="{{ $data['item_id'] }}">
                                                    <input type="hidden" class="quantity" value="1">
                                                    <a href="" class="add-to-cart-btn-from-wish btn btn-primary">+ Add to cart</a>
                                                </td>

                                                <td class="wish__close">
                                                    <button class="btn btn-white delete_wish_data"><i class="fa fa-close"></i></button>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="continue__btn">
                                        <a href="{{ url('shop') }}">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @else
                    <div class="col-lg-12">
                        <h4 class="text-danger text-center">Wish list is empty</h4>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
