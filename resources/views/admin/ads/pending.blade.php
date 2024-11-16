@extends('layouts.admin')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .ad-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }

        .ad-card {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .ad-card h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .ad-card p {
            margin: 10px 0;
            font-size: 1rem;
            color: #555;
        }

        .action-buttons {
            margin-top: 15px;
        }

        form {
            display: inline;
            margin-right: 10px;
        }

        button {
            padding: 8px 12px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"] {
            color: white;
        }

        button[type="submit"]:hover {
            opacity: 0.9;
        }

        .approve-btn {
            background-color: #28a745;
        }

        .reject-btn {
            background-color: #dc3545;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }
    </style>

    <h1>Pending Ads for Approval</h1>

    @if($pendingAds->isEmpty())
        <p>No ads are currently pending approval.</p>
    @else
        <div class="ad-container">
            @foreach($pendingAds as $ad)
                <div class="ad-card">
                    <h3>{{ $ad->title }}</h3>
                    <p><strong>Category:</strong> {{ $ad->category }}</p>
                    <p><strong>Description:</strong> {{ $ad->description }}</p>

                    <div class="action-buttons">
                        <!-- Approve Button -->
                        <form action="{{ route('admin.ads.approve', $ad->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="approve-btn">Approve</button>
                        </form>

                        <!-- Reject Button with Reason -->
                        <form action="{{ route('admin.ads.reject', $ad->id) }}" method="POST">
                            @csrf
                            <label for="rejection_reason">Rejection Reason:</label>
                            <input type="text" name="rejection_reason" placeholder="Enter reason..." required>
                            <button type="submit" class="reject-btn">Reject</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
