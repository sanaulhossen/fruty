@extends('layouts.frontend_app')
@section('contact')
  active
@endsection
@section('title')
  Contact | Fruty
@endsection

@section('frontend_content')

<section class="breadcrumb-blog set-bg" data-setbg="http://127.0.0.1:8000/frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Contact</h2>
            </div>
        </div>
    </div>
</section>
<!-- Map Begin -->
<div class="map">
   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12361.634249727864!2d89.4995532597498!3d22.908359566416802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sbn!2sbd!4v1628614392477!5m2!1sbn!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Bangladesh</h4>
                            <p>KDA Khan Road, Daulatpur, Khulna <br />+880 152-141-1145</p>
                        </li>
                        <li>
                            <h4>France</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">

                     @if(session('config_message'))
                        <div class="alert alert-success">
                            {{ session('config_message') }}
                        </div>
                    @endif

                    <form action="{{ url('contact/message') }}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="contact_name" placeholder="Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="contact_email" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Message" name="contact_message"></textarea>
                                <button type="submit" class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection

@section('footer_scripts')
    <script>
        alertify.success('Buddy, Your in contact Page....');
    </script>
@endsection
