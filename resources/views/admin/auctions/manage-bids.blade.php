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
    <h1>Manage Bids</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($bids->isEmpty())
        <p>No bids available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Bid ID</th>
                    <th>User</th>
                    <th>Auction</th>
                    <th>Bid Amount</th>
                    <th>Placed At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bids as $bid)
                    <tr>
                        <td>{{ $bid->id }}</td>
                        <td>{{ $bid->user->name }}</td>
                        <td>{{ $bid->auction->title }}</td>
                        <td>Rs {{ number_format($bid->bid_amount, 2) }}</td>
                        <td>{{ $bid->created_at }}</td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.deleteBid', $bid->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bid?');">
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
