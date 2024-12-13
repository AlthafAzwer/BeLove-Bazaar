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

    .bid-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .bid-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .bid-body {
        padding: 15px;
    }

    .bid-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .bid-info {
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #555;
    }

    .badge-won {
        background-color: #28a745;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .badge-lost {
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #000;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .badge-outbid {
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .badge-winning {
        background-color: #28a745;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .proceed-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .proceed-btn:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }
</style>

<div class="container">
    <h1>My Bids</h1>

    @if($bids->isEmpty())
        <p class="text-center">You have not placed any bids yet.</p>
    @else
        @foreach($bids as $bid)
            <div class="bid-card">
                <div class="bid-body">
                    <h3 class="bid-title">{{ $bid->auction->title }}</h3>
                    <p class="bid-info"><strong>Your Bid:</strong> Rs {{ number_format($bid->bid_amount, 2) }}</p>
                    <p class="bid-info"><strong>Highest Bid:</strong> Rs {{ number_format($bid->auction->bids->max('bid_amount'), 2) }}</p>
                    
                    <!-- Bid Status -->
                    <p class="bid-info"><strong>Status:</strong>
                        @if($bid->auction->auction_state === 'completed')
                            @if($bid->status === 'won')
                                <span class="badge-won">Won</span>
                                <a href="{{ route('bids.purchase', $bid->id) }}" class="proceed-btn">Proceed to Purchase</a>
                            @else
                                <span class="badge-lost">Lost</span>
                            @endif
                        @else
                            @if($bid->bid_amount == $bid->auction->bids->max('bid_amount'))
                                <span class="badge-winning">Winning</span>
                            @else
                                <span class="badge-outbid">Outbid</span>
                            @endif
                        @endif
                    </p>

                    <!-- Auction Status -->
                    <p class="bid-info"><strong>Auction Status:</strong>
                        @if($bid->auction->auction_state === 'completed')
                            <span class="badge-won">Ended</span>
                        @else
                            <span class="badge-pending">Active</span>
                        @endif
                    </p>

                    <!-- Auction End Time -->
                    <p class="bid-info"><strong>Auction Ends:</strong>
                        {{ $bid->auction->end_time ? $bid->auction->end_time->format('d M Y, h:i A') : 'Not Set' }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
