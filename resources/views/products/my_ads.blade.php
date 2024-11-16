@extends('layouts.user')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .ads-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 0 auto;
            padding: 2rem;
        }

        .ad-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .ad-item:hover {
            transform: scale(1.03);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        .ad-item h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .ad-item p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        .ad-item .text-green-600 {
            color: #28a745;
            font-weight: bold;
        }

        .ad-item .text-red-600 {
            color: #dc3545;
            font-weight: bold;
        }

        .ad-item button {
            background: none;
            border: none;
            color: #e53e3e;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: underline;
        }

        .ad-item button:hover {
            color: #c53030;
        }
    </style>

    <h1>My Ads</h1>

    @if($userAds->isEmpty())
        <p style="text-align: center;">You have not posted any ads yet.</p>
    @else
        <div class="ads-grid">
            @foreach($userAds as $ad)
                <div class="ad-item">
                    <h3>{{ $ad->title }}</h3>
                    <p><strong>Category:</strong> {{ $ad->category }}</p>
                    <p><strong>Price:</strong> Rs {{ number_format($ad->price, 2) }}</p>
                    <p><strong>Description:</strong> {{ $ad->description }}</p>
                    <p><strong>Status:</strong> 
                        @if($ad->status === 'approved')
                            <span class="text-green-600">Approved</span>
                        @elseif($ad->status === 'rejected')
                            <span class="text-red-600">Rejected</span>
                            <p><strong>Reason:</strong> {{ $ad->rejection_reason }}</p>
                        @else
                            <span class="text-yellow-600">Pending Approval</span>
                        @endif
                    </p>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('products.destroy', $ad->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this ad?')">
                            Delete Ad
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
