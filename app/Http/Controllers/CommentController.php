<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Comment;


class CommentController extends Controller
{

    //COMMENT DATA STROE
    public function commentstore(Request $request){

        $validator = Validator::make($request->all(), [
            'name'          => 'required|unique:comments,name',
            'comment'       => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $comment = new Comment();
            $comment->name = $request->input('name');
            $comment->comment = $request->input('comment');
            $comment->save();

            return response()->json([
                'status' => 200,
                'message' => 'Thanks for your response.'
            ]);
        }
    }

    //COMMENT DATA
    public function commentdata(){
        $comment = Comment::all();
        return response()->json([
            'comment'  => $comment,
        ]);
    }
}
