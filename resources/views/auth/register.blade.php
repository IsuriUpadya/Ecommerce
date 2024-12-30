<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
    <script src="{{ asset('js/register.js') }}" defer></script> <!-- Link to the new JS file -->
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="register-form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <a href="{{ route('login') }}">Already have an account? Login here</a>
    </div>
</body>
</html>
