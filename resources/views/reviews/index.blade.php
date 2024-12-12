@extends('layouts.user')

@section('content')
    <style>
        .review-container {
            max-width: 900px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .review-item {
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-title {
            font-weight: bold;
            font-size: 1.2rem;
            color: #2c3e50;
        }

        .review-rating {
            color: #f39c12;
            font-size: 1rem;
        }

        .review-text {
            margin-top: 0.5rem;
            color: #555;
        }
    </style>

    <div class="review-container">
        <h2>Product Reviews</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if($reviews->isEmpty())
            <p>No reviews yet. Be the first to review!</p>
        @else
            @foreach($reviews as $review)
                <div class="review-item">
                    <p class="review-title">Product: {{ $review->product->title }}</p>
                    <p class="review-rating">Rating: {{ $review->rating }} / 5</p>
                    <p class="review-text">{{ $review->review }}</p>
                    <p class="review-author">Reviewed by: {{ $review->user->name }}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection
