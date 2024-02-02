

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
        <a href="{{url('/main')}}">Back</a>
    </button>

    <div class="container">
    <div class="row">
        @foreach($newproducts as $product)
            <div class="col-md-4 product-card">
                <div class="card" style="border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

                    <div class="card-body">
                        <h5 class="card-title" style="color: #333; font-size: 1.2em; font-weight: bold;">{{$product->name}}</h5>
                        <p class="card-text" style="color: #666;">Price:{{$product->price}}$</p>
                        <p class="card-text" style="color: #666;">Description:{!! $product->desc !!}</p>
                        <a href="{{url('/newproductcomment/'.$product->id)}}">Comment</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
