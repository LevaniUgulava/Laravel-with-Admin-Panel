

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .product-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <button>
        <a href="{{url('/login')}}">Login</a>
    </button>
    <button>
        <a href="{{url('/register')}}">Register</a>
    </button>

    <button>
        <a href="{{url('/newproducts')}}">new product</a>
    </button>



    <div class="container">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 product-card">
                <div class="card" style="border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                @foreach($product->images as $image)
                    <img class="card-img-top" src="{{asset('image/product/' . $image->image)}}" alt="Card image cap" style="border-top-left-radius: 10px; border-top-right-radius: 10px; width:100px">
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title" style="color: #333; font-size: 1.2em; font-weight: bold;">{{$product->name}}</h5>
                        <p class="card-text" style="color: #666;">Price:{{$product->price}}$</p>
                        <p class="card-text" style="color: #666;">Description:{!! $product->desc !!}</p>
                        <a href="{{url('/productcomment/'.$product->id)}}">Comment</a>

                        <form method="POST" action="{{url('/delete/'.$product->id)}}" onclick="return confirm('You Want to Delete?')">
                        @csrf
                         @method('DELETE')
                        <button class="btn btn-danger btn-sm" >
                        delete
                        </button>
                        </form>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
