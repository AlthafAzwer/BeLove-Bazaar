@extends('layouts.user')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1.5rem;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        border-radius: 10px;
        overflow: hidden;
        background: white;
    }

    .table thead {
        background-color: #28a745;
        color: white;
        text-align: center;
    }

    .table th, .table td {
        padding: 1rem;
        border-bottom: 1px solid #ddd;
        text-align: center; /* Align text properly */
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
    <h1>My Auction Purchases</h1>
    
    @if($orders->isEmpty())
        <div class="no-orders">
            You haven't purchased any auction items yet.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Auction Title</th>
                    <th>Seller Name</th>
                    <th>Seller Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->auction->title }}</td>
                        <td>{{ $order->auction->user->name }}</td>
                        <td>{{ $order->auction->contact_info ?? 'No phone provided' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
