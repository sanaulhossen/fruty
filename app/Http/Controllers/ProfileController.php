<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Hash;
use Illuminate\Http\Request;
use App\Order_Detail;
use App\Product;
use App\Country;
use App\Order;
use App\City;
use App\User;
use PDF;

class ProfileController extends Controller
{

    //USER MIDDLEWARE
    public function __construct(){
        $this->middleware('auth');
    }

    //PROFILE PAGE FOR CUSTOMER
    public function profilepage(){
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(5);

        return view('customer.index',[
            'countries'         => Country::all(),
            'orders'            => $orders,
        ]);
    }

    //AJAX COUNTRY CHANGE TO CITY SHOW
    public function getcitylistajax(Request $request){
        $stringToSend = "";
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $stringToSend .= "<option value='" . $city->id . "'>" . $city->name . "</option>";
        }
        return $stringToSend;
    }

    //AJAX ADDRESS
    public function addressprofile(Request $request){
        User::find(Auth::id())->update([
            'fullAddress'          => $request->fullAddress,
        ]);
        return back();
    }

    //INFORMATION UPDATTE IN USER TABLE
    public function profileinfocustomer(Request $request){

        User::find(Auth::id())->update([
            'username'          => $request->username,
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'profession'        => $request->profession,
        ]);
        return back();
    }

    //CHANGE PASSWORD
    public function changepassword(Request $request){
        $request->validate([
            'password'    => 'confirmed|min:8'
        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->old_password == $request->password) {
                return back()->with('password_old', 'Old password and New password is same!!');
            } else {
                User::find(Auth::id())->update([
                    'password'    => Hash::make($request->password)
                ]);
                return back()->with('password_change', 'Password changed successfully!!');;
            }
        } else {
            return back()->with('password_error', 'Your old password does not match!!');
        }
    }

    //VIEW ORDER PRODUCCTS
    public function vieworder($order_id){

        $order_details = Order_Detail::where('order_id', $order_id)->get();
        $order_info = Order::find($order_id);
        return view('customer.view',[
            'orders'            => $order_details,
            'order_info'        => $order_info,
        ]);
    }

    //INVOICE DOWNLOAD
    public function orderinvoice($order_id){
        $order_details = Order_Detail::where('order_id', $order_id)->get();
        $order_info = Order::find($order_id);
        $pdf = PDF::loadView('pdf.invoice', compact('order_info', 'order_details'));
        return $pdf->download('FrutyInvoice(Order ID-'. $order_id .').pdf');
    }

}
