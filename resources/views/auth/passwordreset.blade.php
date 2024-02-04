<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
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

        label, input {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"] {
            width: calc(100% - 22px); /* Adjusted for padding and borders */
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            width: calc(100% - 22px);
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #007bff;
        }

        button:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }

        .links {
            margin-top: 10px;
            text-align: center;
        }

        .links a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset</h2>
        <form method="POST" action="{{route('reset.pass')}}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <div class="links">
            <a href="{{url('/main')}}">Back to Main</a>
        </div>
    </div>
</body>
</html>
