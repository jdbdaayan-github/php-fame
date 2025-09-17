<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Fame Framework</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        background-color: #ffffff;
        padding: 40px 30px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        text-align: center;
    }

    .login-box h2 {
        color: #0b1d3a;
        margin-bottom: 25px;
        font-size: 32px;
    }

    .login-box form {
        display: flex;
        flex-direction: column;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .login-box button {
        background-color: darkblue;
        color: #fff;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .login-box button:hover {
        background-color: #0b1d3a;
    }

    .login-box .links {
        margin-top: 15px;
        font-size: 14px;
    }

    .login-box .links a {
        color: darkblue;
        text-decoration: none;
        margin: 0 5px;
    }

    .login-box .links a:hover { text-decoration: underline; }
</style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="links">
        <a href="{{ url('/register') }}">Register</a> | 
        <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
    </div>
</div>

</body>
</html>
