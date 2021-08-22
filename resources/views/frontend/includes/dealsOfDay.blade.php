<section class="categories spad">
    <div class="container">

        @foreach ($deals as $deal)
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2> <br/><span>{{ $deal->relationwithcategory->category_name }}</span> </h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="{{ asset('dashbord/image/product_image') }}/{{ $deal->product_thumbnail_photo }}" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>${{ $deal->dealsOfDay }}</h5>
                            <h6><del>${{ $deal->product_price }}</del></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>{{ $deal->product_name }}</h2>
                        <div class="categories__deal__countdown__timer">
                            <h6>
                                <p>{{ $deal->product_short_description }}</p>
                            </h6>
                        </div>
                        <a href="{{ url('product/details') }}/{{  $deal->slug }}" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>
