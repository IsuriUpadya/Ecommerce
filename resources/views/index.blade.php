<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Store</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}"> <!-- Link to your CSS -->
    <script src="{{ asset('js/app.js') }}" defer></script> <!-- Link to your JavaScript -->
</head>
<body>
    <div class="container">
        <h2>Welcome to Our Store</h2>
        <p>Your one-stop shop for amazing products!</p>
        
        <div class="button-container">
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('user-register') }}" class="btn">Register</a>
        </div>
        
        <footer>
            <p>2024 eCommerce Store</p>
        </footer>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
