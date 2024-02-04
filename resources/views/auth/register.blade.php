<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
            display: flex;
            justify-content: space-between;
        }

        .links a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form method="POST" action="{{url('/registerr')}}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Register</button>
        </form>

            <a href="{{url('/main')}}">Back</a>
    </div>
</body>
</html>
