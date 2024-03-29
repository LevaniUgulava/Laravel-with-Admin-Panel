<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label, input, button, .message {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"],
        input[type="password"],
        button {
            width: calc(100% - 22px); /* Adjusted for padding and borders */
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .forgot-password {
            text-align: right;
        }
    </style>
</head>
<body>

@if(session()->has('message'))
    <div class="message">
        {{ session('message') }}
    </div>
@endif

<div class="container">
    <h2>Login Form</h2>
    <form method="POST" action="{{url('/loginn')}}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="back-link">
        <a href="{{url('/main')}}">Back</a>
    </div>

    <div class="forgot-password">
        <a href="{{route('reset')}}">Forgot Password?</a>
    </div>
</div>

</body>
</html>
