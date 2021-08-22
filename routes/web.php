<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*
|----------------------------------------------------------------------------------------------------------
| FRONTEND CONTROLLER FOR FRONTEND START
|----------------------------------------------------------------------------------------------------------
*/
Route::get('/', 'FrontendController@index');
Route::get('category/details/{category_name}','FrontendController@categorydetails');
Route::get('shop','FrontendController@shop');
Route::get('contact', 'FrontendController@contact');
Route::get('about', 'FrontendController@about');
Route::get('blog', 'FrontendController@blog');
Route::get('product/details/{slug}', 'FrontendController@productdetails');
Route::post('contact/message', 'FrontendController@contactmessage');
Route::get('cart/remove/{cart_id}', 'FrontendController@cartremove');
Route::get('terms', 'FrontendController@terms');
Route::get('faq', 'FrontendController@faq');
//BLOG DETAILS PAGE
Route::get('blog/details/{slug}', 'FrontendController@blogdetails');

//NEXT BLOG POST
Route::get('blog/next/details/{id}', 'FrontendController@blognextdetails');
//QUICK VIEW ROUTE
Route::post('/post/product/details', 'FrontendController@postproductdetails');
Route::post('/post/product/details/2nd', 'FrontendController@postproductdetails2nd');
Route::post('/post/product/details/3rd', 'FrontendController@postproductdetails3rd');
Route::post('/post/product/details/4th', 'FrontendController@postproductdetails4th');

//REVIEW ADD FOR PRODUCT
Route::post('review/form','FrontendController@reviewform');

/*
|-------------------------------------------------------------------------------------------------------------
| FRONTEND CONTROLLER FOR FRONTEND END
|-------------------------------------------------------------------------------------------------------------
*/


Auth::routes(['verify' => true]);

##########################################  HOME CONTROLLER FOR DASHBORD START  ####################################
Route::get('/home', 'HomeController@index')->name('home');
Route::get('contact/message/show', 'HomeController@contactmessageshow');
Route::get('contact/message/delete/{id}', 'HomeController@contactmessagedelete')->name('message.delete');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/photo', 'HomeController@profilephoto')->name('profile.photo');
Route::post('profile/info', 'HomeController@profileinfo')->name('profile.info');
Route::post('address/store', 'HomeController@addressstore')->name('address.store');
//Ajax city list
Route::post('get/city/list/ajax/profile', 'HomeController@getcitylistajax');


//USER AND SUBSCRIBERS
Route::get('user', 'HomeController@userindex');
Route::get('role/change/{id}', 'HomeController@rolechange')->name('role.change');
Route::post('user/change/{id}', 'HomeController@userchange')->name('user.change');
Route::get('user/message/{id}', 'HomeController@usermessage')->name('user.message');
Route::post('email/send', 'HomeController@emailsend')->name('email.send');
Route::get('email/alluser', 'HomeController@emailalluser')->name('email.alluser');
Route::post('email/send/alluser', 'HomeController@emailsendalluser')->name('emailsend.alluser');


//SUBSCRIBER
Route::get('subscriber', 'HomeController@subscriberindex');
Route::get('email/allsubscriber', 'HomeController@emailallsubscriber')->name('email.allsubscriber');
Route::post('emailsend/allsubscriber', 'HomeController@emailsendallsubscriber')->name('emailsend.allsubscriber');
Route::get('subscriber/delete/{id}', 'HomeController@subscriberdelete')->name('subscriber.delete');

//NEWSLETTER
Route::post('newsletter-subscriber', 'HomeController@newsLetterForsSubscriber')->name('news.letter');

//SEND MESSAGE TO SUBSCRIBER
Route::get('message/send/{id}', 'HomeController@messagesend')->name('message.send');
Route::post('message/reply', 'HomeController@messagereply')->name('message.reply');

//ALL ADMIN
Route::get('all/admin', 'HomeController@alladmin')->name('all.admin');

##########################################  HOME CONTROLLER FOR DASHBORD FINISH  ####################################


