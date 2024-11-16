@extends('layouts.admin')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .product-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-card h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .product-card p {
            margin: 10px 0;
            font-size: 1rem;
            color: #555;
        }

        textarea {
            width: 100%;
            height: 50px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            resize: none;
        }

        textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            padding: 8px 12px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .action-buttons {
            margin-top: 15px;
        }
    </style>

    <h1>Pending Products</h1>

    @if($pendingProducts->isEmpty())
        <p>No products are currently pending approval.</p>
    @else
        <div class="product-container">
            @foreach($pendingProducts as $product)
                <div class="product-card">
                    <h3>{{ $product->title }}</h3>
                    <p><strong>Category:</strong> {{ $product->category }}</p>
                    <p><strong>Location:</strong> {{ $product->location }}</p>
                    <p><strong>Condition:</strong> {{ $product->condition }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>

                    <!-- Approve and Reject Forms -->
                    <div class="action-buttons">
                        <!-- Approve Form -->
                        <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>

                        <!-- Reject Form -->
                        <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <textarea name="rejection_reason" placeholder="Enter rejection reason" required></textarea>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
