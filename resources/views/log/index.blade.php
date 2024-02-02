@extends('layouts.admin')
@section('content')








<table class="table">
  <thead>
    <tr>
      <th scope="col">user name</th>
      <th scope="col">Action</th>
      <th scope="col">Product name</th>
      <th scope="col">updated_at</th>
    </tr>
  </thead>
  <tbody>

@foreach($products as $product)
@foreach($product->users as $user)

    <tr>
      <th scope="row">{{$user->name}}</th>
      <td>@if($user->role === 'redactor') დაარედაქტირა @elseif($user->role === 'operator') დამალა @else ადმინი @endif</td>
      <td>{{$product->name}} </td>
      <td>{{$product->updated_at}}</td>
    </tr>
    @endforeach
@endforeach
  </tbody>
</table>
@endsection
