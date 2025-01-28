@extends('layouts.user')

@section('content')
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* Header Styling */
        .products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 2rem 0;
            flex-wrap: wrap;
        }
        .filter-group, .search-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .category-select, .sort-select, .location-select, .search-bar input {
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
            font-size: 1rem;
        }
        .filter-group button {
            background-color: #e53e3e;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .filter-group button:hover {
            background-color: #c53030;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .product-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .product-card h3 {
            font-size: 1.2rem;
            color: #333;
            margin: 0.5rem 0;
        }
        .product-card .price {
            color: #e53e3e;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .product-card .buy-now-btn {
            display: inline-block;
            background-color: #e53e3e;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            margin-top: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .product-card .buy-now-btn:hover {
            background-color: #c53030;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
        }

        /* Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        .pagination .page-link {
            color: #e53e3e;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            margin: 0 0.3rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: #e53e3e;
            color: #fff;
        }
        .pagination .active .page-link {
            background-color: #e53e3e;
            color: #fff;
            border-color: #e53e3e;
        }

        .footer {
            background-color: #1a202c;
            color: #edf2f7;
            padding: 2rem 0;
            display: flex;
            justify-content: space-around;
            text-align: center;
            flex-wrap: wrap;
        }
        .footer h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .footer .footer-section {
            flex: 1;
            margin: 1rem;
        }
        .footer a {
            color: #edf2f7;
            text-decoration: none;
        }
        .footer a:hover {
            color: #e53e3e;
        }
    </style>

    <div class="products-header">
        <!-- Filter and Sorting Form -->
        <form action="{{ route('products') }}" method="GET" class="filter-group">
            <!-- Category Selection -->
            <select name="category" class="category-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <!-- Location Selection -->
            <select name="location" class="location-select">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                        {{ $location }}
                    </option>
                @endforeach
            </select>

            <!-- Sort by Price -->
            <select name="sort" class="sort-select">
                <option value="">Sort by</option>
                <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price - Lowest to Highest</option>
                <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price - Highest to Lowest</option>
            </select>

            <!-- Search Bar -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="What are you looking for?" class="search-bar">
            
            <!-- Submit Button -->
            <button type="submit">Filter</button>
        </form>
    </div>

    <!-- Product Listing -->
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}" alt="{{ $product->title }}">
                <h3>{{ $product->title }}</h3>
                <p class="price">Rs {{ $product->price }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="buy-now-btn">View Product</a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $products->links() }}
    </div>

    <footer class="footer">
        <div class="footer-section">
            <h4>Exclusive</h4>
            <p>Signup</p>
            <form>
                <input type="email" placeholder="Enter your email">
                <button type="submit">→</button>
            </form>
        </div>
        <div class="footer-section">
            <h4>Support</h4>
            <p>Union Place, Apiit</p>
            <p>relovebazaar@gmail.com</p>
            <p>0764740651</p>
        </div>
        <div class="footer-section">
            <h4>Account</h4>
            <p><a href="#">My Account</a></p>
            <p><a href="#">Login / Register</a></p>
            <p><a href="#">Cart</a></p>
            <p><a href="#">Wishlist</a></p>
        </div>
        <div class="footer-section">
            <h4>Quick Links</h4>
            <p><a href="#">Products</a></p>
            <p><a href="#">Donation List</a></p>
            <p><a href="#">Blog</a></p>
            <p><a href="#">Contact</a></p>
        </div>
    </footer>
@endsection
