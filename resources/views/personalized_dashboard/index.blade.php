@extends('layouts.user')

@section('content')
<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="font-size: 32px; margin-bottom: 30px; text-align: center; color: #2c3e50; font-weight: bold;">
        Personalized Dashboard
    </h1>

    <!-- Summary Section -->
    <div style="display: flex; gap: 20px; justify-content: space-between; margin-bottom: 30px; flex-wrap: wrap;">
        @foreach([
            ['Total Products', $totalProducts],
            ['Total Bids', $totalBids],
            ['Active Charities', $activeCharities],
            ['Placed Orders', $totalOrders],
            ['Total Auctions', $totalAuctions],
            ['Total Reviews', $totalReviews],
        ] as $stat)
            <div style="
                flex: 1;
                background: linear-gradient(135deg, #3498db, #2980b9);
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
                text-align: center;
                color: white;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='scale(1.05)'"
            onmouseout="this.style.transform='scale(1)'">
                <h3 style="margin: 0; font-size: 18px; font-weight: bold;">{{ $stat[0] }}</h3>
                <p style="font-size: 26px; font-weight: bold; margin: 10px 0;">{{ $stat[1] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Recently Viewed Products -->
    <div style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; color: #333;">Recently Viewed Products</h3>
        <div style="display: flex; gap: 15px; overflow-x: auto;">
            @forelse($viewedProducts as $viewed)
                @if($viewed->product) <!-- Ensure the product exists -->
                    <div style="
                        flex: 0 0 200px;
                        background: #fff;
                        padding: 15px;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        text-align: center;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                        transition: transform 0.3s ease;
                    "
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'">
                        <h4 style="font-size: 16px; color: #333; margin-bottom: 10px;">{{ $viewed->product->title }}</h4>
                        <p style="color: #7f8c8d; margin-bottom: 10px;">Rs {{ number_format($viewed->product->price, 2) }}</p>
                        <a href="{{ route('products.show', $viewed->product->id) }}" style="
                            display: inline-block;
                            padding: 8px 12px;
                            background-color: #3498db;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            font-size: 14px;
                        "
                        onmouseover="this.style.backgroundColor='#217dbb'"
                        onmouseout="this.style.backgroundColor='#3498db'">
                            View Product
                        </a>
                    </div>
                @endif
            @empty
                <p style="font-size: 16px; color: #7f8c8d;">No recently viewed products available.</p>
            @endforelse
        </div>
    </div>

    <!-- Recommendations Section -->
    <div>
        <h3 style="margin-bottom: 15px; color: #333;">Recommended for You</h3>
        <div style="display: flex; gap: 15px; overflow-x: auto;">
            @forelse($recommendations as $product)
                <div style="
                    flex: 0 0 200px;
                    background: #fff;
                    padding: 15px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    text-align: center;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease;
                "
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'">
                    <h4 style="font-size: 16px; color: #333; margin-bottom: 10px;">{{ $product->title }}</h4>
                    <p style="color: #7f8c8d; margin-bottom: 10px;">Rs {{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" style="
                        display: inline-block;
                        padding: 8px 12px;
                        background-color: #3498db;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                        font-size: 14px;
                    "
                    onmouseover="this.style.backgroundColor='#217dbb'"
                    onmouseout="this.style.backgroundColor='#3498db'">
                        View Product
                    </a>
                </div>
            @empty
                <p style="font-size: 16px; color: #7f8c8d;">No recommendations available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
