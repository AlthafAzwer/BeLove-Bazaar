@extends('layouts.user')

@section('content')
<style>
    .charities-header {
        text-align: center;
        margin: 2rem 0;
    }

    .charities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .charity-card {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem;
        background-color: #ffffff;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .charity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .charity-card h3 {
        font-size: 1.4rem;
        color: #2c3e50;
        margin-bottom: 0.8rem;
        text-transform: capitalize;
    }

    .charity-card p {
        color: #555;
        font-size: 1rem;
        margin: 0.5rem 0;
    }

    .charity-card .status {
        margin-top: 1rem;
        font-weight: bold;
        font-size: 1rem;
    }

    .charity-card .status.approved {
        color: #28a745;
    }

    .charity-card .status.rejected {
        color: #dc3545;
    }

    .delete-btn {
        color: #dc3545;
        text-decoration: none;
        font-size: 1rem;
        font-weight: bold;
        margin-top: 1rem;
        display: inline-block;
        transition: color 0.3s ease;
    }

    .delete-btn:hover {
        color: #a71d2a;
    }
</style>

<div class="charities-header">
    <h1>My Charities</h1>
</div>

<div class="charities-grid">
    @foreach ($charityRequests as $charity)
        <div class="charity-card">
            <h3>{{ $charity->name }}</h3>
            <p>{{ $charity->description }}</p>
            <p><strong>Quantity:</strong> {{ $charity->quantity }}</p>
            <p><strong>Phone:</strong> {{ $charity->phone }}</p>
            <p class="status {{ strtolower($charity->status) }}">
                Status: <span>{{ ucfirst($charity->status) }}</span>
            </p>
            @if ($charity->status === 'rejected' && $charity->rejection_reason)
                <p><strong>Reason:</strong> {{ $charity->rejection_reason }}</p>
            @endif
            <a href="{{ route('charities.delete', $charity->id) }}" class="delete-btn"
               onclick="return confirm('Are you sure you want to delete this charity request?');">
                Delete Charity Request
            </a>
        </div>
    @endforeach
</div>
@endsection
