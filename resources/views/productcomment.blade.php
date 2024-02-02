<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Comment</h1>
    <form action="{{url('/productcomment/store/'.$product->id)}}" method="post">
        @csrf
        <textarea name="comment"></textarea>
<button class="btn btn-success btn-sm">
comment
</button>
    </form>


@foreach($products as $product)
@foreach($product->comments as $pro)
<h1>{{$pro->id}}</h1>
<h1>{{$pro->comment}}</h1>


@endforeach


@endforeach


</body>
</html>
