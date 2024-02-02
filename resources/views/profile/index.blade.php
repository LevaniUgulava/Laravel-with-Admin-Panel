@extends('layouts.profile')
@section('content')

<h1>Profile:{{auth()->user()->name}}</h1>
<div class="container mt-4">
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Post</h5>
                        <p class="card-text">{{ $post->text }}</p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($post->postimages as $image)
                                <div class="col-md-6">
                                    <img src="{{ asset('image/post/' . $image->image) }}" class="img-fluid mb-2" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
    <form action="{{ route('profile.destroy', $post->id) }}" method="POST" onsubmit='return confirm("Delete post?")'>
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm mr-2">Delete</button>
    </form>

    <a href="{{route('profile.edit',$post->id)}}" class="btn btn-warning btn-sm">Edit</a>
</div>


        @endforeach
    </div>
</div>

@endsection
