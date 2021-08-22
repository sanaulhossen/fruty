<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\BlogCategory;
use Carbon\Carbon;
use App\Blog;
use Image;

class BlogController extends Controller
{

    //Middleware for auth check
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    //ADD BLOG PAGE
    public function addblog(){
        return view('admin.blog.add',[
            'Blog_cates'        => BlogCategory::all(),
        ]);
    }

    //ALL BLOG PAGE
    public function  blogindex(){
        return view('admin.blog.index',[
            'blogs'     => Blog::all(),
        ]);
    }

    //BLOG STORE IN DATABASE
    public function blogstore(Request $request){

        $slug_link = Str::slug($request->blog_title . "-" . Str::random(5));
        $blog_id = Blog::insertGetId($request->except('_token') + [
            'created_at'    => Carbon::now(),
            'slug'          => $slug_link,
            'user_id'       => Auth::id(),
        ]);

        if ($request->hasFile('blog_thumbnail_photo')) {

            $uploaded_photo = $request->file('blog_thumbnail_photo');
            $new_photo_name = $blog_id . "." . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/blog_image/' . $new_photo_name;

            Image::make($uploaded_photo)->resize(1170, 600)->save(base_path($new_photo_location));
            Blog::find($blog_id)->update([
                'blog_thumbnail_photo'   => $new_photo_name
            ]);
        }
        return back()->with('Blog_status', 'Blog Added Successfully!');
    }

    //BLOG EDIT
    function editblog($blog_id){
        return view('admin.blog.edit',[
            'blog_info'         => Blog::find($blog_id),
            'Blog_cates'        => BlogCategory::all(),
        ]);
        return back()->with('Blog_status', 'Blog Update Successfully!');
    }

    //BLOG UPDATE
    function updateblog(Request $request)
    {

        Blog::find($request->id)->update([
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description
        ]);


        if ($request->hasFile('blog_thumbnail_photo')) {
            if (Blog::findOrFail($request->id)->blog_thumbnail_photo != 'default_blog_thumbnail_photo.jpg') {
                unlink(base_path('public/dashbord/image/blog_image/') . Blog::findOrFail($request->id)->blog_thumbnail_photo);
            }

            $file_name = $request->id . '.' . $request->file('blog_thumbnail_photo')->getClientOriginalExtension();
            Image::make($request->file('blog_thumbnail_photo'))->resize(360, 270)->save(base_path('public/dashbord/image/blog_image/' . $file_name));
            Blog::find($request->id)->update([
                'blog_thumbnail_photo'   => $file_name
            ]);
        }
        return back()->with('Blog_status', 'Blog Updated Successfully!');
    }

    public function deletecategory(Request $request){

        $getslider = Blog::where('id', $request->id)->first();
        unlink(public_path('dashbord/image/blog_image/' . $getslider->blog_thumbnail_photo));
        Blog::where('id', $request->id)->delete();

        return back()->with('Blog_status', 'Blog Deleted Successfully!');
    }
}
