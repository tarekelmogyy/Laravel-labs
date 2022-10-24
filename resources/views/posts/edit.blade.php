@extends('layouts.app')

@section('title') create @endsection
@section('content')
        <form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
          @csrf
          @method('PUT')
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Title</label>
              <input name="title" type="text" class="form-control" value="{{$post->title}}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <textarea name="description" type="text" class="form-control">{{$post->description}}</textarea>
              </div>
            <button type="submit" class="btn btn-success">Update Post</button>
          </form>

@endsection
