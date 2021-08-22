<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        return view('admin.blog.blogCategory',[
            'BlogCategories'        => BlogCategory::all()
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
            'title' => 'unique:blog_categories,title'
        ]);

        $blogCategory = new BlogCategory();
        $blogCategory->title = $request->title;
        $blogCategory->description = $request->description;
        $blogCategory->save();
        return response()->json($blogCategory);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogCategory::find($id)->forceDelete();
        return back()->with('delete_status','Blog Category deleted Successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blogCategoryedit($id)
    {
        $blogCategory = BlogCategory::find($id);
        return response()->json($blogCategory);
    }

    public function blogCategoryupdate(Request $request){

        $blogCategory = BlogCategory::find($request->id);
        $blogCategory->title = $request->title;
        $blogCategory->description = $request->description;
        $blogCategory->save();
        return response()->json($blogCategory);

    }
}
