@extends('layouts.user')

@section('content')
<style>
    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>

<div class="container">
    <h1>Place Your Bid</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <p><strong>Title:</strong> {{ $auction->title }}</p>
    <p><strong>Start Bid:</strong> Rs {{ number_format($auction->start_bid, 2) }}</p>
    <p><strong>Current Highest Bid:</strong> Rs {{ number_format($highestBid ?? $auction->start_bid, 2) }}</p>
    <p><strong>Duration:</strong> {{ $auction->duration }} days</p>

    <form action="{{ route('auctions.placeBid.submit', $auction->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="bid_amount">Your Bid Amount</label>
            <input type="number" name="bid_amount" id="bid_amount" class="form-control" required>
        </div>
        <button type="submit" class="btn-submit">Place Bid</button>
    </form>
</div>
@endsection
