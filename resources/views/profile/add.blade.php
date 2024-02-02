@extends('layouts.profile')
@section('content')

<form action="{{route('profile.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <label>Post:</label>
    <input name="text" type="text" class="form-control">
    <label>images:</label>
    <input name="image[]" type="file" class="form-control" multiple>
    <button class="form-control btn btn-success btn-sm">
        Add Post

    </button>
</form>

@endsection
