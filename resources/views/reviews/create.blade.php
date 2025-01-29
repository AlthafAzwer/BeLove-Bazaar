@extends('layouts.user')

@section('content')
    <style>
        .review-container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-size: 1rem;
            color: #2c3e50;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

    <div class="review-container">
        <h2>Review Product: {{ $order->product->title }}</h2>

        <form action="{{ route('review.store', $order->id) }}" method="POST">
            @csrf
            <label for="rating">Rating (1 to 5):</label>
            <select name="rating" id="rating" required>
                <option value="">Select Rating</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="review">Review:</label>
            <textarea name="review" id="review" rows="5" placeholder="Write your experience with the genuinity of the platform"></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>
@endsection
