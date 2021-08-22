<?php

namespace App\Http\Controllers;


use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Order_detail;
use Carbon\Carbon;
use App\Product;
use App\User;
use App\Order;
use App\Billing;
use App\Country;
use App\City;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = User::find(Auth::id());
        $country_infos = Country::all();

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        return view('frontend.checkout', compact('user', 'country_infos', 'cart_data'));
    }

    public function checkoutpost(Request $request){
        $billing_id = Billing::insertGetId([
            'name'          => $request->name,
            'email'         => $request->email,
            'number'        => $request->number,
            'address'       => $request->address,
            'address2'      => $request->address2,
            'note'          => $request->note,
            'created_at'    => Carbon::now()
        ]);
        $order_id = Order::insertGetId([
            'user_id'           => Auth::id(),
            'total'             => session('total'),
            'sub_total'         => session('cart_sub_total'),
            'discount_amount'   => session('discount'),
            'coupon_name'       => session('coupon_name'),
            'payment_option'    => $request->payment_option,
            'billing_id'        => $billing_id,
            'created_at'        => Carbon::now()
        ]);

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        foreach ($cart_data as $cart_item) {
            Order_detail::insert([
                'order_id'          => $order_id,
                'user_id'           => Auth::id(),
                'product_id'        => $cart_item['item_id'],
                'product_quantity'  => $cart_item['item_quantity'],
                'product_price'     => $cart_item['item_price'],
                'created_at'        => Carbon::now()
            ]);
            //Product table decrement
            Product::find($cart_item['item_id'])->decrement('product_quantity', $cart_item['item_quantity']);

        }

        if ($request->payment_option == 2) {
            session(['order_from_checkout_page' => $order_id]);
            return redirect('stripe');
        } elseif ($request->payment_option == 3) {

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            return view('exampleEasycheckout', compact('cart_data'));

        } elseif ($request->payment_option == 4) {
            echo 'paypal';
            //session(['order_from_checkout_page' => $order_id]);
            //return view('exampleEasycheckout');
        } else {
            echo 'cash on delivery';
            // Mail::to($request->email)->send(new ConfirmationMail);
            // return redirect('customer/home');
        }
        Cookie::queue(Cookie::forget('shopping_cart'));
        return redirect('/cart');
    }

    public function getcitylistajax(Request $request){
        $stringToSend = "";
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $stringToSend .= "<option value='" . $city->id . "'>" . $city->name . "</option>";
        }
        return $stringToSend;
    }
}
