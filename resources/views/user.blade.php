

@extends('layouts.admin')
@section('content')


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>



    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        redactor
@if($user->role === 'redactor')
<form action="{{url('/user/role/'.$user->id)}}" method="post">
    @csrf
<button class="btn btn-success btn-sm">
    <i class="fa-solid fa-user-pen"></i>
</button>
</form>
@else
<form action="{{url('/user/rolee/'.$user->id)}}" method="post">
    @csrf
<button class="btn btn-danger btn-sm">
    <i class="fa-solid fa-user-pen"></i>
</button>
</form>
@endif

operator
@if($user->role === 'operator')
<form action="{{url('/user/roleop/'.$user->id)}}" method="post">
    @csrf
<button class="btn btn-success btn-sm">
<i class="fa-solid fa-user"></i></button>
</form>
@else
<form action="{{url('/user/roleoop/'.$user->id)}}" method="post">
    @csrf
<button class="btn btn-danger btn-sm">
<i class="fa-solid fa-user"></i>
</button>
</form>
@endif
      </td>



    </tr>
    @endforeach
  </tbody>
</table>



@endsection
