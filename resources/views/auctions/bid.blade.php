@extends('layouts.user')

@section('content')
<style>
    /* Main container styling */
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
    }

    /* Flex layout for image and details */
    .auction-content {
        display: flex;
        flex-wrap: wrap; /* Ensures responsiveness on smaller screens */
        gap: 20px;
        align-items: flex-start;
    }

    /* Auction Image Styling */
    .auction-image {
        flex: 1 1 40%; /* Image takes 40% of the container width */
    }

    .auction-image img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease; /* Add a hover effect */
    }

    .auction-image img:hover {
        transform: scale(1.05); /* Slight zoom effect on hover */
    }

    /* Auction Details */
    .auction-details {
        flex: 1 1 55%; /* Details take 55% of the container width */
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .auction-details p {
        margin: 10px 0;
        font-size: 1rem;
        color: #555;
        line-height: 1.5;
    }

    .auction-details strong {
        color: #2c3e50;
        font-weight: bold;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        font-size: 1rem;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0px 0px 6px rgba(52, 152, 219, 0.5);
        outline: none;
    }

    /* Submit Button Styling */
    .btn-submit {
        width: 100%;
        padding: 15px;
        background-color: #3498db;
        color: #fff;
        font-size: 1.2rem;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #1d6fa5;
        transform: translateY(-2px);
    }

    /* Alert Styling */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .auction-content {
            flex-direction: column; /* Stack image and details vertically */
        }

        .auction-image,
        .auction-details {
            flex: 1 1 100%; /* Each takes full width on smaller screens */
        }
    }
</style>

<div class="container">
    <!-- Page Title -->
    <h1>Place Your Bid</h1>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <!-- Auction Content -->
    <div class="auction-content">
        <!-- Auction Image -->
        <div class="auction-image">
            <img src="{{ asset('storage/' . (json_decode($auction->images, true)[0] ?? 'placeholder.jpg')) }}" alt="{{ $auction->title }}">
        </div>

        <!-- Auction Details -->
        <div class="auction-details">
            <div>
                <p><strong>Title:</strong> {{ $auction->title }}</p>
                <p><strong>Start Bid:</strong> Rs {{ number_format($auction->start_bid, 2) }}</p>
                <p><strong>Current Highest Bid:</strong> Rs {{ number_format($highestBid ?? $auction->start_bid, 2) }}</p>
                <p><strong>Auction Ends:</strong> {{ $auction->end_time->format('d M Y, h:i A') }}</p>
            </div>

            <!-- Place Bid Form -->
            <form action="{{ route('auctions.placeBid.submit', $auction->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bid_amount" style="font-size: 1.1rem; color: #2c3e50; font-weight: bold;">Your Bid Amount</label>
                    <input 
                        type="number" 
                        name="bid_amount" 
                        id="bid_amount" 
                        class="form-control" 
                        placeholder="Enter your bid amount" 
                        min="{{ $highestBid ?? $auction->start_bid + 1 }}" 
                        required>
                </div>
                <button type="submit" class="btn-submit">Place Bid</button>
            </form>
        </div>
    </div>
</div>
@endsection
