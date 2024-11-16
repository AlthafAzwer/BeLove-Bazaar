@extends('layouts.user')

@section('content')
    <!-- Inline CSS for styling -->
    <style>
        /* General styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* Banner styling */
        .banner {
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .banner img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .banner .shop-now {
            background-color: #e53e3e;
            color: white;
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Category section styling */
        .category-section {
            text-align: center;
            margin-bottom: 3rem;
        }
        .category-section h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .category-card {
            width: 140px;
            text-align: center;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            cursor: pointer;
        }
        .category-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
        }

        /* Product section styling */
        .products-section {
            text-align: center;
            margin-bottom: 3rem;
        }
        .products-section h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .product-list {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .product-card {
            width: 220px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
        }
        .product-card .price {
            color: #e53e3e;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .view-all-products {
            display: inline-block;
            background-color: #e53e3e;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            margin-top: 1rem;
        }
        .view-all-products:hover {
            background-color: #c53030;
        }

        /* Our Story Section */
        .our-story {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 0;
            gap: 2rem;
            text-align: left;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }
        .our-story .text-content {
            max-width: 60%;
            line-height: 1.7;
            color: #333;
        }
        .our-story h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
        .our-story img {
            width: 35%;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }
        @media (max-width: 768px) {
            .our-story {
                flex-direction: column;
                text-align: center;
            }
            .our-story img {
                width: 70%;
                margin-top: 1.5rem;
            }
        }

        /* Footer Section */
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

    <!-- Banner Section -->
    <div class="banner">
        <img src="{{ asset('images/banner.jpg') }}" alt="Latest Arrivals">
    </div>

    <!-- Category Section -->
    <div class="category-section">
        <h2>Browse By Category</h2>
        <div class="categories">
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/electronics.jpg') }}" alt="Electronics">
                <p>Electronics</p>
            </a>
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/furniture.jpg') }}" alt="Furniture">
                <p>Furniture</p>
            </a>
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/camera.jpg') }}" alt="Camera">
                <p>Camera</p>
            </a>
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/toys.jpg') }}" alt="Toys">
                <p>Toys</p>
            </a>
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/fashion.jpeg') }}" alt="Fashion">
                <p>Fashion</p>
            </a>
            <a href="{{ route('products') }}" class="category-card">
                <img src="{{ asset('images/sports.jpg') }}" alt="Sports">
                <p>Sports</p>
            </a>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <h2>Hot Products</h2>
        <div class="product-list">
            <div class="product-card">
                <img src="{{ asset('images/coat.jpg') }}" alt="Product 1">
                <h3>The North Coat</h3>
                <p class="price">Rs 1800</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/bag.jpg') }}" alt="Product 2">
                <h3>Carrier Bag</h3>
                <p class="price">Rs 1200</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/speaker.jpg') }}" alt="Product 3">
                <h3>Speaker</h3>
                <p class="price">Rs 3000</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/bookshelf.jpg') }}" alt="Product 4">
                <h3>Small Bookshelf</h3>
                <p class="price">Rs 8000</p>
            </div>
        </div>
        <a href="{{ route('products') }}" class="view-all-products">View All Products</a>
    </div>

    <!-- Our Story Section -->
    <div class="our-story">
        <div class="text-content">
            <h2>Our Story</h2>
            <p>Welcome to ReLove Bazaar, where we believe that every item has a story worth sharing. Our platform was born out of a passion for sustainability and a desire to make quality second-hand goods accessible to everyone.</p>
            <p>By connecting buyers and sellers from all walks of life, we aim to give pre-loved items a new lease on life while promoting mindful consumption. Join us in creating a community that values the beauty of reuse and the power of giving things a second chance.</p>
        </div>
        <img src="{{ asset('images/story.jpg') }}" alt="Our Story">
    </div>

    <!-- Footer Section -->
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
