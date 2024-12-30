<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Products</title>
    <link rel="stylesheet" href="{{ asset('css/view-all.css') }}"> <!-- Ensure CSS path is correct -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Products</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('add-products') }}">Add Product</a></li>
                <li><a href="{{ route('admin-dashboard') }}">Profile</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>All Products</h1>
        <table id="products-table" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Image</th>
                <th class="actions">Actions</th> <!-- Add class for styling -->
            </tr>
        </thead>
            <tbody>
                <!-- Products will be populated here by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Include the separated JS file -->
    <script src="{{ asset('js/view-all-products.js') }}"></script>
</body>
</html>
