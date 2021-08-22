<section class="hero">
    <div class="hero__slider owl-carousel">

        @foreach($sliders as $slider)
            <div class="hero__items set-bg" data-setbg="{{ asset('dashbord/image/slider_image') }}/{{ $slider->slider_photo }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>{{ $slider->slider_sub_title }}</h6>
                                <h2>{{ $slider->slider_title }}</h2>
                                <p>{{ $slider->slider_description }}</p>
                                <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    </section>
