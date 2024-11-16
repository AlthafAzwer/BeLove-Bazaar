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

        /* Action links styling */
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

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

    <h1>Manage Products</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category }}</td>
                    <td>Rs {{ number_format($product->price, 2) }}</td>
                    <td>{{ ucfirst($product->status) }}</td>
                    <td class="action-links">
                        <a href="#">Edit</a> 
                        <a href="#">Approve</a> 
                        <a href="#">Reject</a> 
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
