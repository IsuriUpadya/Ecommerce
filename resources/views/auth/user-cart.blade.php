<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}"> <!-- Ensure CSS path is correct -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">User Cart</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('dashboard') }}">Profile</a></li>
                <li><a href="{{ route('user-cart') }}">Cart</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Products</h1>
        <table id="cart-table" border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Cart items will be populated here by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Include the separated JS file -->
    <script src="{{ asset('js/user-cart.js') }}"></script>
</body>
</html>