########################################################  CART CONTROLLER START  ####################################
//ajax cart page
Route::get('/cart', 'CartController@index');
Route::get('cart/{coupon_name}', 'CartController@index');
//Ajax add to cart
Route::post('add-to-cart', 'CartController@ajaxaddtocart');
Route::post('add-to-cart-details', 'CartController@ajaxaddtocartdetails');
Route::get('/load-cart-data', 'CartController@cartloadbyajax');
// UPDATE CART WITH INCREMENT AND DECREMENT
Route::post('update-to-cart', 'CartController@updatetocart');
// CART DELETE
Route::delete('delete-from-cart', 'CartController@deletefromcart');
//AJAX ADD TO WISH
Route::post('add-to-wish', 'CartController@ajaxaddtowish');
Route::get('/load-wish-data', 'CartController@wishloadbyajax');
//ADD TO CART FROM WISH
Route::post('add-to-cart-from-wish', 'CartController@ajaxaddtocartfromwish');
//WISH PAGE ROUTE
Route::get('wish', 'CartController@wishindex');

// WISH DELETE
Route::delete('delete-from-wish', 'CartController@deletefromwish');
#########################################################  CART CONTROLLER END  ####################################


######################################################  COUPON CONTROLLER START ####################################
Route::resource('coupon', 'CouponController');
Route::get('add/coupon', 'CouponController@addcoupon');
########################################################  COUPON CONTROLLER END ####################################


#####################################################  CATEGORY CONTROLLER  START  #################################
Route::resource('category', 'CategoryController');
Route::get('add/category','CategoryController@addproduct');
#######################################################  CATEGORY CONTROLLER  END  #################################


##########################################################  TAG CONTROLLER  START  #################################
Route::resource('tag', 'TagController');
Route::get('add/tag','TagController@addproduct');
############################################################  TAG CONTROLLER  END  #################################


#######################################################  SLIDER CONTROLLER  START  #################################
//CategorController Controller Start
Route::resource('slider', 'SliderController');
Route::get('add/slider','SliderController@addslider');
#########################################################  SLIDER CONTROLLER  END  #################################


######################################################  PRODUCT CONTROLLER  START  #################################
Route::resource('product', 'ProductController');
Route::get('add/product','ProductController@addproduct');
Route::get('add/product/size/color','ProductController@addproductsizecolor');
Route::get('product_size_color/edit/{sizeColor_id}','ProductController@product_size_coloredit');
Route::get('product_size_color/destroy/{sizeColor_id}','ProductController@addproductsizecolor');
Route::post('size/color/update/{sizeColor_id}','ProductController@sizecolorupdate');

//Deals of the day
Route::get('edit/deal/{product_id}', 'ProductController@editdeal')->name('product.deal');
Route::post('update/deal', 'ProductController@updatedeal')->name('deal.update');
########################################################  PRODUCT CONTROLLER  END  #################################



#################################################  PRODUCT TYPE CONTROLLER  START  #################################
Route::resource('productType', 'ProductTypeController');
Route::get('add/product_type','ProductTypeController@add_product_type');
###################################################  PRODUCT TYPE CONTROLLER  END  #################################


#####################################################  CHECKOUT CONTROLLER  START  #################################
Route::get('checkout','CheckoutController@index');
Route::post('checkout/post', 'CheckoutController@checkoutpost');

//Ajax city list
Route::post('get/city/list/ajax', 'CheckoutController@getcitylistajax');
#######################################################  CHECKOUT CONTROLLER  END  #################################


################################################  BLOG CATEGORY CONTROLLER  START  #################################
Route::resource('blogCategory', 'BlogCategoryController');
Route::get('blogCategory/edit/{id}', 'BlogCategoryController@blogCategoryedit');
Route::put('blogCategory/update/model', 'BlogCategoryController@blogCategoryupdate');
Route::delete('blogCategory/{id}', 'BlogCategoryController@blogCategorydelete');
##################################################  BLOG CATEGORY CONTROLLER  END  #################################


