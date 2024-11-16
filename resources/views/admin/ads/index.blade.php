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

        .ad-images img {
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
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

    <h1>Manage Ads</h1>

    @if($pendingAds->isEmpty())
        <p>No ads are currently pending approval.</p>
    @else
        <div class="ad-container">
            @foreach($pendingAds as $ad)
                <div class="ad-card">
                    <h3>{{ $ad->title }}</h3>
                    <p><strong>Category:</strong> {{ $ad->category }}</p>
                    <p><strong>Price:</strong> Rs {{ $ad->price }}</p>
                    <p><strong>Location:</strong> {{ $ad->location }}</p>
                    <p><strong>Condition:</strong> {{ $ad->condition }}</p>
                    <p><strong>Description:</strong> {{ $ad->description }}</p>
                    <p><strong>Contact Info:</strong> {{ $ad->contact_info }}</p>

                    <!-- Display Images -->
                    <div class="ad-images">
                        @if($ad->images)
                            @foreach(json_decode($ad->images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Ad Image" style="width: 100px; height: 100px; object-fit: cover;">
                            @endforeach
                        @else
                            <p>No images available.</p>
                        @endif
                    </div>

                    <!-- Approve and Reject Buttons -->
                    <div class="action-buttons">
                        <form action="{{ route('admin.ads.approve', $ad->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="approve-btn">Approve</button>
                        </form>

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
