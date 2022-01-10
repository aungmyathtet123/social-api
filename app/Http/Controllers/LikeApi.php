<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;
class LikeApi extends Controller
{
    public function like(Request $request)
    {
        $feed_id=$request->feed_id;
        $user_id=Auth::id();
        if(!$this->islike($user_id,$feed_id)){
            $like=Like::create([
                'feed_id'=>$feed_id,
                'user_id'=>$user_id
            ]);
            return response()->json([
                'status'=>200,
                'message'=>'success',
                'data'=>$like,
            ]);
        }

        return response()->json([
            'status'=>200,
                'message'=>'fail',
                'data'=>'already like',
        ]);

    }

    public function islike($user_id,$feed_id)
    {
       $like=Like::where('user_id',$user_id)
                    ->where('feed_id',$feed_id)
                    ->count();
           if($like){
               return true;
           }
           return false;
    }

    public function dislike(Request $request)
    {
       $like_id=$request->like_id;
       Like::where('id',$like_id)->delete();
       return response()->json([
           'status'=>200,
           'message'=>'success',
           'data'=>null,
       ]);
    }
}
