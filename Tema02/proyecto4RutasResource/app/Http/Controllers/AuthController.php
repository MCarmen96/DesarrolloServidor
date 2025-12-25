<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\User;
class AuthController extends Controller
{
    //

    public function login(Request $request){

        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Unathorized'],401);
        }
        $token=$request->user()->createToken('auth_token')->plainTextToken;
        return response()->json(['acces__token'=>$token,'token_type'=>'Bearer']);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message'=>'logged out']);
    }

}
