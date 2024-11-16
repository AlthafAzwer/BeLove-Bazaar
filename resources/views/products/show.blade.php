@extends('layouts.user')

@section('content')
    <style>
        /* Product Details Section */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding: 2rem;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 2rem auto;
            max-width: 900px;
            animation: fadeIn 0.5s ease-in-out;
        }
        .product-image img {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            margin: 0 auto;
            display: block;
            transition: transform 0.3s ease;
        }
        .product-image img:hover {
            transform: scale(1.1);
        }
        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-info h2 {
            margin: 0;
            font-size: 2.2rem;
            color: #333;
            font-weight: bold;
        }
        .product-info .price {
            color: #e53e3e;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        .product-info .contact-info {
            font-size: 1rem;
            color: #555;
            margin: 1rem 0;
        }
        .product-info p {
            line-height: 1.6;
            color: #666;
        }
        .buy-now-btn {
            display: inline-block;
            background-color: #e53e3e;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .buy-now-btn:hover {
            background-color: #c53030;
            transform: translateY(-3px);
        }

        /* Mobile Responsive Design */
        @media (min-width: 768px) {
            .product-details {
                flex-direction: row;
            }
            .product-image {
                flex: 1;
            }
            .product-info {
                flex: 2;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="product-details">
        <!-- Product Image -->
        <div class="product-image">
            <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}" alt="{{ $product->title }}">
        </div>

        <!-- Product Information -->
        <div class="product-info">
            <h2>{{ $product->title }}</h2>
            <p class="price">Rs {{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>
            <p class="contact-info"><strong>Contact:</strong> {{ $product->contact_info }}</p>
            <a href="{{ route('orders.create', ['product' => $product->id]) }}" class="buy-now-btn">Buy Now</a>
        </div>
    </div>
@endsection
