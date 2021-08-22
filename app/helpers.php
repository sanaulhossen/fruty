<?php

use Illuminate\Support\Facades\Cookie;

function cart_total_items()
{
    return App\Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->get();
}

function cart_total_count()
{
    return App\Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->count();
}

function active_instagram_count()
{
    return App\Instagram::where('status', 2)->count();
}

function active_about_count()
{
    return App\About::where('status', 2)->count();
}

function review_customer_count($product_id)
{
    return App\Order_detail::where('product_id', $product_id)->whereNotNull('review')->count();
}

function average_stars_count($product_id)
{
    $count_amount = App\Order_detail::where('product_id', $product_id)->whereNotNull('review')->count();
    $price_stars_sum_amount = App\Order_detail::where('product_id', $product_id)->whereNotNull('review')->sum('price_stars');
    $value_stars_sum_amount = App\Order_detail::where('product_id', $product_id)->whereNotNull('review')->sum('value_stars');
    $quality_stars_sum_amount = App\Order_detail::where('product_id', $product_id)->whereNotNull('review')->sum('quality_stars');
    $all_stars = (($price_stars_sum_amount + $value_stars_sum_amount + $quality_stars_sum_amount) / 3);

    if ($all_stars == 0) {
        return 0;
    } else {
        return round($all_stars / $count_amount);
    }
}

function total_product_count(){
    return App\Order::count();
}

function total_sell(){
    $total = 0;
    $orders = App\Order::all();
    foreach ($orders as $order) {
        $total += $order->total;
    }
    return $total;
}

function total_profit(){
    $total = 0;
    $orders = App\Order::all();
    foreach ($orders as $order) {
        $total += $order->total;
    }

    // 10% profit each order

    $total_profit = ($total*10)/100;
    return $total_profit;
}

function total_customer(){
    return App\User::count();
}

function total_admin(){
    return App\User::where('role',1)->count();
}
