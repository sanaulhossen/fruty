@extends('layouts.frontend_app')
@section('shop')
  active
@endsection
@section('title')
  Shop | Fruty
@endsection

@section('frontend_content')
<!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="{{ url('shop') }}">Shop</a>
                            <span>{{ $product_info->product_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-0" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('dashbord/image/product_image') }}/{{ $product_info->product_thumbnail_photo }}">
                                    </div>
                                </a>
                            </li>

                            @foreach ($product_info->relationwithproduct_images as $single_photo)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{ $single_photo->id }}" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{ asset('dashbord/image/product_multiple_image') }}/{{ $single_photo->product_multiple_photo }}">
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">

                            <div class="tab-pane active" id="tabs-0" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset('dashbord/image/product_image') }}/{{ $product_info->product_thumbnail_photo }}" alt="">
                                </div>
                            </div>

                            @foreach ($product_info->relationwithproduct_images as $single_photo)
                                <div class="tab-pane" id="tabs-{{ $single_photo->id }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ asset('dashbord/image/product_multiple_image') }}/{{ $single_photo->product_multiple_photo }}" alt="">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product_info->product_name }}</h4>
                            <div class="rating">


                                @for ($i = 1; $i <= average_stars_count($product_info->id); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor

                                @if(average_stars_count($product_info->id) == 0)
                                    <span> - 0 Reviews</span>
                                @endif

                                <span>({{ review_customer_count($product_info->id) }} Review)</span>



                            </div>
                            <h3>${{ $product_info->product_price }}</h3>
                            <p>{{ $product_info->product_short_description }}</p>



                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="product_quantity">
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{ $product_info->id }}" name="product_id">
                                    <a href="" class="add-to-cart-btn add-to-cart-details primary-btn">+ Add Cart</a>
                                </div>


                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('frontend') }}/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> {{ $product_info->product_SKU }}</li>
                                    <li><span>Categories:</span> {{ $product_info->relationwithcategory->category_name }}</li>
                                    <li><span>Tag:</span> {{ $product_info->relationwithTag->tag_name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p>{{ $product_info->product_long_description }}</p>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">

                                        <div class="review-wrap">
                                            <ul>

                                                @foreach ($reviews as $review)

                                                    <li class="review-items">
                                                        <div class="review-img">
                                                            <img src="{{ asset('dashbord/image/profile_photo') }}/{{ $review->relation_with_user->profile_photo }}" alt="">
                                                        </div>
                                                        <div class="review-content">
                                                            <h3><a href="#">{{ $review->relation_with_user->name }}</a></h3>
                                                            <span>{{ $review->updated_at->format('d M, Y') }} at {{ $review->updated_at->format('h:sA') }}</span>
                                                            <p>{{ $review->review }}</p>
                                                            <div class="rating">

                                                                @php
                                                                    $star = (($review->price_stars + $review->value_stars + $review->quality_stars)/3);
                                                                @endphp

                                                                @for ($i = 0; $i < $star; $i++)
                                                                    <i class="fa fa-star"></i>
                                                                @endfor

                                                            </div>
                                                        </div>
                                                    </li>

                                                @endforeach

                                            </ul>
                                        </div>

                                        @auth
                                            @if( $show_review_form == 1 )
                                                <div class="add-review">
                                                    <h4>Add A Review</h4>

                                                    <form action="{{ url('review/form') }}" method="post">
                                                        @csrf

                                                        <div class="ratting-wrap">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>task</th>
                                                                        <th>1 Star</th>
                                                                        <th>2 Star</th>
                                                                        <th>3 Star</th>
                                                                        <th>4 Star</th>
                                                                        <th>5 Star</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Price</td>
                                                                        <td>
                                                                            <input type="radio" name="price_stars" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price_stars" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price_stars" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price_stars" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price_stars" value="5">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Value</td>
                                                                        <td>
                                                                            <input type="radio" name="value_stars" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value_stars" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value_stars" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value_stars" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value_stars" value="5">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Quality</td>
                                                                        <td>
                                                                            <input type="radio" name="quality_stars" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality_stars" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality_stars" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality_stars" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality_stars" value="5">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <h4>Name:</h4>
                                                                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Your name here...">
                                                                <input type="hidden" name="order_details_id" value="{{ $order_details_id }}">
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <h4>Email:</h4>
                                                                <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Your Email here...">
                                                            </div>
                                                            <div class="col-12">
                                                                <h4>Your Review:</h4>
                                                                <textarea name="review" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit" class="btn-style">Submit</button>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            @elseif ( $show_review_form == 2 )
                                                <div class="add-review">
                                                    <h4 class="text-center">You have to buy first to give your valueable review!</h4>
                                                </div>
                                            @else
                                                <div class="add-review">
                                                    <h4 class="text-center">You have to buy first to give your valueable review!</h4>
                                                </div>
                                            @endif
                                        @endauth
                                        @guest
                                            <div class="add-review">
                                                <h4 class="text-center">Please, <a href="{{ url('login') }}"><b>Login</b></a> first to give your valueable review!</h4>
                                            </div>
                                        @endguest

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    @include('frontend.includes.relatedProduct')
    <!-- Related Section End -->


@endsection
@section('footer_scripts')
    <script>

        @if(session('review_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Thanks for your review');
		@endif

    </script>
@endsection
