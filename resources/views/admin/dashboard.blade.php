@extends('layouts.admin')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        p {
            color: #7f8c8d;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Card container styling */
        .card-container {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        /* Card styling */
        .card {
            background: #ecf0f1;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 1.5rem;
            color: #34495e;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
            margin: 0;
        }
    </style>

    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin panel. Use the navigation on the left to manage users, products, and orders.</p>

    <div class="card-container">
        <!-- Total Users -->
        <div class="card">
            <h3>Total Users</h3>
            <p>{{ $totalUsers }}</p>
        </div>
        <!-- Total Products -->
        <div class="card">
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
        <!-- Total Orders -->
        <div class="card">
            <h3>Total Orders</h3>
            <p>{{ $totalOrders }}</p>
        </div>
    </div>
@endsection
