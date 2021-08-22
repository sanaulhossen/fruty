<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Let's See Our</span>
                    <h2>Latest Product</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($products as $product)

                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('dashbord/image/product_image') }}/{{ $product->product_thumbnail_photo }}">
                            <ul class="product__hover">
                                <input type="hidden" class="product_id" value="{{ $product->id }}">
                                <li>
                                    <a href="#" class="add-to-wish-btn"><img src="{{ asset('frontend') }}/img/icon/heart.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="{{ url('product/details') }}/{{  $product->slug }}">
                                        <img src="{{ asset('frontend') }}/img/icon/view.png" alt=""> <span>View</span>
                                    </a>
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
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
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
</section>
@section('footer_scripts')
    <script>

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
                //ajax response 2nd end

            });
        });

    </script>
@endsection
