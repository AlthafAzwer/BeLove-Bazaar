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
        max-width: 50px; 
        max-height: 50px;
        margin-right: 10px;
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
        <a href="{{ route('donation.list') }}">Donation List</a>
        <a href="{{ route('user.reviews') }}">Reviews</a>
        <a href="{{ route('auctions.index') }}">Auctions</a>
        <!-- Add your new pages here -->
  
        
    </div>

    <!-- Right: Icon Links / Profile / Logout -->
    <div class="navbar-icons">

    <!-- CHATS -->
<a href="{{ route('messages.index') }}">
    <i class="fas fa-comments"></i>
    <span>Chats</span>
</a>

        <!-- MY ADS -->
        <a href="{{ route('my.ads') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>My Ads</span>
        </a>
        <!-- MY CHARITIES -->
        <a href="{{ route('charities.index') }}">
            <i class="fas fa-hand-holding-heart"></i>
            <span>My Charities</span>
        </a>
        <!-- MY AUCTIONS -->
        <a href="{{ route('auctions.my') }}">
            <i class="fas fa-gavel"></i>
            <span>My Auctions</span>
        </a>
        <!-- MY BIDS -->
        <a href="{{ route('bids.myBids') }}">
            <i class="fas fa-hand-holding-usd"></i>
            <span>My Bids</span>
        </a>
        <!-- AUCTION ORDERS -->
        <a href="{{ route('auction_orders.index') }}">
            <i class="fas fa-gavel"></i>
            <span>Auction Orders</span>
        </a>
        <!-- ORDERS -->
        <a href="{{ route('seller.orders') }}">
            <i class="fas fa-box"></i>
            <span>Orders</span>
        </a>
        <!-- MY ORDERS -->
        <a href="{{ route('buyer.orders') }}">
            <i class="fas fa-receipt"></i>
            <span>My Orders</span>
        </a>
        <!-- PROFILE -->
        <a href="{{ route('profile.edit') }}">
            <i class="fas fa-user"></i>
        </a>
        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt" style="font-size: 1.3rem;"></i>
            </button>
        </form>
    </div>
</nav>
