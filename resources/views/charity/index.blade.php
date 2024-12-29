@extends('layouts.user')

@section('content')
<style>
    .charities-header {
        text-align: center;
        margin: 2rem 0;
    }

    .charities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .charity-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        background-color: #fff;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .charity-card h3 {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .charity-card p {
        color: #555;
        font-size: 0.9rem;
        margin: 0.5rem 0;
    }

    .charity-card .status {
        margin-top: 0.5rem;
        font-weight: bold;
    }

    .charity-card .status.approved {
        color: green;
    }

    .charity-card .status.rejected {
        color: red;
    }

    .delete-btn {
        color: red;
        text-decoration: none;
        font-size: 0.9rem;
        cursor: pointer;
        margin-top: 0.5rem;
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
                Status: {{ ucfirst($charity->status) }}
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
