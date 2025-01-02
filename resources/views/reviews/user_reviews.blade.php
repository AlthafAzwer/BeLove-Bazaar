@extends('layouts.user')

@section('content')
<style>
    /* Main container styling */
    .reviews-container {
        max-width: 900px;
        margin: 2rem auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .reviews-container h1 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2.5rem;
        color: #34495e;
        font-weight: bold;
    }

    /* Table Styling */
    .reviews-table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 12px;
    }

    .reviews-table th,
    .reviews-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .reviews-table th {
        background-color: #2c3e50;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    .reviews-table tr:nth-child(even) {
        background-color: #f7f7f7;
    }

    .reviews-table tr:hover {
        background-color: #eaf2f8;
        transition: background-color 0.3s ease;
    }

    /* Button Styling */
    .delete-btn {
        background-color: #e74c3c;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .delete-btn:hover {
        background-color: #c0392b;
        transform: translateY(-3px);
    }

    .delete-btn:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(231, 76, 60, 0.5);
    }

    /* Empty message styling */
    .no-reviews {
        text-align: center;
        font-size: 1.2rem;
        color: #7f8c8d;
        margin: 2rem 0;
    }
</style>

<div class="reviews-container">
    <h1>User Reviews</h1>
    @if($reviews->isEmpty())
        <p class="no-reviews">No reviews available at the moment. Be the first to leave a review!</p>
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
                            <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
