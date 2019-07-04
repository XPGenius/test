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

Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::post('/up','Api\AuthController@update');

Route::post('create', function(){

	$user = User::findOrFail(3);

	$user->posts()->save(new Post(['title'=>'Laravel homestead', 'description'=>'Think before you code']));
	 

});

Route::get('list',function(){

	$user = User::findOrFail(3);

	foreach ($user->posts as $post) {
		
		echo $post->title. ': '.$post->description;
	}
});


Route::post('update',function(){

	$user = User::find(3);

	$user->posts()->whereId(1)->update(['title'=>"updated title",'description'=>'Coding is good']);

	return 'Your post was updated';
});

Route::get('delete',function(){

	$user = User::find(3);

	$user->posts()->whereId(2)->delete();

		return 'Your post was deleted';
});
