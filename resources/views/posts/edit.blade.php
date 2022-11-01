@extends('layouts.app')

@section('title') create @endsection
@section('content')
<div class="container">
        <form method="POST" action="{{route('posts.update',['post' => $post->slug])}}">
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
</div>
@if ($errors->any())
    <div class="alert alert-success mt-2 container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