########################################################  BLOG CONTROLLER  START  #################################
Route::get('add/blog', 'BlogController@addblog')->name('add.blog');
Route::get('add/blog/post', 'BlogController@blogindex')->name('blog.index');
Route::post('add/blog/post', 'BlogController@blogstore')->name('blog.store');
Route::get('edit/blog/{blog_id}', 'BlogController@editblog')->name('blog.edit');
Route::post('delete/blog/', 'BlogController@deletecategory')->name('blog.destroy');
Route::post('update/blog', 'BlogController@updateblog')->name('blog.update');
###########################################################  BLOG CONTROLLER  END  #################################


####################################################  INSTAGRAM CONTROLLER  START  #################################
Route::resource('instagram', 'InstagramController');
Route::get('add/instagram', 'InstagramController@addinstagram')->name('instagram.add');
Route::post('instagram/active', 'InstagramController@instagramactive')->name('instagram.active');
Route::post('instagram/deactive', 'InstagramController@instagramdeactive')->name('instagram.deactive');
######################################################  INSTAGRAM CONTROLLER  END  #################################


########################################################  ORDER CONTROLLER  START  #################################
Route::get('order/update/{order_id}', 'OrderController@orderupdate')->name('order.update');
Route::get('order/cancel/{order_id}', 'OrderController@ordercancel')->name('order.cancel');
Route::get('order/edit/{order_id}', 'OrderController@orderedit')->name('order.edit');
Route::post('update/delivery/post', 'OrderController@updatedeliverypost')->name('delivery.post');
#########################################################  ORDER CONTROLLER  END  #################################


#############################################  CUSTOMER PROFILE CONTROLLER START  #################################
Route::get('profile/page', 'ProfileController@profilepage')->middleware('verified');
Route::get('view/order/{order_id}', 'ProfileController@vieworder')->name('view.order');
Route::post('address/profile', 'ProfileController@addressprofile')->name('address.profile');
Route::post('profile/info/customer', 'ProfileController@profileinfocustomer')->name('info.customer');
Route::post('change/password', 'ProfileController@changepassword')->name('change.password');
Route::get('order/invoice/{order_id}', 'ProfileController@orderinvoice')->name('order.invoice');
###############################################  CUSTOMER PROFILE CONTROLLER END  #################################


##################################################  ABOUT COMTROLLER START  #######################################
Route::get('about/add', 'AboutController@aboutadd')->name('about.add');
Route::get('about/index', 'AboutController@aboutindex')->name('about.index');
Route::post('about/store', 'AboutController@aboutstore')->name('about.store');
Route::get('about/edit/{about_id}', 'AboutController@aboutedit')->name('about.edit');
Route::post('about/update', 'AboutController@aboutupdate')->name('about.update');
Route::post('about/delete', 'AboutController@aboutdelete');
Route::get('about/active/{about_id}', 'AboutController@aboutstatusactive')->name('about.active');
Route::get('about/deactive/{about_id}', 'AboutController@aboutstatusdeactive')->name('about.deactive');

//CLIENT AREA
Route::get('client/add', 'AboutController@clientadd')->name('client.add');
Route::get('client/index', 'AboutController@aboutclient')->name('client.index');
Route::post('client/store', 'AboutController@clientstore')->name('client.store');

//TESTIMONIAL AREA
Route::get('testimonial-index', 'AboutController@testimonialindex')->name('add.testimonial');
Route::post('testimonial-store', 'AboutController@testimonialtore')->name('testimonial.store');
Route::get('testimonial-data', 'AboutController@testimonialdata')->name('testimonial.data');
Route::get('testimonial-edit/{id}', 'AboutController@testimonialedit')->name('testimonial.edit');
Route::post('testimonial-update/{id}', 'AboutController@testimonialupdate')->name('testimonial.update');
Route::delete('testimonial-delete/{id}', 'AboutController@testimonialdelete')->name('testimonial.delete');

