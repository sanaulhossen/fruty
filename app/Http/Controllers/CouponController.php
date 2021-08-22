<?php

namespace App\Http\Controllers;


use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupon.index', [
            'coupons'    => Coupon::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupon::insert($request->except('_token',) + [
            'created_at'    => Carbon::now(),
            'user_id'       => Auth::id(),
        ]);
        return back()->with('success_status', 'Your Coupon added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.coupon.edit', [
            'coupon_info' => Coupon::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        Coupon::find($coupon->id)->update([
            'coupon_name'                   => $request->coupon_name,
            'coupon_discount'               => $request->coupon_discount,
            'coupon_description'            => $request->coupon_description,
            'minimum_purchase_amount'       => $request->minimum_purchase_amount,
            'validity_till'                 => $request->validity_till
        ]);
        return back()->with('success_coupon', 'Tag Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addcoupon(){
        return view('admin.coupon.add');
    }
}
