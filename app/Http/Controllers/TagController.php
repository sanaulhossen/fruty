<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Tag;

class TagController extends Controller
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
        return view('admin.tag.index',[
            'tags'    =>Tag::all(),
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
            'tag_name' =>'unique:tags,tag_name'
        ]);

        Tag::insert($request->except('_token',) + [
            'created_at'    =>Carbon::now(),
            'user_id'       =>Auth::id(),
        ]);
        return back()->with('success_status','Your Tag added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.tag.edit',[
            'tag_info' => Tag::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        Tag::find($tag->id)->update([
            'tag_name'   =>$request->tag_name,
            'tag_description'   =>$request->tag_description
        ]);
        return back()->with('success_status','Tag Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('delete_status','Product deleted Successfully!');
    }

    public function addproduct ()
    {
        return view('admin.tag.add',[
            'tags'    =>Tag::all(),
        ]);
    }
}