//REVIEW ASRE
Route::get('review-index', 'AboutController@reviewindex')->name('review.index');
Route::post('review-store1', 'AboutController@reviewstore1')->name('review.store1');
Route::post('review-store2', 'AboutController@reviewstore2')->name('review.store2');
Route::post('review-store3', 'AboutController@reviewstore3')->name('review.store3');
Route::post('review-store4', 'AboutController@reviewstore4')->name('review.store4');
#######################################################  ABOUT COMTROLLER END ######################################


##############################################  TEAM CONTROLLER FOR TEAM START  ####################################
Route::get('team-data', 'TeamController@teamdata')->name('team.data');
Route::get('team-index', 'TeamController@teamindex')->name('team.index');
Route::post('team-store', 'TeamController@teamstore')->name('team.store');
Route::get('team-edit/{id}', 'TeamController@teamedit')->name('team.edit');
Route::post('team-update/{id}', 'TeamController@teamupdate')->name('team.update');
Route::delete('team-delete/{id}', 'TeamController@teamdelete')->name('team.delete');
###########################################  LOGIN WITH GITHUB CONTROLLER END ######################################


#############################################  STRIPE PAYMENT CONTROLLER START  ####################################
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
###########################################  LOGIN WITH GITHUB CONTROLLER END ######################################


##########################################  LOGIN WITH GITHUB CONTROLLER START  ####################################
Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');
###########################################  LOGIN WITH GITHUB CONTROLLER END ######################################


//Google login
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

//COMMENT
Route::post('comment-store', 'CommentController@commentstore')->name('comment.store');
Route::get('comment-data', 'CommentController@commentdata')->name('comment.data');


// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END



//MIDDLEWARE CHECK FOR DEMO USER
Route::group(['middleware' => ['checkDemoAdmin']],function () {
    Route::get('user/message/{id}', 'HomeController@usermessage')->name('user.message');
    Route::get('role/change/{id}', 'HomeController@rolechange')->name('role.change');
    Route::get('subscriber/delete/{id}', 'HomeController@subscriberdelete')->name('subscriber.delete');
    Route::get('message/send/{id}', 'HomeController@messagesend')->name('message.send');
    Route::get('contact/message/delete/{id}', 'HomeController@contactmessagedelete')->name('message.delete');
    Route::get('about/edit/{about_id}', 'AboutController@aboutedit')->name('about.edit');
    Route::get('about/active/{about_id}', 'AboutController@aboutstatusactive')->name('about.active');
    Route::get('about/deactive/{about_id}', 'AboutController@aboutstatusdeactive')->name('about.deactive');
    Route::post('about/delete', 'AboutController@aboutdelete');
    Route::get('testimonial-edit/{id}', 'AboutController@testimonialedit')->name('testimonial.edit');
    Route::get('edit/deal/{product_id}', 'ProductController@editdeal')->name('product.deal');
    Route::get('edit/blog/{blog_id}', 'BlogController@editblog')->name('blog.edit');
    Route::post('delete/blog/', 'BlogController@deletecategory')->name('blog.destroy');
    Route::post('instagram/active', 'InstagramController@instagramactive')->name('instagram.active');
    Route::post('instagram/deactive', 'InstagramController@instagramdeactive')->name('instagram.deactive');
    Route::get('order/update/{order_id}', 'OrderController@orderupdate')->name('order.update');
    Route::get('order/cancel/{order_id}', 'OrderController@ordercancel')->name('order.cancel');
    Route::get('order/edit/{order_id}', 'OrderController@orderedit')->name('order.edit');


    Route::resource('product', 'ProductController',['except' => ['show','index']]);
    Route::resource('category','CategoryController',['except' => ['show', 'index']]);
    Route::resource('tag','TagController', ['except' => ['show', 'index']]);
    Route::resource('productType','ProductTypeController', ['except' => ['show', 'index']]);
    Route::resource('slider','SliderController', ['except' => ['show', 'index']]);
    Route::resource('coupon','CouponController', ['except' => ['show', 'index']]);
    Route::resource('instagram','InstagramController', ['except' => ['show', 'index']]);


});
