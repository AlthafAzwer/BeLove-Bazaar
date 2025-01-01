<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #2c3e50;
        }

        /* Container for the entire layout */
        .admin-container {
            display: flex;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #2c3e50;
            color: white;
            width: 220px;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .sidebar h2 {
            color: #ecf0f1;
            text-transform: uppercase;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: #3498db;
            color: #fff;
        }

        /* Logout button */
        .logout-link {
            color: #e74c3c;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0.5rem;
            transition: color 0.3s;
        }
        .logout-link:hover {
            color: #c0392b;
        }

        /* Main content area styling */
        .main-content {
            margin-left: 240px;
            padding: 20px;
            width: calc(100% - 240px);
        }
        .main-content h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        /* Card styles for dashboard */
        .card-container {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .card {
            background-color: white;
            padding: 20px;
            width: 220px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .card h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .card p {
            font-size: 1.5rem;
            color: #3498db;
            font-weight: bold;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            li a {
    display: block;
    color: #ffffff;
    padding: 10px;
    border-radius: 4px;
    background-color: #3498db;
    transition: background-color 0.3s ease;
}

li a:hover {
    background-color: #2980b9;
}

        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Section -->
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
    <li><a href="{{ route('admin.ads.index') }}">Manage Ads</a></li>
    <li><a href="{{ route('admin.products.index') }}">Manage Products</a></li>
    <li><a href="{{ route('admin.orders.index') }}">Manage Orders</a></li>
    <li><a href="{{ route('admin.charities') }}">Manage Charities</a></li> <!-- New Link -->
    <li>
    <a href="{{ route('admin.donations') }}">Manage Donations</a>
</li>
<li>
    <a href="{{ route('admin.reviews.index') }}">Manage Reviews</a>
</li>

<li>
    <a href="{{ route('admin.auctions.index') }}" class="btn btn-primary">
        Manage Auctions
    </a>
</li>

<li>
    <a href="{{ route('admin.manageAuctions') }}" class="btn btn-primary">
        Manage Auction Ads
    </a>
</li>

<li>
    <a href="{{ route('admin.manageBids') }}" class="btn btn-primary">
        Manage Bids
    </a>
</li>

<li>
<a href="{{ route('admin.auction_orders') }}" class="btn btn-primary">
     Manage Auction Orders
</a>

<li>
    <a href="{{ route('admin.blogs.index') }}" style="color: #ffffff; padding: 10px; text-decoration: none;">
        <span>Manage Blogs</span>
    </a>
</li>

    </li>





    
    <li>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-link">
                Logout
            </button>
        </form>
    </li>
</ul>

        </aside>

        <!-- Main Content Section -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
