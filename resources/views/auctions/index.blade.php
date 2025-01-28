@extends('layouts.user')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
        color: #333;
    }

    /* Search Bar Styles */
    .search-form {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .search-input {
        width: 70%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px 0 0 5px;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .search-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .search-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 0 5px 5px 0;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .search-btn:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
        cursor: pointer;
    }

    /* Auction Card Styles */
    .auction-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
    }

    .auction-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .auction-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .auction-body {
        padding: 15px;
    }

    .auction-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #222;
    }

    .auction-info {
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #555;
    }

    .place-bid-btn {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 0.6rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .place-bid-btn:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }

    @media (min-width: 768px) {
        .auction-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .auction-card {
            flex: 1 1 calc(33.333% - 20px);
        }
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

<div class="container">
    <h1>Live Auctions</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('auctions.index') }}" class="search-form">
        <input 
            type="text" 
            name="search" 
            class="search-input" 
            placeholder="Search auctions by title or category..." 
            value="{{ request('search') }}">
        <button type="submit" class="search-btn">Search</button>
    </form>

    @if($auctions->isEmpty())
        <p class="text-center text-muted">No auctions are live at the moment. Please check back later.</p>
    @else
        <div class="auction-card-container">
            @foreach($auctions as $auction)
                <div class="auction-card">
                    <div class="auction-image">
                        <img src="{{ asset('storage/' . (json_decode($auction->images, true)[0] ?? 'placeholder.jpg')) }}" alt="{{ $auction->title }}">
                    </div>
                    <div class="auction-body">
                        <h3 class="auction-title">{{ $auction->title }}</h3>
                        <p class="auction-info"><strong>Category:</strong> {{ $auction->category }}</p>
                        <p class="auction-info"><strong>Start Bid:</strong> Rs {{ number_format($auction->start_bid, 2) }}</p>
                        <p class="auction-info"><strong>Max Bid:</strong> Rs {{ number_format($auction->max_bid, 2) }}</p>
                        <p class="auction-info"><strong>Auction Ends At:</strong> {{ \Carbon\Carbon::parse($auction->end_time)->format('d M Y, h:i A') }}</p>
                        <a href="{{ route('auctions.placeBid', $auction->id) }}" class="place-bid-btn">Place Bid</a>

                        <!-- "Message" Button  -->
    <form action="{{ route('messages.goToAuctionChat', $auction->id) }}" method="POST">
        @csrf
        <div style="
    text-align: left; 
    margin-top: 20px; /* space above the buttons */
">
        <button style="
    background-color: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.3s;
    margin-left: 15px;
"
onmouseover="
    this.style.backgroundColor='#218838';
    this.style.transform='scale(1.03)';
"
onmouseout="
    this.style.backgroundColor='#28a745';
    this.style.transform='scale(1)';
">
    Message Auctioneer
</button>
        </div>
    </form>

    <!-- Alternatively, just a link that creates a blank message or goes to chat. 
         <a href="{{ route('messages.show', $auction->user->id) }}">Message Auctioneer</a> -->
                    </div>
                </div>
            @endforeach
        </div>
    @endif
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
