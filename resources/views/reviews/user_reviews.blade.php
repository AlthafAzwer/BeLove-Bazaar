@extends('layouts.user')

@section('content')
<style>
    /* Main container styling */
    .reviews-container {
        max-width: 800px;
        margin: 2rem auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .reviews-container h1 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
        color: #2c3e50;
    }

    /* Table Styling */
    .reviews-table {
        width: 100%;
        border-collapse: collapse;
    }

    .reviews-table th,
    .reviews-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .reviews-table th {
        background-color: #f9f9f9;
        font-weight: bold;
        color: #2c3e50;
    }

    .reviews-table tr:nth-child(even) {
        background-color: #f4f4f4;
    }

    .reviews-table tr:hover {
        background-color: #eef5f9;
    }

    /* Delete Button Styling */
    .delete-btn {
        background-color: #e74c3c;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .delete-btn:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }

    .delete-btn:focus {
        outline: none;
        box-shadow: 0 0 5px 2px rgba(231, 76, 60, 0.5);
    }

    /* No Reviews Message Styling */
    .no-reviews {
        text-align: center;
        color: #7f8c8d;
        font-size: 1rem;
        margin: 2rem 0;
    }
</style>

<div class="reviews-container">
    <h1>User Reviews</h1>
    @if($reviews->isEmpty())
        <p class="no-reviews">No reviews available at the moment.</p>
    @else
        <table class="reviews-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->product->title }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->review }}</td>
                        <td>
                            @if($review->user_id === auth()->id())
                                <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
