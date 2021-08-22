@extends('layouts.frontend_app')
@section('blog')
  active
@endsection
@section('title')
  Blog | Fruty
@endsection

@section('frontend_content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset('frontend') }}/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Blog</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">

            @foreach ($blogs as $blog)

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('dashbord') }}/image/profile_photo/{{  App\User::find($blog->user_id)->profile_photo }}"></div>
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
<!-- Blog Section End -->
@endsection
@section('footer_scripts')
    <script>
        alertify.success('Buddy, Your in a blog page....');
    </script>
@endsection
