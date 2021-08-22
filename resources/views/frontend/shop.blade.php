@extends('layouts.frontend_app')
@section('shop')
  active
@endsection
@section('title')
  Shop | Fruty
@endsection

@section('frontend_content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">

                                                @foreach ($categories as $category)
                                                    <li><a href="#">{{ $category->category_name }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <label for="xs">xs
                                                <input type="radio" id="xs">
                                            </label>
                                            <label for="sm">s
                                                <input type="radio" id="sm">
                                            </label>
                                            <label for="md">m
                                                <input type="radio" id="md">
                                            </label>
                                            <label for="xl">xl
                                                <input type="radio" id="xl">
                                            </label>
                                            <label for="2xl">xl
                                                <input type="radio" id="2xl">
                                            </label>
                                            <label for="xxl">xxl
                                                <input type="radio" id="xxl">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <label class="c-1" for="sp-1">
                                                <input type="radio" id="sp-1">
                                            </label>
                                            <label class="c-2" for="sp-2">
                                                <input type="radio" id="sp-2">
                                            </label>
                                            <label class="c-3" for="sp-3">
                                                <input type="radio" id="sp-3">
                                            </label>
                                            <label class="c-4" for="sp-4">
                                                <input type="radio" id="sp-4">
                                            </label>
                                            <label class="c-5" for="sp-5">
                                                <input type="radio" id="sp-5">
                                            </label>
                                            <label class="c-6" for="sp-6">
                                                <input type="radio" id="sp-6">
                                            </label>
                                            <label class="c-7" for="sp-7">
                                                <input type="radio" id="sp-7">
                                            </label>
                                            <label class="c-8" for="sp-8">
                                                <input type="radio" id="sp-8">
                                            </label>
                                            <label class="c-9" for="sp-9">
                                                <input type="radio" id="sp-9">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">

                                            @foreach ($tags as $tag)
                                                <a href="#">{{ $tag->tag_name }}</a>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">

                                <div class="product__item__pic set-bg" data-setbg="{{ asset('dashbord/image/product_image') }}/{{ $product->product_thumbnail_photo }}">

                                    <span class="label">{{ $product->relationwithtype->product_type_name  }}</span>
                                    <ul class="product__hover">
                                        <input type="hidden" class="product_id" value="{{ $product->id }}">
                                        <li>
                                            <a href="#" class="add-to-wish-btn"><img src="{{ asset('frontend') }}/img/icon/heart.png" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('product/details') }}/{{  $product->slug }}"><img src="{{ asset('frontend') }}/img/icon/view.png" alt=""> <span>View</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ $product->id }}" id="data-model" data-toggle="modal" data-target="#quickview"><img src="{{ asset('frontend') }}/img/icon/search.png" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text product_data">
                                    <h6>{{ $product->product_name }}</h6>
                                    <input type="hidden" class="quantity" value="1">
                                    <input type="hidden" class="product_id" value="{{ $product->id }}">
                                    <a href="" class="add-cart add-to-cart-btn">+ Add Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{ $product->product_price }}</h5>
                                    <div class="product__color__select">
                                        <p class="text-danger"><b>{{ $product->product_name }}</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

@endsection


@section('footer_scripts')
    <script>

        alertify.success('Buddy, Your in shop Page....');

        $(document).ready(function(){
            $('.product__item__pic  #data-model').click(function(){
                event.preventDefault();
                var pupup = $(this).attr('href');


                //Ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //ajax response start
                $.ajax({
                    type : 'POST',
                    url : '/post/product/details',
                    data : { pupup:pupup },
                    success : function (data){

                        $('#quick_name').html(data);

                    }
                });
                //ajax response end

                //ajax response start 2nd
                $.ajax({
                    type : 'POST',
                    url : '/post/product/details/2nd',
                    data : { pupup:pupup },
                    success : function (data){

                        $('#quick_price').html(data);

                    }
                });
                //ajax response 2nd end

                //ajax response start 3rd
                $.ajax({
                    type : 'POST',
                    url : '/post/product/details/3rd',
                    data : { pupup:pupup },
                    success : function (data){

                        $('#quick_desc').html(data);

                    }
                });
                //ajax response 2nd end

                //ajax response start 3rd
                $.ajax({
                    type : 'POST',
                    url : '/post/product/details/4th',
                    data : { pupup:pupup },
                    success : function (data){

                        $('#quick_image').html(data);

                    }
                });
                //ajax response 3nd end

            });
        });

    </script>
@endsection

