<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\ProductType;
use App\Order_Detail;
use App\BlogCategory;
use Carbon\Carbon;
use App\Product;
use App\Slider;
use App\Contact;
use App\Category;
use App\Blog;
use App\Tag;
use App\Cart;
use App\Client;
use App\Instagram;
use App\Review;
use App\about;
use App\Team;
use App\Testimonial;
use DB;

class FrontendController extends Controller
{
    function index(){

        $deal = Product::whereNotNull('dealsOfDay')->limit(1)->get();

        $b_seller = DB::table('order__details')
                    ->select('product_id', DB::raw('count(*) as total'))
                    ->groupBy('product_id')
                    ->get();

        $b_seller_desc = $b_seller->sortByDesc('total')->take(4);


    	return view('frontPage', [
            'sliders'       	=> Slider::all(),
            'products'          => Product::latest()->limit(8)->get(),
            'categories'       	=> Category::latest()->limit(3)->get(),
            'top_sales'         => $b_seller_desc,
            'blogs'             => Blog::latest()->limit(3)->get(),
            'deals'             => $deal,
            'insts'             => Instagram::where('status', 2)->get(),
        ]);
    }

    function categorydetails($category_name){
    	$category_info = Category::where('category_name', $category_name)->firstOrFail();
        $products = Product::where('category_id', $category_info->id)->get();
        return view('frontend.categorydetails',[
            'category_info'     => $category_info,
            'products'          => $products,
        ]);
    }

    function shop(){
        return view('frontend.shop', [
            'products'          => Product::latest()->limit(9)->get(),
            'producttypes'      => ProductType::all(),
            'categories'        => Category::all(),
            'tags'              => Tag::all(),
        ]);
    }

    function contact(){
        return view('frontend.contact');
    }

    function terms(){
        return view('frontend.terms');
    }

    function faq(){
        return view('frontend.faq');
    }

    function about()
    {
        return view('frontend.about',[
            'review'            => Review::findOrFail(1),
            'teams'             => Team::latest()->limit(4)->get(),
            'testimonials'      => Testimonial::all(),
            'clients'           => Client::latest()->limit(8)->get(),
            'abouts'            => About::where('status', 2)->get(),
        ]);
    }

    //BLOG PAGE
    function blog()
    {
        return view('frontend.blog',[
            'blogs'     => Blog::all(),
        ]);
    }

    //BLOG DETAILS
    function blogdetails($slug)
    {
        $blog_info = Blog::where('slug', $slug)->firstOrFail();
        return view('frontend.blogdetails', [
            'blog_info'     => $blog_info,
            'blog_cates'    => BlogCategory::all(),
        ]);
    }

    function blognextdetails($id){

        $blog_info = Blog::where('id', $id)->firstOrFail();
        $recent_blogs = Blog::where('blogCategory_id', $blog_info->blogCategory_id)->where('id', '!=', $blog_info->id)->limit(4)->get();
        return view('frontend.blogdetails', [
            'blog_info'     => $blog_info,
            'blog_cates'    => BlogCategory::all(),
        ]);
    }

    function contactmessage(Request $request){
        Contact::insert($request->except('_token') + [
            'created_at'    => Carbon::now()
        ]);
        return back()->with('config_message', 'Your message has been successdully sent!');
    }

    function productdetails($slug){
        $product_info = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->limit(4)->get();

        $show_review_form = 0;

        if(Order_detail::where('user_id', Auth::id())->where('product_id', $product_info->id)->whereNull('review')->exists()){
            $order_details_id = Order_detail::where('user_id', Auth::id())->where('product_id', $product_info->id)->whereNull('review')->first()->id;
            $show_review_form = 1;
        }else{
            $show_review_form = 2;
            $order_details_id = 0;
        }
        $reviews = Order_detail::where('product_id', $product_info->id)->whereNotNull('review')->get();


        return view('frontend.includes.productdetails', [
            'product_info'      => $product_info,
            'related_products'  => $related_products,
            'show_review_form'  => $show_review_form,
            'order_details_id'  => $order_details_id,
            'reviews'           => $reviews
        ]);
    }

    function reviewform(Request $request){
        //print_r($request->all());
        Order_detail::find($request->order_details_id)->update([
            'quality_stars'     => $request->quality_stars,
            'value_stars'       => $request->value_stars,
            'price_stars'       => $request->price_stars,
            'review'            => $request->review
        ]);
        return back()->with('review_status', 'Blog Added Successfully!');
    }

    public function cartremove($cart_id){
        Cart::find($cart_id)->delete();
        Cookie::queue(Cookie::forget('shopping_cart'));
        Cookie::queue(Cookie::forget('g_cart_id'));
        return back()->with('remove_status', 'Product remove from cart!');
    }

    // AJAX START
    function postproductdetails(Request $request){
        $name = "";
        $pupup_products = Product::where('id', $request->pupup)->get();
        foreach ($pupup_products as $pupup_product) {
            $name .=  $pupup_product->product_name;
        }
        return $name;
    }
    function postproductdetails2nd(Request $request){
        $pupup_products = Product::where('id', $request->pupup)->get();
        $price = "";
        foreach ($pupup_products as $pupup_product) {
            $price .=  '$'.$pupup_product->product_price;
        }
        return $price;
    }
    function postproductdetails3rd(Request $request){
        $pupup_products = Product::where('id', $request->pupup)->get();
        $desc = "";
        foreach ($pupup_products as $pupup_product) {
            $desc .=   $pupup_product->product_short_description;
        }
        return $desc;
    }
    function postproductdetails4th(Request $request){
        $pupup_products = Product::where('id', $request->pupup)->get();
        $image = "";
        foreach ($pupup_products as $pupup_product) {
            $image .= "<img src='dashbord/image/product_image/". $pupup_product->product_thumbnail_photo ."'>";
        }
        return $image;
    }
    //AJAX END
}
