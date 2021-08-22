<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Let's See Our Latest</span>
                    <h2>Category</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <a href="{{ url('category/details') }}/{{ $category->category_name }}">
                            <div class="blog__item__pic set-bg" data-setbg="{{ asset('dashbord/image/category_image') }}/{{ $category->category_photo }}"></div>
                        </a>
                        <div class="blog__item__text">
                            <h5>{{ $category->category_name }}</h5>
                            <a href="{{ url('category/details') }}/{{ $category->category_name }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
