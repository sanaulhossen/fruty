<?php

namespace App\Http\Controllers;


use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Image;


class CategoryController extends Controller
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
        return view('admin.category.index',[
            'categories'    =>Category::all(),
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
            'category_name' =>'unique:categories,category_name'
        ]);

        $category_id = Category::insertGetId($request->except('_token','category_photo') + [
            'created_at'    =>Carbon::now(),
            'user_id'       =>Auth::id(),
        ]);

        if($request->hasFile('category_photo')){
            $uploaded_photo = $request->file('category_photo');
            $new_photo_name = $category_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/category_image/'.$new_photo_name;

            Image::make($uploaded_photo)->resize(360,270)->save(base_path($new_photo_location));
            Category::find($category_id)->update([
                'category_photo'   =>$new_photo_name
            ]);
        }
        return back()->with('success_status','Your category added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.category.edit',[
            'category_info' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->except('_token','_method','category_photo'));

        if($request->hasFile('category_photo')){

            if(Category::findOrFail($category->id)->category_photo != 'default.png'){

                unlink(base_path('public/dashbord/image/category_image/').Category::findOrFail($category->id)->category_photo);
            }


            $file_name = $category->id.'.'.$request->file('category_photo')->getClientOriginalExtension();

            Image::make($request->file('category_photo'))->resize(360,270)->save(base_path('public/dashbord/image/category_image/'.$file_name));

            Category::find($category->id)->update([
                'category_photo'   =>$file_name
            ]);
        }
        return back()->with('success_status','Category updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('delete_status','Category deleted Successfully!');
    }

    public function addproduct(){
        return view('admin.category.add',[
            'categories'    =>Category::all(),
        ]);
    }
}
