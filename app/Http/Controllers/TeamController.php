<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    //DATA TRAM SECTION
    public function teamdata(){
        $team = Team::all();
        return response()->json([
            'team'  => $team,
        ]);
    }

    //TEAM INDEX SECTION
    public function teamindex(){
        return view('admin.about.team_index');
    }

    //TEAM STORE SECTION
    public function teamstore(Request $request){
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'position'      => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $team = new Team;
            $team->name = $request->input('name');
            $team->position = $request->input('position');

            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('dashbord/image/team_image/', $filename);
                $team->image = $filename;
            }
            $team->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team Data Added Successfully.'
            ]);
        }
    }

    //TEAM EDIT SECTION
    public function teamedit($id){
        $team = Team::find($id);
        if ($team) {
            return response()->json([
                'status' => 200,
                'team' => $team
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Team not found.'
            ]);
        }
    }

    //Team UPDATE SECTION
    public function teamupdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'position'      => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $team = Team::find($id);
            if ($team) {
                $team->name = $request->input('name');
                $team->position = $request->input('position');

                if ($request->hasFile('image')) {
                    $path = 'dashbord/image/team_image/'. $team->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('dashbord/image/team_image/', $filename);
                    $team->image = $filename;
                }
                $team->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Team Data Updated Successfully.'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Team Data Not Found'
                ]);
            }
        }
    }

    //DELETE TEAM SECTION
    public function teamdelete($id){
        $team = Team::find($id);
        if ($team) {

            $path = 'dashbord/image/team_image/' . $team->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
            $team->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Team Deleted Successfully!'
            ]);

        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Team data not found.'
            ]);
        }
    }
}
