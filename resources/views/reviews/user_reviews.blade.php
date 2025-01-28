@extends('layouts.user')

@section('content')
<style>
    /* Main container styling */
    .reviews-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .reviews-container h1 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2.5rem;
        color: #34495e;
        font-weight: bold;
    }

    /* Card Layout */
    .review-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .review-card {
        background-color: #f7f9fc;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .review-card h3 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .review-card p {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .review-card .rating {
        font-weight: bold;
        color: #f39c12;
    }

    /* Delete Button */
    .delete-btn {
        display: inline-block;
        margin-top: 1rem;
        padding: 10px 15px;
        background-color: #e74c3c;
        color: white;
        font-size: 0.9rem;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .delete-btn:hover {
        background-color: #c0392b;
        transform: translateY(-3px);
    }

    /* Empty Reviews Message */
    .no-reviews {
        text-align: center;
        font-size: 1.2rem;
        color: #7f8c8d;
        margin: 2rem 0;
    }

    /* Footer Styling */
    .footer {
        background-color: #1a202c;
        color: #edf2f7;
        padding: 2rem 0;
        display: flex;
        justify-content: space-around;
        text-align: center;
        flex-wrap: wrap;
    }

    .footer h4 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .footer .footer-section {
        flex: 1;
        margin: 1rem;
    }

    .footer a {
        color: #edf2f7;
        text-decoration: none;
    }

    .footer a:hover {
        color: #e53e3e;
    }
</style>

<div class="reviews-container">
    <h1>User Reviews</h1>

    @if($reviews->isEmpty())
        <p class="no-reviews">No reviews available at the moment. Be the first to leave a review!</p>
    @else
        <div class="review-cards">
            @foreach($reviews as $review)
                <div class="review-card">
                    <h3>{{ $review->product->title }}</h3>
                    <p><strong>User:</strong> {{ $review->user->name }}</p>
                    <p><strong>Rating:</strong> <span class="rating">{{ $review->rating }}</span></p>
                    <p><strong>Review:</strong> {{ $review->review }}</p>
                    @if(auth()->id() === $review->user_id)
                        <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-section">
        <h4>Exclusive</h4>
        <p>Signup for updates</p>
        <form>
            <input type="email" placeholder="Enter your email">
            <button type="submit">→</button>
        </form>
    </div>
    <div class="footer-section">
        <h4>Support</h4>
        <p>Union Place, Apiit</p>
        <p>relovebazaar@gmail.com</p>
        <p>0764740651</p>
    </div>
    <div class="footer-section">
        <h4>Account</h4>
        <p><a href="#">My Account</a></p>
        <p><a href="#">Login / Register</a></p>
        <p><a href="#">Cart</a></p>
        <p><a href="#">Wishlist</a></p>
    </div>
    <div class="footer-section">
        <h4>Quick Links</h4>
        <p><a href="#">Products</a></p>
        <p><a href="#">Donation List</a></p>
        <p><a href="#">Blog</a></p>
        <p><a href="#">Contact</a></p>
    </div>
</footer>
@endsection
