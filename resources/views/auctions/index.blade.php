@extends('layouts.user')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .auction-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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
</style>

<div class="container">
    <h1>Live Auctions</h1>

    @if($auctions->isEmpty())
        <p class="text-center">No auctions are live at the moment. Please check back later.</p>
    @else
        <div class="auction-card-container">
            @foreach($auctions as $auction)
                <div class="auction-card">
                    <div class="auction-image">
                        <img src="{{ asset('storage/' . json_decode($auction->images)[0]) }}" alt="{{ $auction->title }}">
                    </div>
                    <div class="auction-body">
                        <h3 class="auction-title">{{ $auction->title }}</h3>
                        <p class="auction-info"><strong>Category:</strong> {{ $auction->category }}</p>
                        <p class="auction-info"><strong>Start Bid:</strong> Rs {{ number_format($auction->start_bid, 2) }}</p>
                        <p class="auction-info"><strong>Max Bid:</strong> Rs {{ number_format($auction->max_bid, 2) }}</p>
                        <p class="auction-info"><strong>Auction Duration:</strong> {{ $auction->duration }} days</p>
                        <a href="{{ route('auctions.placeBid', $auction->id) }}" class="place-bid-btn">Place Bid</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
