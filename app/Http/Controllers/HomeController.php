<?php

namespace App\Http\Controllers;

use Image;
use App\City;
use App\User;
use App\Order;
use App\Contact;
use App\Country;
use App\Subscriber;
use App\Mail\EmailAllUser;
use App\Mail\MessageReply;
use App\Mail\EmailSendUser;
use Illuminate\Http\Request;
use App\Mail\EmailAllSubscriber;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Mail;


class HomeController extends Controller
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

    //DASHBORD HOME PAGE WITH ORDER
    public function index(){
        $orders = Order::orderBy('id', 'DESC')->paginate(6);
        $admins = User::where('role', 1)->limit(9)->get();
        return view('home', compact('orders', 'admins'));
    }


    //ALL ADMIN SHOW HERE
    public function alladmin(){
        $admins = User::where('role', 1)->get();
        return view('admin.user.all_admin_here', compact('admins'));
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------
     * USER SECTION ACTION START
     * -----------------------------------------------------------------------------------------------------------------------
    */

    //USER PAGE FOR USER MANAGEMENT
    public function userindex(){
        $users = User::latest()->paginate(5);
        $total_users = User::count();
        return view('admin.user.user', compact('users', 'total_users'));
    }

    //USER ROLE PAGE
    public function rolechange($id){
        return view('admin.user.user_role_change', [
            'user'   => User::find($id),
        ]);
    }

    //USER ROLE CHANGE HERE
    public function userchange (Request $request, User $user){
        User::find($request->id)->update([
            'role'   => $request->role,
        ]);
        return back()->with('success_status', 'Tag Updated Successfully!');
    }

    //EMAIL SEND TO USER AND ADMIN
    PUBLIC FUNCTION emailsend(Request $request){

        $details = [
            'subject' => $request->subject,
            'name' => $request->name,
            'email_send' => $request->email_send,
        ];

        Mail::to($request->email)->send(new EmailSendUser($details));
        return back()->with('reply_email', 'Reply done');
    }

    //USER & ADMIN EMAIL SEND PAGE INDIVUDUAL
    public function usermessage($id){
        return view('admin.user.single_email_send_user', [
            'user'   => User::find($id),
        ]);
    }

    //EMAIL ALL USER PAGE
    public function emailalluser(){
        return view('admin.user.email_send_all_user_form', [
            'users'   => User::all(),
        ]);
    }

    //EMAIL ALL USER AT ONCE
    public function emailsendalluser(Request $request){

        $details = [
            'subject' => $request->subject,
            'email_body' => $request->email_body,
        ];

        foreach (User::all()->pluck('email') as $email) {
            Mail::to($email)->send(new EmailAllUser($details));
        }

        return back()->with('email_all_user', 'Mail Send successfully!');
    }


    /**
     * -----------------------------------------------------------------------------------------------------------------------
     * SUBSCRIBER SECTION ACTION START
     * -----------------------------------------------------------------------------------------------------------------------
     */

    //SUBSCRIBER PAGE
    public function subscriberindex(){
        $subes = Subscriber::latest()->paginate(5);
        $total_subes = Subscriber::count();
        return view('admin.user.subscriber', compact('total_subes', 'subes'));
    }

    //SUBSCRIBERS SEND EMAIL PAGE
    public function emailallsubscriber(){
        return view('admin.user.email_send_all_subscriber_form', [
            'subscribers'   => Subscriber::all(),
        ]);
    }

    //SUBSCRIBER EMAIL SEND TO MAIL FUNCTION
    public function emailsendallsubscriber(Request $request){
        $details = [
            'subject' => $request->subject,
            'email_body' => $request->email_body,
        ];

        foreach (Subscriber::all()->pluck('subscriber_email') as $email) {
            Mail::to($email)->send(new EmailAllSubscriber($details));
        }

        return back()->with('email_all_subscriber', 'Mail Send successfully!');
    }

    //SUBSCRIBER EMAIL DELETE FUNCTION
    public function subscriberdelete($id){
        Subscriber::find($id)->forceDelete();
        return back()->with('forcedelete_status', 'Your category permanently deleted!!');
    }


    /**
     * -----------------------------------------------------------------------------------------------------------------------
     * CONTACT MESSAGE SECTION ACTION START
     * -----------------------------------------------------------------------------------------------------------------------
     */

    //CONTACT MESSAGE FROM FRONTEND
    public function contactmessageshow(){
        return view('admin.messsage.index',[
            'contact_messages'      => Contact::all(),
        ]);
    }

    //CONTACT MESSAGE DELETE FROM FRONTEND
    public function contactmessagedelete($id)
    {
        Contact::find($id)->forceDelete();
        return back()->with('forcedelete_status', 'Your message permanently deleted!!');
    }

    //MESSAGE SEND TO SUBSCRIBER
    public function messagesend($id){
        return view('admin.messsage.message_reply',[
            'messages'   => Contact::find($id),
        ]);
    }

    //MESSAGE REPLY
    public function messagereply(Request $request){

        $details = [
            'email' => $request->contact_email,
            'message' => $request->reply,
        ];

        Mail::to($request->contact_email)->send(new MessageReply($details));

        Contact::find($request->id)->forceDelete();

        return redirect('/contact/message/show/')->with('reply_message', 'Reply done');
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------
     * DASHBORD PROFILE PAGE SECTION ACTION START
     * -----------------------------------------------------------------------------------------------------------------------
     */

    //DASHBORD PROFILE PAGE
    public function profile(){
        return view('admin.profile.dashbordProfile',[
            'cities'            => City::all(),
            'countries'         => Country::all(),
        ]);
    }

    //AJAX COUNTRY CHANGE TO CITY SHOW
    public function getcitylistajax(Request $request){
        $stringToSend = "";
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $stringToSend .= "<option value='" . $city->name . "'>" . $city->name . "</option>";
        }
        return $stringToSend;
    }

    //IMAGE UPDATTE IN USER TABLE
    public function profilephoto(Request $request){

        $request->validate([
            'profile_photo'  => 'required|image'
        ]);


        if ($request->hasFile('profile_photo')) {

            if (Auth::user()->profile_photo =! 'default_pic.jpg') {
                $old_photo_location = 'public/dashbord_asset/img/profile_pic/' . Auth::user()->profile_photo;
                (base_path($old_photo_location));
            }

            $uploaded_photo = $request->file('profile_photo');
            $new_photo_name = Auth::id() . "." . $uploaded_photo->getClientOriginalExtension();

            $new_photo_location = 'public/dashbord/image/profile_photo/' . $new_photo_name;
            Image::make($uploaded_photo)->resize(120, 120)->save(base_path($new_photo_location));

            User::find(Auth::id())->update([
                'profile_photo' => $new_photo_name
            ]);

            return back()->with('profile_status', 'Profile Photo Update Successfully!!');

        } else {
            return back()->with('profile_status', 'Profile Photo Does Not Found!!');
        }
    }

    //INFORMATION UPDATTE IN USER TABLE
    public function profileinfo(Request $request){

        User::find(Auth::id())->update([
            'username'          => $request->username,
            'phone'             => $request->phone,
            'dateOfBirth'       => $request->dateOfBirth,
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'profession'        => $request->profession,
        ]);
        return back()->with('profile_status', 'Information Updated Successfully!');
    }

    //ADDRESS UPDATTE IN USER TABLE
    public function addressstore(Request $request){
        User::find(Auth::id())->update([
            'fullAddress'          => $request->fullAddress,
            'country_list'         => $request->country_list,
            'city_list'            => $request->city_list,
        ]);
        return back();
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------
     * NEWS LETTER SECTION ACTION END
     * -----------------------------------------------------------------------------------------------------------------------
     */

    //Mail for subscriber
    public function newsLetterForsSubscriber(Request $request){

        $subscriber = new Subscriber();
        $subscriber->subscriber_email = $request->subscriber_email;
        $subscriber->save();

        //Mail::to($request->subscriber_email)->send(new SubscriberMail());

        return response()->json(['status' => 'Thanks For Subscribe']);
    }


}

