@extends('layouts.admin')

@section('content')
<style>
    /* Inline styling for Manage Auctions */
    .container {
        max-width: 1200px;
        margin: auto;
    }

    .auction-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: #fff;
    }

    .auction-header {
        padding: 1rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }

    .auction-header h5 {
        margin: 0;
        font-size: 1.2rem;
        color: #333;
        font-weight: bold;
    }

    .auction-body {
        padding: 1rem;
    }

    .auction-body img {
        width: 30%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    .auction-body p {
        margin: 0.5rem 0;
        font-size: 0.95rem;
        color: #555;
    }

    .auction-footer {
        padding: 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-inline {
        display: flex;
        align-items: center;
    }

    .form-inline input {
        margin-right: 10px;
        flex-grow: 1;
        padding: 0.4rem;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .text-bold {
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Manage Auctions</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($auctions as $auction)
            <div class="col-md-6">
                <div class="auction-card">
                    <div class="auction-header">
                        <h5>{{ $auction->title }}</h5>
                    </div>
                    <div class="auction-body">
                        @if(json_decode($auction->images))
                            <img src="{{ asset('storage/' . json_decode($auction->images)[0]) }}" alt="Auction Image">
                        @else
                            <img src="{{ asset('placeholder.jpg') }}" alt="No Image Available">
                        @endif
                        <p><span class="text-bold">Category:</span> {{ $auction->category }}</p>
                        <p><span class="text-bold">Start Bid:</span> Rs {{ number_format($auction->start_bid, 2) }}</p>
                        <p><span class="text-bold">Max Bid:</span> Rs {{ number_format($auction->max_bid, 2) }}</p>
                        <p><span class="text-bold">Duration:</span> {{ $auction->duration }} days</p>
                        <p><span class="text-bold">Location:</span> {{ $auction->location }}</p>
                        <p><span class="text-bold">Condition:</span> {{ ucfirst($auction->condition) }}</p>
                        <p><span class="text-bold">Description:</span> {{ $auction->description }}</p>
                        <p><span class="text-bold">Status:</span> <span class="badge bg-warning text-dark">{{ ucfirst($auction->status) }}</span></p>
                        <p><span class="text-bold">Contact Info:</span> {{ $auction->contact_info }}</p>
                    </div>
                    <div class="auction-footer">
                        <form action="{{ route('admin.auctions.approve', $auction->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.auctions.reject', $auction->id) }}" method="POST" class="form-inline d-inline">
                            @csrf
                            <input type="text" name="rejection_reason" placeholder="Rejection reason" required>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
