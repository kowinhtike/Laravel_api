<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Resources\PostResource;
class PostController extends Controller
{
    //
    public function index(){
        return PostResource::collection(Post::all());
    }
    public function show($id){
        return new PostResource(Post::find($id));
    }

    public function store(Request $request){
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        if($post->save()){
            return response()->json([
                'success' => "Post Created Successfully",
                'data' => $post
            ]);
        }
    }

    public function update(Request $request,$id){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if($post->save()){
            return response()->json([
                'success' => "Post Updated Successfully",
                'data' => $post
            ]);
        }
    }

    public function delete($id){
        Post::find($id)->delete();

        return response()->json([
            'success' => "Post Deleted Successfully",
            'data' => []
        ]);
    }
}
