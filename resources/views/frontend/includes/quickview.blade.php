    <!-- ****** Quick View Modal Area Start ****** -->
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img" id="quick_image">

                                </div>
                            </div>
                            <div class="col-12 col-lg-7">

                                <div class="quickview_pro_des">
                                    <h4 class="title" id="quick_name"></h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price" id="quick_price">$</h5>
                                    <p id="quick_desc"></p>
                                <div class="product__details__option">
                                    <div class="product__details_attri__size">
                                        <select id="country_list_1" name="country_id">
                                            <option value="">Select your Size</option>

                                            <option class="" value="">Black</option>
                                            <option class="" value="">Blue</option>
                                            <option class="" value="">Red</option>
                                            <option class="" value="">Yellow</option>
                                            <option class="" value="">Nevy Blue</option>

                                        </select>
                                    </div>
                                    <div class="product__details__attri__color">
                                        <select id="country_list_1" name="country_id">
                                            <option value="">Select your Color</option>

                                            <option class="" value="">Black</option>
                                            <option class="" value="">Blue</option>
                                            <option class="" value="">Red</option>
                                            <option class="" value="">Yellow</option>
                                            <option class="" value="">Nevy Blue</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="100" name="quantity" value="1">

                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <a type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</a>
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                        <a href="wishlist.html" target="_blank"><img src="{{ asset('frontend') }}/img/icon/heart.png" alt=""></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="compare.html" target="_blank"><img src="{{ asset('frontend') }}/img/icon/compare.png" alt=""></a>
                                    </div>
                                </form>

                                <div class="share_wf mt-30">
                                    <p>Share With Friend</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Quick View Modal Area End ****** -->
