@extends('layouts.user')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 2rem auto;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .table th, .table td {
        text-align: left;
        padding: 1rem;
        border-bottom: 1px solid #ddd;
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .no-orders {
        text-align: center;
        color: #555;
        font-size: 1.2rem;
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        margin-top: 2rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container">
    <h1>My Auction Orders</h1>
    @if($orders->isEmpty())
        <div class="no-orders">
            No orders found for your auctions.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Auction Title</th>
                    <th>Buyer Name</th>
                    <th>Buyer Address</th>
                    <th>Buyer Phone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->auction->title }}</td>
                        <td>{{ $order->buyer_name }}</td>
                        <td>{{ $order->buyer_address }}</td>
                        <td>{{ $order->buyer_phone }}</td>
                        <td>
                            <span class="badge {{ $order->status === 'pending' ? 'badge-warning' : 'badge-success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
