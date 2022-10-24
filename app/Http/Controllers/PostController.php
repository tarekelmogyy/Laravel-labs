<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    public function index()
    {
        $allPosts = Post::All();
        //dd($allPosts);
       // $allPosts = [
           // ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Tarek', 'creation_date' => '2022-10-22'],
           // ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Adel', 'creation_date' => '2022-10-10'],
        //];
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

    public function show($postId)
    {
        $post = Post::find($postId);
        //dd($post);
        /*$arr = [
            ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Tarek', 'creation_date' => '2022-10-22','email'=>'Tarek@gmail.com'],
            ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Adel', 'creation_date' => '2022-10-10','email'=>'Adel@gmail.com'],
        ];*/
        // dd($arr);

        return  view('posts.show',[
            'post' => $post
        ]);
    }
    public function edit($postId)
    {
        $post = Post::find($postId);
        //dd($post);
        return  view('posts.edit',[
            'post' => $post
        ]);
    }

    public function store()
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
    public function update($postId)
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
