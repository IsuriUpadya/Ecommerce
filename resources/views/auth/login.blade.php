<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="{{ asset('js/login.js') }}" defer></script> <!-- JavaScript file -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}"> <!-- Link to alert styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Optional CSS -->
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('user-register') }}">Don't have an account? Register here</a>
    </div>
</body>
</html>
