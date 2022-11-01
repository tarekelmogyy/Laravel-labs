<?php

namespace App\Http\Controllers;
use App\Jobs\PruneOldPostsJob;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests;
use App\Jobs\ProneOldPostsJob;

class PostController extends Controller
{
    //
    public function index()
    {
        ProneOldPostsJob::dispatch();
        $allPosts = Post::paginate(25);
        return view('posts.index', [
          'posts' => $allPosts
        ]);
    }
    public function create()
    {
        $allUsers = User::All();
        //dd($allUsers);
        return view(view:'posts.create', data:['allUsers'=> $allUsers]);
    }

    public function show($slug)
    {
        $post = Post::find($slug);
        //dd($post);
        return  view('posts.show',[
            'post' => $post
        ]);
    }
    public function edit($slug)
    {
        $post = Post::find($slug);
        //dd($post);
        return  view('posts.edit',[
            'post' => $post
        ]);
    }

    public function store(PostRequest $request)
    {


        //$data = $_POST;    old php native
        $data = request()->All();
        Post::create(
            ['title' => $data['title'],
              'description' => $data['description'],
              'user_id' => $data['post_creator']
            ]
        );
       return to_route('posts.index');
    }
    public function update($postId,UpdateRequest $request)
    {
        $data = request()->All();
        $post = Post::find($postId);
        $post -> update([
            'title' =>  $data['title'],
            'description' => $data['description']
        ]);
        return to_route('posts.index');
    }

    public function delete($postId)
    {
        $post = Post::find($postId);
        $post -> delete();
        return to_route('posts.index');
    }

}
