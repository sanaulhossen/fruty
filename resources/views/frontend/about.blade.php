@extends('layouts.frontend_app')
@section('about')
  active
@endsection
@section('title')
  About | Fruty
@endsection

@section('frontend_content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>About Us</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="{{ asset('frontend') }}/img/about/about-us.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($abouts as $about)

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>{{ $about->question }}?</h4>
                        <p>{!! $about->answer !!}</p>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Testimonial Section Begin -->
<section class="karl-testimonials-area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Testimonials</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="karl-testimonials-slides owl-carousel">

                    @foreach ($testimonials as $testimonial)

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area text-center">
                            <span class="quote">"</span>
                            <h6>{{ $testimonial->comment }}</h6>
                            <div class="testimonial-info d-flex align-items-center justify-content-center">
                                <div class="tes-thumbnail">
                                    <img src="{{ asset('dashbord') }}/image/testimonial_image/{{ $testimonial->image }}" alt="">
                                </div>
                                <div class="testi-data">
                                    <p>{{ $testimonial->name }}</p>
                                    <span>{{ $testimonial->position }}</span>
                                </div>
                            </div>
                        </div>
                        <!--End Single Testimonial Area -->

                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>
<!-- Testimonial Section End -->

<!-- Counter Section Begin -->
<section class="counter spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">

                        @if ($review->our_clients)
                            <h2 class="cn_num">{{ $review->our_clients }}</h2>
                        @else
                            <h2 class="cn_num">0</h2>
                        @endif

                    </div>
                    <span>Our <br />Clients</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">

                        @if ($review->total_categories)
                            <h2 class="cn_num">{{ $review->total_categories }}</h2>
                        @else
                            <h2 class="cn_num">0</h2>
                        @endif

                    </div>
                    <span>Total <br />Categories</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">

                        @if ($review->in_country)
                            <h2 class="cn_num">{{ $review->in_country }}</h2>
                        @else
                            <h2 class="cn_num">0</h2>
                        @endif

                    </div>
                    <span>In <br />Country</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">

                         @if ($review->happy_customer)
                            <h2 class="cn_num">{{ $review->happy_customer }}</h2>
                        @else
                            <h2 class="cn_num">0</h2>
                        @endif

                        <strong>%</strong>
                    </div>
                    <span>Happy <br />Customer</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Section End -->

<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Team</span>
                    <h2>Meet Our Team</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($teams as $team)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('dashbord') }}/image/team_image/{{ $team->image }}" alt="">
                        <h4>{{ $team->name }}</h4>
                        <span>{{ $team->position }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Team Section End -->

<!-- Client Section Begin -->
<section class="clients spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Partner</span>
                    <h2>Happy Clients</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($clients as $client)

                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('dashbord') }}/image/client_image/{{ $client->file }}" alt=""></a>
                </div>

            @endforeach

        </div>
    </div>
</section>
<!-- Client Section End -->
@endsection
@section('footer_scripts')
    <script>
        alertify.success('Buddy, Your in about page....');
    </script>
@endsection
