@extends('layouts.frontend_app')
@section('home')
  active
@endsection
@section('title')
  Home | Fruty
@endsection

@section('frontend_content')

    <!-- Hero Section Begin -->
    @include('frontend.includes.slider')
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    @include('frontend.includes.banner')
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    @include('frontend.includes.latest')
    <!-- Product Section End -->

    <!-- Product Section Begin -->
    @include('frontend.includes.topSell')
    <!-- Product Section End -->

    <!-- Deals Of The Day Section Begin -->
    @include('frontend.includes.dealsOfDay')
    <!-- Deals Of The Day Section End -->

    <!-- Instagram Section Begin -->
    @include('frontend.includes.instagram')
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    @include('frontend.includes.latestBlog')
    <!-- Latest Blog Section End -->


@endsection
@section('footer_scripts')
    <script>
        alertify.success('Hello, Welcome To Frutika....');
    </script>
@endsection
