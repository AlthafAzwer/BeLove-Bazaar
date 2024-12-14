@extends('layouts.user')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 2rem auto;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 1rem;
    }

    .btn-submit {
        background-color: #007bff;
        color: #fff;
        padding: 0.8rem 1rem;
        border-radius: 5px;
        border: none;
        font-size: 1rem;
        width: 100%;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-container">
    <h1>Proceed to Purchase</h1>
    <form action="{{ route('auction_orders.store', $bid->auction->id) }}" method="POST">
        @csrf
        <!-- Auction Information -->
        <div class="form-group">
            <label for="auction_title">Auction Title</label>
            <input type="text" id="auction_title" class="form-control" value="{{ $bid->auction->title }}" readonly>
        </div>

        <div class="form-group">
            <label for="bid_amount">Your Bid Amount</label>
            <input type="text" id="bid_amount" class="form-control" value="Rs {{ number_format($bid->bid_amount, 2) }}" readonly>
        </div>

        <!-- Buyer Information -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="buyer_name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="buyer_address" id="address" rows="4" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="buyer_phone" id="phone" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit">Submit Purchase</button>
    </form>
</div>
@endsection
