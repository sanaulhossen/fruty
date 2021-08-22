<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Order;

class StripePaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        if (session('order_from_checkout_page')) {
            return view('payment.stripe');
        } else {
            abort('404');
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $amount = ((int)session('total'));
        Stripe\Stripe::setApiKey('sk_test_51IAB7xFE5FEOpPiHuN24Y1nrzDEVKL8hlEL8UP1ZxlHWpW5t6e6xlAGoutr0WL0ERD6ZsCGXwgJdPaqqK5m4AVS6008cfWVUtC');
        Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Payment from fruty"
        ]);

        session([
            'cart_sub_total' => '',
            'discount' => '',
            'coupon_name' => '',
            'total' => '',
            'order_from_checkout_page' => ''
        ]);
        return redirect('profile/page');

    }
}
