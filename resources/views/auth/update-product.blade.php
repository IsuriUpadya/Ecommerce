<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Optional: Include Bootstrap for styling -->
    <link rel="stylesheet" href="{{ asset('css/update-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
    <script src="{{ asset('js/update-product.js') }}"defer></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Update Product</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('all-products') }}">View Products</a></li>
                <li><a href="#profile-section">Profile</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
    <h2>Update Product</h2>
        <!-- Update form to include enctype="multipart/form-data" to handle file uploads -->
        <form id="update-product-form" enctype="multipart/form-data">
            @csrf
            <!-- Hidden input to store product_id, retrieved dynamically or passed from the controller -->
            <input type="hidden" id="product_id" name="product_id" value="{{ $product->product_id ?? '' }}">

            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required value="{{ $product->product_name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="qty">Quantity:</label>
                <input type="number" id="qty" name="qty" class="form-control" required value="{{ $product->qty ?? '' }}">
            </div>

            <div class="form-group">
                <label for="unitprice">Unit Price:</label>
                <input type="text" id="unitprice" name="unitprice" class="form-control" required value="{{ $product->unitprice ?? '' }}">
            </div>

            <!-- New input field for uploading an image -->
            <div class="form-group">
                <label for="product_image">Product Image:</label>
                <input type="file" id="product_image" name="product_image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <!-- Include the JavaScript file that handles the form submission -->
    
</body>
</html>
