@extends('layouts.admin')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 2rem;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    .table thead th {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        font-weight: bold;
        padding: 1rem;
        border: 1px solid #ddd;
    }

    .table tbody td {
        padding: 0.75rem;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #ddd;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-danger:hover {
        background-color: #b02a37;
        transform: scale(1.05);
    }

    .alert {
        margin-bottom: 1.5rem;
        padding: 1rem;
        border-radius: 5px;
        font-size: 1rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .empty-state {
        text-align: center;
        font-size: 1.2rem;
        color: #6c757d;
        margin-top: 2rem;
    }
</style>

<div class="container">
    <h1>Manage Auction Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($auctionOrders->isEmpty())
        <p class="empty-state">No auction orders found.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Auction Title</th>
                        <th>Buyer Name</th>
                        <th>Buyer Address</th>
                        <th>Buyer Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auctionOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->auction->title }}</td>
                            <td>{{ $order->buyer_name }}</td>
                            <td>{{ $order->buyer_address }}</td>
                            <td>{{ $order->buyer_phone }}</td>
                            <td>
                                <span class="badge {{ $order->status === 'pending' ? 'badge-warning' : 'badge-success' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.auction_orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
