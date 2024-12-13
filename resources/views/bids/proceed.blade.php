@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Proceed to Buy</h1>

    <p><strong>Auction Title:</strong> {{ $bid->auction->title }}</p>
    <p><strong>Winning Bid Amount:</strong> Rs {{ number_format($bid->bid_amount, 2) }}</p>

    <form action="{{ route('orders.create') }}" method="POST">
        @csrf
        <input type="hidden" name="auction_id" value="{{ $bid->auction->id }}">
        <input type="hidden" name="bid_id" value="{{ $bid->id }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>
        </div>
        <button type="submit">Confirm Purchase</button>
    </form>
</div>
@endsection
