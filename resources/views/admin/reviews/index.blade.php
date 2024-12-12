@extends('layouts.admin')

@section('content')
<style>
    /* Container Styling */
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    h1 {
        font-size: 2rem;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 2rem;
        font-weight: bold;
    }

    /* Table Styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
    }

    .table th {
        background-color: #f4f4f9;
        color: #2c3e50;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
    }

    .table td {
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:hover {
        background-color: #eef5f9;
    }

    /* Button Styling */
    .btn-danger {
        background-color: #e74c3c;
        color: #ffffff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-sm {
        font-size: 0.85rem;
    }
</style>

<div class="container mt-5">
    <h1>Manage Reviews</h1>
    @if($reviews->isEmpty())
        <p style="text-align: center; color: #7f8c8d;">No reviews available at the moment.</p>
    @else
        <table class="table table-striped mt-4">
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
                        <td>{{ $review->product->title ?? 'N/A' }}</td>
                        <td>{{ $review->user->name ?? 'N/A' }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->review ?? 'No review text provided' }}</td>
                        <td>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
