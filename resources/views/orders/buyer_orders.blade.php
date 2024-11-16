@extends('layouts.user')

@section('content')
    <style>
        /* Main container styling */
        .order-container {
            margin: 2rem auto;
            max-width: 80%;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
            color: #2c3e50;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            border-bottom: 1px solid #e2e8f0;
        }

        /* Hover Effect */
        tr:hover {
            background-color: #f9f9f9;
        }

        /* Address and Contact Column Styling */
        td:nth-child(3), td:nth-child(4) {
            color: #555;
        }

        /* Success Message Styling */
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>

    <!-- Order Container -->
    <div class="order-container">
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <h2>Your Orders</h2>

        @if($orders->isEmpty())
            <p>No orders placed yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->product->title }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->buyer_address }}</td>
                            <td>{{ $order->buyer_telephone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
