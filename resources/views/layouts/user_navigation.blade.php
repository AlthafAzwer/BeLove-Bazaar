<style>
    /* ========== TOP ACTION BAR STYLING ========== */
    .navbar-top {
        background-color: #2d3748; /* Dark gray */
        color: #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 2rem;
        position: relative;
    }
    .navbar-top .navbar-top-left {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .navbar-top-left span {
        color: #edf2f7; /* White-ish text */
    }
    .navbar-top-right a {
        color: #e53e3e; /* Red for 'Post' items */
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        margin-left: 1rem;
    }
    .navbar-top-right a:hover {
        color: #f56565; /* Lighter red on hover */
    }
    .slogan {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1rem;
        font-weight: 500;
        color: #edf2f7;
    }

    /* ========== MAIN NAVBAR STYLING ========== */
    .navbar-bottom {
        background-color: #f8f9fa; /* Light background for main navigation */
        color: #2d3748;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        flex-wrap: wrap;
        box-shadow: 0 2px 3px rgba(0,0,0,0.05);
    }
    /* LOGO */
    .navbar-bottom .logo img {
        max-width: 60px; 
        max-height: 60px;
        margin-right: 10px;
        border: 2px solid #2d3748;
        border-radius: 50%;
        padding: 5px;
    }
    .navbar-bottom .logo {
        display: flex;
        align-items: center;
    }
    /* NAV LINKS (LEFT-CENTER) */
    .nav-links {
        display: flex;
        gap: 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
    }
    .nav-links a {
        color: #2d3748;
        text-decoration: none;
        transition: color 0.2s;
    }
    .nav-links a:hover {
        color: #e53e3e; /* Red on hover */
    }
    /* ICON LINKS (RIGHT SIDE) */
    .navbar-icons {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .navbar-icons a {
        color: #2d3748;
        display: flex;
        align-items: center;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        gap: 0.3rem;
        transition: color 0.2s;
    }
    .navbar-icons a:hover {
        color: #e53e3e;
    }
    /* DROPDOWN MENU */
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f8f9fa;
        min-width: 200px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }
    .dropdown-content a {
        color: #2d3748;
        text-decoration: none;
        display: block;
        padding: 0.5rem;
        transition: background-color 0.2s;
    }
    .dropdown-content a:hover {
        background-color: #e2e8f0;
    }
    /* LOGOUT BUTTON */
    .logout-button {
        background: none;
        border: none;
        color: #2d3748;
        font-size: 1rem;
        cursor: pointer;
        transition: color 0.2s;
    }
    .logout-button:hover {
        color: #e53e3e;
    }
</style>

<!-- ========== TOP ACTION BAR ========== -->
<div class="navbar-top">
    <div class="navbar-top-left">
        <span>ReLove Bazaar</span>
    </div>
    <!-- Centered Slogan -->
    <span class="slogan">Rediscover, Reuse, Relove</span>

    <!-- Right side: Action Buttons -->
    <div class="navbar-top-right">
        <a href="{{ route('products.create') }}">Post Your Ad</a>
        <a href="{{ route('charity.request') }}">Post Charity Request</a>
        <a href="{{ route('auctions.create') }}">Post Auction</a>
    </div>
</div>

<!-- ========== MAIN NAVIGATION BAR ========== -->
<nav class="navbar-bottom">
    <!-- Left: Logo -->
    <div class="logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/Relove logo.png') }}" alt="ReLove Bazaar Logo">
        </a>
    </div>

    <!-- Center: Main Nav Links -->
    <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('products') }}">Products</a>
        <a href="{{ route('auctions.index') }}">Auctions</a>
        <a href="{{ route('donation.list') }}">Donation List</a>
        <a href="{{ route('user.reviews') }}">Reviews</a>
        <a href="{{ route('blogs.index') }}">Blogs</a>
    </div>

    <!-- Right: My Account Dropdown / Profile / Logout -->
    <div class="navbar-icons">
        <a href="{{ route('messages.index') }}">
            <i class="fas fa-comments"></i>
            <span>Chats</span>
        </a>

        <a href="{{ route('personalized.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Personalized Dashboard</span>

        
        <div class="dropdown">
            <a href="#"><i class="fas fa-user"></i> My Account</a>
            <div class="dropdown-content">
                <a href="{{ route('my.ads') }}">My Ads</a>
                <a href="{{ route('charities.index') }}">My Charities</a>
                <a href="{{ route('auctions.my') }}">My Auctions</a>
                <a href="{{ route('bids.myBids') }}">My Bids</a>
                <a href="{{ route('buyer.auction_orders.index') }}">My Auction Orders</a>
                <a href="{{ route('auction_orders.index') }}">Auction Orders</a>
                <a href="{{ route('buyer.orders') }}">My Orders</a>
                <a href="{{ route('seller.orders') }}">Orders</a>
                

                
            </div>
        </div>
        <a href="{{ route('profile.edit') }}">
            <i class="fas fa-user-cog"></i>
            <span>Profile</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</nav>
