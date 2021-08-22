<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_detail;
use App\Product;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    public function orderupdate($order_id){
        $order = Order::find($order_id);
        $order->payment_status = 2;
        $order->save();
        return back()->with('payment_update', 'Payment Status Updated Successfully!');
    }

    public function ordercancel($order_id)
    {
        $order_details = Order_detail::where('order_id', $order_id)->get();
        foreach ($order_details as $order_detail) {
            Product::find($order_detail->product_id)->increment('product_quantity', $order_detail->product_quantity);
        }
        Order::find($order_id)->update([
            'payment_status'    => 3,
        ]);
        return back()->with('order_delete', 'Order deleted successfully!');
    }
    public function orderedit($id){
        return view('admin.user.orderEdit', [
            'active_order'    => Order::findOrFail($id)
        ]);
    }

    public function updatedeliverypost(Request $request)
    {
        $order = Order::find($request->id);
        $order->delivery_status = $request->delivery_status;
        $order->save();
        return back()->with('order_delivery', 'Delivery Status Updated Successfully!');
    }
}
