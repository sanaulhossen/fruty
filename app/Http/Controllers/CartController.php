<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Product;
use App\Coupon;
use App\Cart;

class CartController extends Controller
{
    //AjAX CART PAGE
    public function index($coupon_name = ""){

        $error_message = "";
        $discount_amount = 0;
        if ($coupon_name == "") {
            $error_message = "";
        } else {
            if (!Coupon::where('coupon_name', $coupon_name)->exists()) {
                $error_message = "This coupon you have have provide does not match!";
            } else {

                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name', $coupon_name)->first()->validity_till) {
                    $error_message = "This coupon has been expired!";
                } else {

                    $total = 0;
                    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                    $cart_data = json_decode($cookie_data, true);

                    foreach ($cart_data as $cart_item) {
                        $product = Product::find($cart_item['item_id']);
                        $product_price = $product->product_price;

                        $total =  $total + ($cart_item['item_quantity'] * $product_price);
                    }
                    if (Coupon::where('coupon_name', $coupon_name)->first()->minimum_purchase_amount > $total) {
                        $error_message = "You have to buy more than or equal " . Coupon::where('coupon_name', $coupon_name)->first()->minimum_purchase_amount . " TK";
                    } else {
                        $discount_amount = Coupon::where('coupon_name', $coupon_name)->first()->coupon_discount;
                    }
                }
            }
        }


        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        return view('frontend.cart', compact('error_message', 'discount_amount', 'coupon_name', 'cart_data'));
    }

     //AjAX WISH PAGE
    public function wishindex(){
        $cookie_data = stripslashes(Cookie::get('shopping_wish'));
        $wish_data = json_decode($cookie_data, true);

        return view('frontend.wish')->with('wish_data', $wish_data);
    }

    //AJAXX ADD TO CART DETAILS
    public function ajaxaddtocartdetails(Request $request){

        $prod_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $request->input('product_qty');
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart']);
                }
            }
        } else {


            $product = Product::find($prod_id);
            $priceval = $product->product_price;
            $prod_name = $product->product_name;
            $prod_image = $product->product_thumbnail_photo;

            if ($product) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_quantity' => $product_qty,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 50000;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));

                return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
            }
        }
    }

    //AJAX ADD TO CART
    public function ajaxaddtocart(Request $request){

        $prod_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $request->input('product_qty');
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart']);
                }
            }
        }else{

            $product = Product::find($prod_id);
            $priceval = $product->product_price;
            $prod_name = $product->product_name;
            $prod_image = $product->product_thumbnail_photo;

            if ($product) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_quantity' => $product_qty,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 50000;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));

                return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
            }
        }
    }

    // AJAX CART TOTAL COUNT
    public function cartloadbyajax(){
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);

            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
        else
        {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
    }

    //AJAX ADD TO WISH
    public function ajaxaddtowish(Request $request){

        $prod_id = $request->input('product_id');

        if (Cookie::get('shopping_wish')) {
            $cookie_data = stripslashes(Cookie::get('shopping_wish'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Wish']);
                }
            }
        } else {

            $product = Product::find($prod_id);
            $prod_name = $product->product_name;
            $prod_image = $product->product_thumbnail_photo;
            $priceval = $product->product_price;

            if ($product) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 50000;
                Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));

                return response()->json(['status' => '"' . $prod_name . '" Added to Wish']);
            }
        }
    }

    // AJAX WISH TOTAL COUNT
    public function wishloadbyajax(){
        if (Cookie::get('shopping_wish')) {
            $cookie_data = stripslashes(Cookie::get('shopping_wish'));
            $cart_data = json_decode($cookie_data, true);
            $totalwish = count($cart_data);

            echo json_encode(array('totalwish' => $totalwish));
            die;
            return;
        } else {
            $totalwish = "0";
            echo json_encode(array('totalwish' => $totalwish));
            die;
            return;
        }
    }

    //CART UPDATE INCREMENT AND DECREMENT
    public function updatetocart(Request $request){
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if (in_array($prod_id_is_there, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {

                    if ($cart_data[$keys]["item_id"] == $prod_id) {

                        $cart_data[$keys]["item_quantity"] =  $quantity;
                        $total = ($cart_data[$keys]["item_price"] *  $quantity);
                        $gtotoal_price = number_format($total);
                        $item_data = json_encode($cart_data);

                        $minutes = 50000;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json([
                            'status' => '"' . $cart_data[$keys]["item_name"] . '" Quantity Updated',
                            'gtprice' => '$'.$gtotoal_price.''
                        ]);
                    }
                }
            }
        }
    }

    // CART DELETE
    public function deletefromcart(Request $request){
        $prod_id = $request->input('product_id');

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $prod_id)
                {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status'=>'Item Removed from Cart']);
                }
            }
        }
    }

    //ADD TO CART FROM WISH WITH REMOVE FROM WISH
    public function ajaxaddtocartfromwish(Request $request){

        $prod_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        //PRODUCT ADD TO CART FROM WISH LIST

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $request->input('product_qty');
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart']);
                }
            }
        } else {

            $product = Product::find($prod_id);
            $priceval = $product->product_price;
            $prod_name = $product->product_name;
            $prod_image = $product->product_thumbnail_photo;

            if ($product) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_quantity' => $product_qty,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 50000;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
            }
        }

        //PRODUCT UNSET PR REMOVE AFTER ADD TO CART FROM WISH
        $cookie_data = stripslashes(Cookie::get('shopping_wish'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));
                    return response()->json(['status' => 'Successfully added to cart']);
                }
            }
        }
    }

    // WISH DELETE
    public function deletefromwish(Request $request){
        $prod_id = $request->input('product_id');

        $cookie_data = stripslashes(Cookie::get('shopping_wish'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 50000;
                    Cookie::queue(Cookie::make('shopping_wish', $item_data, $minutes));
                    return response()->json(['status' => 'Item Removed from wish']);
                }
            }
        }
    }

}
