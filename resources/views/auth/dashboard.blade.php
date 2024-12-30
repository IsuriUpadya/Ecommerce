<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> <!-- Link to your CSS -->
    <script src="{{ asset('js/dashboard.js') }}" defer></script> <!-- JavaScript file -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">Dashboard</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('user-all-products') }}">Products</a></li>
                <li><a href="#profile-section">Profile</a></li>
                <li><a href="#cart-section">Cart</a></li>
                <li><a href="{{ route('login') }}" id="logout-btn" class="btn">Logout</a></li> <!-- Logout Button -->
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
        <h2>Welcome to Your Dashboard</h2>

        <!-- Profile Section -->
        <section id="profile-section">
            <!-- <h3>Profile</h3> -->
            <p><strong>Name:</strong> <span id="profile-name">John Doe</span></p>
            <p><strong>Email:</strong> <span id="profile-email">johndoe@example.com</span></p>
        </section>

    </div>
</body>
</html>
