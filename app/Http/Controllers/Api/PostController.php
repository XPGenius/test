<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\Post as PostResource;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get posts
        $posts = Post::paginate(15);

        //Return collection of posts as resources

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->isMethod('put') ? Post::findOrFail($request->post_id) : new Post;
        
        $post->id = $request->input('post_id');
        $post->user_id = $request->input('post_user_id');
        $post->title = $request->input('post_title');
        $post->description = $request->input('post_description');

        if($post->save()){
            return new PostResource($post);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get a post
        $post = Post::findOrFail($id);

        return new PostResource ($post);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get a post
        $post = Post::findOrFail($id);

        if($post->delete()){
            return new PostResource ($post);
        }
    }
}
