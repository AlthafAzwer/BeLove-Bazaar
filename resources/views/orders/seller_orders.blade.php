@extends('layouts.user')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto 2rem auto;
            border-collapse: collapse;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #2d3748;
            color: #fff;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05rem;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        select {
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            background-color: #f8f9fa;
            cursor: pointer;
        }

        button {
            background-color: #3182ce;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            border: none;
            font-size: 0.875rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2c5282;
        }

        p {
            text-align: center;
            font-size: 1rem;
            color: #555;
        }
    </style>

    <h2>My Orders as a Seller</h2>
    @if($orders->isEmpty())
        <p>No orders received yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Buyer Name</th>
                    <th>Buyer Address</th>
                    <th>Buyer Telephone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->product->title }}</td>
                        <td>{{ $order->buyer_name }}</td>
                        <td>{{ $order->buyer_address }}</td>
                        <td>{{ $order->buyer_telephone }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status">
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit">Update Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
