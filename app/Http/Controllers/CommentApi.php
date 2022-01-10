<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Feed;
use App\Comment;

class CommentApi extends Controller
{
    public function create(Request $request)
    {
        $v=Validator::make(request()->all(),[
            'feed_id'=>'required',
            'comment'=>'required',
        ]);

        if($v->fails()){
            return response()->json([
                'status'=>200,
                'message'=>'failed',
                'data'=>$v->errors(),
            ]);
        }

        $user_id=Auth::id();
        $feed_id=$request->feed_id;
        $comment=$request->comment;
        $comment=Comment::create([
            'user_id'=>$user_id,
            'feed_id'=>$feed_id,
            'comment'=>$comment,
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$comment,
        ]);
    }

    public function getcomment(Request $request)
    {
        $v=Validator::make(request()->all(),[
            'feed_id'=>'required'
        ]);
        if($v->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'fails',
                'data'=>$v->errors(),
            ]);
        }

        $feed_id=$request->feed_id;
        $comments=Feed::find($feed_id)->comment;
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$comments,
        ]);
    }

    public function deletecomment(Request $request)
    {
        $v=Validator::make(request()->all(),[
            'comment_id'=>'required'
        ]);
        if($v->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'fails',
                'data'=>$v->errors(),
            ]);
        }

        $comment_id=$request->comment_id;
        Comment::where('id',$comment_id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>null
        ]);
    }
}
