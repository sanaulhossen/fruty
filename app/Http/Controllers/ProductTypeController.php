<?php

namespace App\Http\Controllers;


use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\ProductType;
use Carbon\Carbon;

class ProductTypeController extends Controller
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
        return view('admin.product_type.index',[
            'product_types'    =>ProductType::all(),
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
        $request->validate([
            'product_type_name' =>'unique:product_types,product_type_name'
        ]);

        ProductType::insert($request->except('_token',) + [
            'created_at'    =>Carbon::now(),
            'user_id'       =>Auth::id(),
        ]);
        return back()->with('success_status','Your Product Type added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.product_type.edit',[
            'product_type_info'    => ProductType::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        ProductType::find($productType->id)->update([
            'product_type_name'   =>$request->product_type_name,
            'product_type_description'   =>$request->product_type_description
        ]);
        return back()->with('success_status','Product Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return back()->with('delete_status','Product Type deleted Successfully!');
    }

    public function add_product_type()
    {
        return view('admin.product_type.add',[
            'product_types'    =>ProductType::all(),
        ]);
    }

}
