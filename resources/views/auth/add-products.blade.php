<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/add-products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Add Product</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('all-products') }}">View Products</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
        <h2>Add Product</h2>
        <!-- The form now matches the names expected by the controller and request -->
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="unitprice">Unit Price:</label>
                <input type="text" id="unitprice" name="unitprice" required>
            </div>

            <div class="form-group">
                <label for="qty">Quantity:</label>
                <input type="number" id="qty" name="qty" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image (optional):</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn">Add Product</button>
        </form>
    </div>

    <!-- Include your JavaScript files -->
    <script src="{{ asset('js/submit-product.js') }}"></script>
</body>
</html>
