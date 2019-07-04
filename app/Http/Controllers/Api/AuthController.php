<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name'=> 'required|max:55',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'
        ]);

        $validatedData['password']= bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=>$user,'accessToken'=>$accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);

        if(!auth()->attempt($loginData))
         {
            return response(['message'=>'Please try some valid credentials']);
         }
        
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user'=>auth()->user(), 'accessToken'=>$accessToken]);
    }

    public function update(Request $request)
    {

        $user = User::find(3);

        $user->posts()->whereId(1)->update(['title'=>"updated title",'description'=>'Coding is good']);

    foreach ($user->posts as $post){
        
        echo $post->title.': '.$post->description;
    }
}


}
