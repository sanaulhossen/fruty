<?php

namespace App\Http\Controllers;

use Image;
use App\about;
use App\Client;
use App\Review;
use Carbon\Carbon;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    //ABOUT ADD
    public function aboutadd(){
        return view('admin.about.about_add');
    }

    //ABOUT INDEX
    public function aboutindex(){
        return view('admin.about.about_index',[
            'abouts'       => About::all()
        ]);
    }

    //ABOUT STORE
    public function aboutstore(Request $request){
        $about = new About();
        $about->question = $request->question;
        $about->answer = $request->answer;
        $about->user_id = Auth::id();
        $about->save();
        return response()->json(['status' => 'About added successfully']);
    }

    //ABOUT EDIT
    public function aboutedit($about_id){
        return view('admin.about.about_edit', [
            'about_info'         => About::find($about_id),
        ]);
    }

    //ABOUT UPDATE
    public function aboutupdate(Request $request){

        $about = About::find($request->id);
        $about->question = $request->question;
        $about->answer = $request->answer;
        $about->user_id = Auth::id();
        $about->save();

        return response()->json(['status' => 'About updated successfully']);
    }

    //ABOUT DELETE
    public function aboutdelete(Request $request){
        About::find($request->id)->forceDelete();
        return response()->json(['status' => 'About Deleted!!']);
    }

    //ABOUT STATUS ACTIVE
    public function aboutstatusactive($about_id){
        $about = About::find($about_id);
        $about->status = 2;
        $about->save();

        return back()->with('about_status', 'Status change added successfully!');
    }

    //ABOUT STATUS DEACTIVE
    public function aboutstatusdeactive($about_id){
        $about = About::find($about_id);
        $about->status = 1;
        $about->save();

        return back()->with('about_status', 'Status change added successfully!');
    }

    //CLIENT INDEX
    public function aboutclient(){
        return view('admin.about.client_index',[
            'clients'       => Client::all(),
        ]);
    }

    //CLIENT ADD PAGE
    public function clientadd(){
        return view('admin.about.client_add');
    }

    //CLIENT ADD in DATABASE
    public function clientstore(Request $request){
        $request->validate([
            'file' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'required'
        ]);

        $client_id = Client::insertGetId($request->except('_token', 'file') + [
            'created_at'    => Carbon::now(),
        ]);

        if ($request->hasFile('file')) {
            $uploaded_photo = $request->file('file');
            $new_photo_name = $client_id . "." . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/dashbord/image/client_image/' . $new_photo_name;

            Image::make($uploaded_photo)->resize(65, 75)->save(base_path($new_photo_location));
            Client::find($client_id)->update([
                'file'   => $new_photo_name
            ]);
        }
        return back()->with('success_status', 'Your category added successfully!');
    }

    //TESTIMONIAL INDEX
    public function testimonialindex(){
        return view('admin.about.testimonial_index');
    }

    //TESTIMONIAL STORE
    public function testimonialtore(Request $request){
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'position'      => 'required',
            'comment'       => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $team = new Testimonial();
            $team->name = $request->input('name');
            $team->position = $request->input('position');
            $team->comment = $request->input('comment');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('dashbord/image/testimonial_image/', $filename);
                $team->image = $filename;
            }
            $team->save();

            return response()->json([
                'status' => 200,
                'message' => 'Testimonial Data Added Successfully.'
            ]);
        }
    }

    //TESTIMONIAL DATA
    public function testimonialdata(){
        $testimonial = Testimonial::all();
        return response()->json([
            'testimonial'  => $testimonial,
        ]);
    }

    //REVIEW INDEX
    public function reviewindex(){
        return view('admin.about.review_index',[
            'review'     => Review::findOrFail(1)
        ]);
    }

    //REVIEW STORE 1
    public function reviewstore1(Request $request){

        Review::find(1)->update([
            'our_clients' => $request->our_clients,
        ]);
        return back()->with('review_status', 'Review added successfully!');
    }

    //REVIEW STORE 2
    public function reviewstore2(Request $request){

        Review::find(1)->update([
            'total_categories' => $request->total_categories,
        ]);
        return back()->with('review_status', 'Review added successfully!');
    }

    //REVIEW STORE 3
    public function reviewstore3(Request $request){

        Review::find(1)->update([
            'in_country' => $request->in_country,
        ]);
        return back()->with('review_status', 'Review added successfully!');
    }

    //REVIEW STORE 4
    public function reviewstore4(Request $request){

        Review::find(1)->update([
            'happy_customer' => $request->happy_customer,
        ]);
        return back()->with('review_status', 'Review added successfully!');
    }

    //TESTIMONAL EDIT SECTION
    public function testimonialedit($id){
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            return response()->json([
                'status' => 200,
                'testimonial' => $testimonial
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Testimonial Data Not Found.'
            ]);
        }
    }

    //TESTIMONAL UPDATE SECTION
    public function testimonialupdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'comment'       => 'required',
            'position'      => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $testimonial = Testimonial::find($id);
            if ($testimonial) {
                $testimonial->name = $request->input('name');
                $testimonial->comment = $request->input('comment');
                $testimonial->position = $request->input('position');

                if ($request->hasFile('image')) {
                    $path = 'dashbord/image/testimonial_image/' . $testimonial->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('dashbord/image/testimonial_image/', $filename);
                    $testimonial->image = $filename;
                }
                $testimonial->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Testimonial Data Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Testimonial Data Not Found'
                ]);
            }
        }
    }

    //DELETE TEAM SECTION
    public function testimonialdelete($id){
        $testimonial = Testimonial::find($id);
        if ($testimonial) {

            $path = 'dashbord/image/testimonial_image/' . $testimonial->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $testimonial->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Testimonial Deleted Successfully!'
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Testimonial data not found.'
            ]);
        }
    }
}
