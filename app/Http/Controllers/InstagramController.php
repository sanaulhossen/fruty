<?php

namespace App\Http\Controllers;


use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Instagram;
use Image;

class InstagramController extends Controller
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
        return view('admin.instagram.index',[
            'posts'         => Instagram::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider_id = Instagram::insertGetId($request->except('_token', 'instagram_img') + [
            'created_at'    => Carbon::now(),
            'user_id'       => Auth::id(),
        ]);

        if ($request->hasFile('instagram_img')) {
            $uploaded_photo = $request->file('instagram_img');
            $new_photo_name = $slider_id . "." . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/instagram_image/' . $new_photo_name;

            Image::make($uploaded_photo)->resize(257, 261)->save(base_path($new_photo_location));
            Instagram::find($slider_id)->update([
                'instagram_img'   => $new_photo_name
            ]);
        }
        return back()->with('success_status', 'Instagram post added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.instagram.edit', [
            'insta_info' => Instagram::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Instagram::find($request->id)->update([
            'instagram_tag' => $request->instagram_tag,
        ]);

        if ($request->hasFile('instagram_img')) {
            if (Instagram::findOrFail($request->id)->instagram_img != 'default.jpg') {
                unlink(base_path('public/dashbord/image/instagram_image/') . Instagram::findOrFail($request->id)->instagram_img);
            }

            $file_name = $request->id . '.' . $request->file('instagram_img')->getClientOriginalExtension();
            Image::make($request->file('instagram_img'))->resize(360, 270)->save(base_path('public/dashbord/image/instagram_image/' . $file_name));
            Instagram::find($request->id)->update([
                'instagram_img'   => $file_name
            ]);
        }
        return back()->with('Blog_status', 'Blog Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $getinsta = Instagram::where('id', $request->id)->first();
        unlink(public_path('dashbord/image/instagram_image/' . $getinsta->instagram_img));
        Instagram::where('id', $request->id)->delete();

        return back()->with('Blog_status', 'Blog Deleted Successfully!');
    }

    /**
     * Adding instagram post a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addinstagram(){
        return view('admin.instagram.add');
    }

    public function instagramactive(Request $request){
        $instagram = Instagram::find($request->id);
        $instagram->status = 2;
        $instagram->save();
        return back()->with('faq_status', 'Active Successfully!');
    }

    public function instagramdeactive(Request $request){
        $instagram = Instagram::find($request->id);
        $instagram->status = 1;
        $instagram->save();
        return back()->with('faq_deactive', 'Deactive Successfully!');
    }

}
