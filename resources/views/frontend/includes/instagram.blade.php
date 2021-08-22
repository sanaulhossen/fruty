<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">

                    @foreach ($insts as $inst)
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('dashbord/image/instagram_image') }}/{{ $inst->instagram_img }}"></div>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.</p>

                    @foreach ($insts as $inst)
                        <h3>#{{ $inst->instagram_tag }}</h3>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
