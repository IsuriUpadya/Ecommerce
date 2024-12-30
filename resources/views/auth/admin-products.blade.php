<!-- admin-products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}"> <!-- Link to your CSS -->
    <!-- <script src="{{ asset('js/dashboard.js') }}" defer></script> JavaScript file -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Products</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('add-products') }}">Add Product</a></li>
                <li><a href="{{ url('/view-products') }}">View All Products</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li> <!-- Logout Button -->
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
        <h2>Welcome to Products</h2>
        <!-- Placeholder for content -->
        <div class="tab-content" id="v-pills-tabContent">
            @yield('content')  <!-- This line will embed content based on which page (add or view products) is accessed -->
        </div>
    </div>
</body>
</html>
