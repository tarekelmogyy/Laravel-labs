@extends('layouts.app')

@section('title') Index @endsection
@section('content')
<div class="text-center">
  <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
      <tr>
        <td>{{$post['id']}}</th>
        <td>{{$post['title']}}</td>
        @if($post->user)
        <td>{{$post->user->name}}</td>
        @else
        <td>Not defined </td>
        @endif
        <td>{{$post->created_at}}</td>
        <td>
            <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
            {{-- <a href="{{route('posts.show', ['post' =>$post['id']])}}" class="btn btn-info">View</a> --}}
            <a href="{{route('posts.edit', ['post' =>$post['id']])}}" class="btn btn-primary">Edit</a>
            <form style="display:inline;" method="POST" action="{{route('posts.destroy',['post' => $post->id])}}">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Do you want to delete?')" class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
