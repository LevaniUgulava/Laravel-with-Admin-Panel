@extends('layouts.admin')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">პროდუქცია</h1>
    <a href="{{url('/product/add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> დამატება</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->desc}}</td>
      <td>{{$product->price}}$</td>
      <td>
        @foreach($product->images as $img)
<img src="{{asset('image/product/' . $img->image)}}" width="100px" height="100px">
        @endforeach
      </td>
      <td>
      @can('viewSome',App\Models\Product::class)

      <div class="d-flex">
    <a href="{{ route('product.edit', $product) }}" class="btn btn-success btn-sm me-2">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endcan
@can('before',App\Models\Product::class)
    <form action="" method="POST">

        <button class="btn btn-danger btn-sm">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>
@endcan
    @can('viewAny',App\Models\Product::class)

    @if($product->active === 1)
    <form action="{{url('/isactive/'.$product->active)}}">
        <button class="btn btn-warning btn-sm">
    <i class="fa-solid fa-eye"></i>
    </button>
    </form>
    @else
    <form action="{{url('/isactive/'.$product->active)}}">
        <button class="btn btn-warning btn-sm">
    <i class="fa-solid fa-eye"></i>
    </button>
    @endif

    @endcan

</div>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>



@endsection
