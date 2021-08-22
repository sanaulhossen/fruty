<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Slider;
use Carbon\Carbon;
use Image;
use App\User;

class SliderController extends Controller
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
        return view('admin.slider.index',[
            'sliders'    =>Slider::all(),
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
        $slider_id = Slider::insertGetId($request->except('_token','slider_photo') + [
            'created_at'    =>Carbon::now(),
            'user_id'       =>Auth::id(),
        ]);

        if($request->hasFile('slider_photo')){
            $uploaded_photo = $request->file('slider_photo');
            $new_photo_name = $slider_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/slider_image/'.$new_photo_name;

            Image::make($uploaded_photo)->resize(1920,800)->save(base_path($new_photo_location));
            Slider::find($slider_id)->update([
                'slider_photo'   =>$new_photo_name
            ]);
        }
        return back()->with('success_status','Your slider added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.slider.edit',[
            'slider_info' => Slider::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $slider->update($request->except('_token','_method','slider_photo'));

        if($request->hasFile('slider_photo')){

            if(Slider::findOrFail($slider->id)->slider_photo != 'default.png'){

                unlink(base_path('public/dashbord/image/slider_image/').Slider::findOrFail($slider->id)->slider_photo);
            }


            $file_name = $slider->id.'.'.$request->file('slider_photo')->getClientOriginalExtension();

            Image::make($request->file('slider_photo'))->resize(1920,800)->save(base_path('public/dashbord/image/slider_image/'.$file_name));

            Slider::find($slider->id)->update([
                'slider_photo'   =>$file_name
            ]);
        }
        return back()->with('success_status','slider updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('delete_status','Product deleted Successfully!');
    }

    public function addslider()
    {
        return view('admin.slider.add',[
            'sliders'    =>Slider::all(),
        ]);
    }
}
