<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product_image;
use Carbon\Carbon;
use App\ProductType;
use App\SizeColor;
use App\Product;
use App\Category;
use App\Tag;
use Image;

class ProductController extends Controller
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
        return view('admin.product.index',[
            'products'          =>Product::all(),
            'categories'        =>Category::all(),
            'tags'              =>Tag::all(),
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
        $slug_link = Str::slug($request->product_name."-".Str::random(5));
        $product_SKU = Str::slug($request->product_name."-".Str::random(2));
        $product_id = Product::insertGetId($request->except('_token','product_thumbnail_photo','product_multiple_photo','product_code','size_xxl','size_xl','size_l','size_m','size_s','color_black','color_nevy','color_yellow','color_red','color_white',) + [
            'slug'                  => $slug_link,
            'product_SKU'           => $product_SKU,
            'created_at'            => Carbon::now()
        ]);

        if($request->hasFile('product_thumbnail_photo')){
            $uploaded_photo = $request->file('product_thumbnail_photo');
            $new_photo_name = $product_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/product_image/'.$new_photo_name;

            Image::make($uploaded_photo)->resize(460,520)->save(base_path($new_photo_location));
            Product::find($product_id)->update([
                'product_thumbnail_photo'   =>$new_photo_name
            ]);
        }

        if($request->hasFile('product_multiple_photo')){
            $flag = 1;
            foreach ($request->file('product_multiple_photo') as $single_photo) {

                $uploaded_photo = $single_photo;
                $new_photo_name = $product_id."-".$flag.".".$uploaded_photo->getClientOriginalExtension();
                $new_photo_location = 'public/dashbord/image/product_multiple_image/'.$new_photo_name;
                Image::make($uploaded_photo)->resize(460, 520)->save(base_path($new_photo_location));

                Product_image::insert([
                    'product_id'                =>$product_id,
                    'product_multiple_photo'    =>$new_photo_name,
                    'created_at'                =>Carbon::now()
                ]);

                $flag++;
            }
        }

        return back()->with('product_status','Product Added Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.product.edit',[
            'categories'        => Category::all(),
            'tags'              => Tag::all(),
            'product_info'      => Product::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('_token','_method','product_thumbnail_photo'));

        if($request->hasFile('product_thumbnail_photo')){

            if(Product::findOrFail($product->id)->product_thumbnail_photo != 'default_product_thumbnail_photo.jpg'){

                unlink(base_path('public/dashbord/image/product_image/').Product::findOrFail($product->id)->product_thumbnail_photo);
            }


            $file_name = $product->id.'.'.$request->file('product_thumbnail_photo')->getClientOriginalExtension();

            Image::make($request->file('product_thumbnail_photo'))->resize(460, 520)->save(base_path('public/dashbord/image/product_image/'.$file_name));

            Product::find($product->id)->update([
                'product_thumbnail_photo'   =>$file_name
            ]);
        }
        return back()->with('product_update','Product updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('delete_status','Product deleted Successfully!');
    }

    public function addproduct (){
        return view('admin.product.add',[
            'categories'        =>Category::all(),
            'tags'              =>Tag::all(),
            'product_types'     =>ProductType::all(),
        ]);
    }

    public function editdeal($id){
        return view('admin.product.deal',[
            'product_info'          => Product::findOrFail($id)
        ]);
    }
    function updatedeal(Request $request)
    {
        Product::find($request->id)->update([
            'dealsOfDay' => $request->dealsOfDay,
        ]);
        return back()->with('delete_status', 'Product updated Successfully!');
    }

}
