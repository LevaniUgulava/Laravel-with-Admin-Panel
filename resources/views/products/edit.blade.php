@extends('layouts.admin')
@section('content')@if(session()->has('message'))
<div class="form-control">
    <div class="alert alert-success">
        {{session('message')}}
    </div>
</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">რედაქტირება</h1>

</div>

<form method="POST" action="{{url('/product/update/'.$product->id)}}" enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
<input type="text" name="name" class="form-control" value="{{$product->name}}">
<label>Description:</label>
<textarea name="desc" class="form-control">{{$product->desc}}</textarea>
<label>Price:</label>
<input name="price" type="number" class="form-control" value="{{$product->price}}">
<label>Image:</label><br>
@foreach($product->images as $img)
<img src="{{asset('image/product/' . $img->image)}}" width="100px" height="100px">
        @endforeach
<input name="image" type="file" class="form-control" >

<button class="btn btn-success btn-sm form-control">
დამატება
</button>

</form>
<button>
    <a href="{{url('/product')}}">Back</a>

</button>
@endsection
