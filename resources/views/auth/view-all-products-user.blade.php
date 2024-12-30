<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Products</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> <!-- Ensure CSS path is correct -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Products</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('dashboard') }}">Profile</a></li>
                <li><a href="{{ route('user-cart') }}">Cart</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div id="products-container" class="products-container">
            <!-- Products will be populated here by JavaScript -->
        </div>
    </div>

    <!-- Include the separated JS file -->
    <script src="{{ asset('js/view-all-products-user.js') }}"></script>
</body>
</html>
