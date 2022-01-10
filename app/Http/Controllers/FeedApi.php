<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Feed;
use Illuminate\Support\Facades\Validator;

class FeedApi extends Controller
{
    public function create(Request $request)
    {
        $v=Validator::make(request()->all(),[
            'description'=>'required'
        ]);

        if($v->fails()){
            return response()->json([
                'status'=>200,
                'message'=>'fail',
                'data'=>$v->errors(),
            ]);
        }

        $feed=Feed::create([
            'description'=>$request->description,
            'user_id'=>Auth::id(),
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$feed
        ]);

    }
}
