<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthApi extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make(request()->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        if($v->fails()) {
            return response()->json([
                'status'=>500,
                'message'=>'fail',
                'data'=>$v->errors(),
            ]);
        }
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        // $image=$request->image;
        // $image_name=uniqid().$image->getClientOriginalName();
        // $image->move('/images',$image_name);



        $user=User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>bcrypt($password),

        ]);

        $token=$user->createToken('social')->accessToken;

        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$user,
            'token'=>$token
        ]);
    }

    public function login(Request $request)
    {
        $v= Validator::make(request()->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($v->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'fail',
                'data'=>$v->errors(),
            ]);
        }
        $email=$request->email;
        $password=$request->password;

        $cre=['email'=>$email,'password'=>$password];
        if(Auth::attempt($cre)){
            $user=Auth::user();
            $token=$user->createToken('social')->accessToken;
            return response()->json([
                'status'=>200,
                'message'=>'success',
                'data'=>$user,
                'token'=>$token,
            ]);
        }
        return response()->json([
            'status'=>500,
            'message'=>'fail',
            'data'=>[
                'error'=>'email and password does not match'
            ],
        ]);
    }
}
