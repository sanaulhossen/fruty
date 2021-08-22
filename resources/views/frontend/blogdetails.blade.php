@extends('layouts.frontend_app')
@section('blog')
  active
@endsection
@section('title')
  Blog Details | Fruty
@endsection

@section('frontend_content')
<!-- Blog Details Hero Begin -->
<section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">
                    <h2>{{ $blog_info->blog_title }}</h2>
                    <ul>
                        <li>By {{ $blog_info->relation_with_user->name }}</li>
                        <li>{{ $blog_info->created_at->format('d M Y') }}</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="{{ asset('dashbord/image/blog_image') }}/{{ $blog_info->blog_thumbnail_photo }}" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog__details__text">
                        <p>{!! $blog_info->blog_description !!}</p>
                    <div class="blog__details__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ asset('dashbord') }}/image/profile_photo/{{ $blog_info->relation_with_user->profile_photo }}"  alt="{{  $blog_info->relation_with_user->profile_photo }}">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h5>{{ $blog_info->relation_with_user->name }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__tags">

                                    @foreach ($blog_cates as $blog_caty)
                                        <a href="#">#{{ $blog_caty->title }}</a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__btns">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="{{ url('blog/next/details') }}/{{ $blog_info->id-1 }}" class="blog__details__btns__item">
                                    <p><span class="arrow_left"></span> Previous Post</p>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="{{ url('blog/next/details') }}/{{ $blog_info->id+1 }}" class="blog__details__btns__item blog__details__btns__item--next">
                                    <p>Next Post <span class="arrow_right"></span></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane blog__details__btns" id="project-details-comments">
                        <hr><h4 class="text-center">Comments</h4><hr>
                        <ul class="comment_list list-group list-group-flush">



                        </ul>
                    </div>
                    <div class="blog__details__comment">
                        <h4>Leave A Comment</h4>

                        <form id="addCommentForm" method="post">

                            <ul class="alert alert-warning d-none" id="save_error_list"></ul>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                </div>
                                <div class="col-lg-12 text-center">
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your comment"></textarea>
                                    <button type="submit" class="site-btn">Post Comment</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){

            //Ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //COMMENT FORM DATA STORE
            $(document).on('submit','#addCommentForm', function(e){
                e.preventDefault();

                let formData = new FormData($('#addCommentForm')[0]);


                $.ajax({
                    url: "/comment-store",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 400) {
                            $('#save_error_list').html("");
                            $('#save_error_list').removeClass('d-none');
                            $.each(response.errors, function (key, err_value){
                                $('#save_error_list').append('<li>'+err_value+'</li>');
                            });
                        }else if(response.status == 200){
                            $('#save_error_list').html("");
                            $('#save_error_list').addClass('d-none');
                            $('#addCommentForm').find('input').val('');
                            $('#addCommentForm').find('#comment').val('');

                            CommentData();

                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);
                        }
                    }
                });
            });

            CommentData();

            //COMMENT FORM DATA
            function CommentData(){
                $.ajax({
                    url: "/comment-data",
                    method: "GET",
                    dataType: "json",
                    success: function (response){

                        $.each(response.comment, function (key, item){
                            $('.comment_list').append('<li class="list-group-item p-h-0">\
                                <div class="media">\
                                    <div class="media-body m-l-20">\
                                        <h4>'+item.name+'</h4>\
                                    </div>\
                                </div>\
                                <p class="text-muted h6"><em>'+item.comment+'</em></p>\
                            </li>');
                        });
                    }
                });
            }

        });
    </script>
@endsection
