<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        $posts = Post::All();
        return PostResource::collection($posts);
    }

    public function show($postId){

        $post = Post::find($postId);
        return new PostResource($post);
    }

    public function store(PostRequest $request){
        $data = request()->All();
        $post=Post::create(
            ['title' => $data['title'],
              'description' => $data['description'],
              'user_id' => $data['post_creator']
            ]
        );
        return new PostResource($post);
    }
}
