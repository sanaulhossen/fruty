<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($blogs as $blog)

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('dashbord') }}/image/profile_photo/{{ $blog->relation_with_user->profile_photo }}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset('frontend') }}/img/icon/calendar.png" alt=""> {{ $blog->created_at->format('d M Y') }} </span>
                            <h5>{{ Str::limit($blog->blog_title, $limit = 16, $end = '....') }}</h5>
                            <a href="{{ url('blog/details') }}/{{ $blog->slug }}">Read More</a>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</section>
