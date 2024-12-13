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
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .auction-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .auction-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .auction-details {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.5;
    }

    .auction-status {
        margin-top: 10px;
        font-size: 0.9rem;
    }

    .badge-approved {
        background-color: #28a745;
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

    .badge-rejected {
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .reason {
        font-style: italic;
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .btn-delete {
        display: inline-block;
        margin-top: 10px;
        color: #dc3545;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-delete:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>My Auctions</h1>
    @if($auctions->isEmpty())
        <p class="text-center">You have not submitted any auctions yet.</p>
    @else
        <div class="row">
            @foreach($auctions as $auction)
                <div class="col-md-4">
                    <div class="auction-card">
                        <div class="auction-title">{{ $auction->title }}</div>
                        <div class="auction-details">
                            <p><strong>Category:</strong> {{ $auction->category }}</p>
                            <p><strong>Start Bid:</strong> Rs {{ number_format($auction->start_bid, 2) }}</p>
                            <p><strong>Max Bid:</strong> Rs {{ number_format($auction->max_bid, 2) }}</p>
                            <p><strong>Description:</strong> {{ $auction->description }}</p>
                            <p><strong>Status:</strong>
                                @if($auction->status == 'approved')
                                    <span class="badge badge-approved">Approved</span>
                                @elseif($auction->status == 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @else
                                    <span class="badge badge-rejected">Rejected</span>
                                @endif
                            </p>
                            @if($auction->status == 'rejected')
                                <p class="reason">Reason: {{ $auction->rejection_reason }}</p>
                            @endif
                        </div>
                        <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Auction</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
