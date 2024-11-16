@extends('layouts.admin')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Success message styling */
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead tr {
            background-color: #34495e;
            color: white;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            vertical-align: middle;
        }

        /* Delete button styling */
        .delete-btn {
            color: red;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }
    </style>

    <h1>Manage Orders</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Buyer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->product->title }}</td>
                    <td>{{ $order->buyer->name }} ({{ $order->buyer->email }})</td>
                    <td>
                        <!-- Delete Order -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
