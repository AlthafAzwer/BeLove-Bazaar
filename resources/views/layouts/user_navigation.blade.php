<style>
    /* Global Navbar Styling */
    .navbar-top {
        background-color: #2d3748; /* Dark gray */
        color: #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 2rem;
        position: relative;
    }

    .navbar-top a {
        color: #e53e3e; /* Red for 'Post Your Ad' */
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        margin-left: 1rem;
    }

    .navbar-top a:hover {
        color: #f56565; /* Lighter red on hover */
    }

    /* Centered Slogan Styling */
    .slogan {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1rem;
        font-weight: 500;
        color: #edf2f7;
    }

    .navbar-bottom {
        background-color: #f8f9fa; /* Light background for main navigation */
        color: #2d3748;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        flex-wrap: wrap;
    }

    /* Logo Styling */
    .navbar-bottom .logo img {
        max-width: 50px; /* Adjusted size */
        max-height: 80px;
        margin-right: 10px;
    }

    .navbar-bottom .logo {
        display: flex;
        align-items: center;
    }

    /* Navigation Links */
    .navbar-bottom a {
        color: #2d3748;
        margin: 0 1rem;
        text-decoration: none;
    }

    .navbar-bottom a:hover {
        color: #e53e3e; /* Red on hover */
    }

    /* Search Bar */
    .search-bar {
        width: 100%;
        max-width: 300px;
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        color: #2d3748;
    }

    /* Icon Links */
    .navbar-icons a {
        margin-left: 1rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .navbar-icons a:hover {
        color: #e53e3e;
    }

    /* Logout Button Styling */
    .logout-button {
        background: none;
        border: none;
        color: #2d3748;
        font-size: 1rem;
        cursor: pointer;
    }

    .logout-button:hover {
        color: #e53e3e;
    }

    /* Right Side Links */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
</style>

<!-- Navbar HTML Structure -->
<div class="navbar-top">
    <!-- Left Side: Title without the logo in navbar-top -->
    <span class="text-lg font-bold">ReLove Bazaar</span>

    <!-- Centered Slogan -->
    <span class="slogan">Rediscover, Reuse, Relove</span>

    <!-- Right Side: Action Buttons -->
    <div>
        <a href="{{ route('products.create') }}">Post Your Ad</a>
        <a href="{{ route('charity.request') }}">Post Charity Request</a> <!-- Added Button -->
    </div>
</div>

<nav class="navbar-bottom">
    <!-- Left Side: Logo in Main Navigation -->
    <div class="logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/Relove logo.png') }}" alt="ReLove Bazaar Logo"> 
        </a>
    </div>

    <!-- Center: Navigation Links -->
    <div class="flex space-x-4">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('products') }}">Products</a>
        <a href="{{ route('donation.list') }}">Donation List</a>
        <a href="{{ route('user.reviews') }}">Reviews</a>

        <a href="{{ route('contact') }}">Contact</a>
    </div>

    

    <!-- Right Side: Icons and Logout -->
    <div class="navbar-right">
        <div class="navbar-icons flex space-x-3">
            <a href="{{ route('my.ads') }}" class="flex items-center space-x-2">
                <i class="fas fa-clipboard-list"></i>
                <span class="font-bold">My Ads</span>
            </a>
            <a href="{{ route('charities.index') }}" class="flex items-center space-x-2">
    <i class="fas fa-hand-holding-heart"></i> My Charities
</a>


            <a href="{{ route('seller.orders') }}" class="flex items-center space-x-2">
                <i class="fas fa-box"></i>
                <span class="font-bold">Orders</span>
            </a>

            <a href="{{ route('buyer.orders') }}" class="flex items-center space-x-2">
                <i class="fas fa-receipt"></i>
                <span class="font-bold">My Orders</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2">
                <i class="fas fa-user"></i>
                
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="logout-button" style="border: none; background: none; cursor: pointer;">
        <i class="fas fa-sign-out-alt" style="font-size: 1.5rem; color: #555;"></i>
    </button>
</form>

    </div>
</nav>
