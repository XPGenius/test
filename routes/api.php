<?php

use Illuminate\Http\Request;
use App\Post;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// to register the new user
Route::post('/register','Api\AuthController@register');

// to login the user
Route::post('/login','Api\AuthController@login');
//to create the post
Route::post('/post','Api\PostController@store');

//to update the post
Route::put('/post','Api\PostController@store');

//to list all the posts
Route::get('lists','Api\PostController@index');

//to get a single post
Route::get('list/{id}','Api\PostController@show');

//to delete the post
Route::delete('delete/{id}','Api\PostController@destroy');
