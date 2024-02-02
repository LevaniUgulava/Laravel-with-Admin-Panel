@extends('layouts.profile')
@section('content')

<h1>Profile:{{auth()->user()->name}}</h1>


<form action="{{route('profile.update',$post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <label>Post:</label>
    <input name="text" type="text" class="form-control" value="{{$post->text}}">
    <label>images:</label>
    <input name="image[]" type="file" class="form-control" multiple>
    @foreach($post->postimages as $img)
    <img src="{{ asset('image/post/' . $img->image) }}" alt="Post Image" width="100px">
@endforeach

    <button class="form-control btn btn-success btn-sm">
        Edit Post
    </button>
</form>

@endsection
