@extends('layouts.admin')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f1f1f1;
    }

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }
</style>

<div class="container">
    <h1>Manage Live Auctions</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($auctions->isEmpty())
        <p>No live auctions available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Start Bid</th>
                    <th>Max Bid</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auctions as $auction)
                    <tr>
                        <td>{{ $auction->title }}</td>
                        <td>{{ $auction->category }}</td>
                        <td>Rs {{ number_format($auction->start_bid, 2) }}</td>
                        <td>Rs {{ number_format($auction->max_bid, 2) }}</td>
                        <td>{{ $auction->end_time }}</td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.deleteAuction', $auction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this auction?');">
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
