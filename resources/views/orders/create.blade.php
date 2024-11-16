@extends('layouts.user')

@section('content')
    <style>
        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 0.5rem;
        }

        input[type="text"], select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 1rem;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 3px rgba(49, 130, 206, 0.5);
        }

        button {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #3182ce;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2b6cb0;
        }
    </style>

    <h2>Order Details for {{ $product->title }}</h2>
    <form action="{{ route('orders.store', ['product' => $product->id]) }}" method="POST">
        @csrf
        <div>
            <label for="buyer_name">Name:</label>
            <input type="text" name="buyer_name" value="{{ old('buyer_name', Auth::user()->name) }}" required>
        </div>
        <div>
            <label for="buyer_address">Address:</label>
            <input type="text" name="buyer_address" required>
        </div>
        <div>
            <label for="buyer_telephone">Telephone:</label>
            <input type="text" name="buyer_telephone" required>
        </div>
        <div>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit">Place Order</button>
    </form>
@endsection
