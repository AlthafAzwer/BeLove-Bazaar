@extends('layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Title Section -->
    <h1 class="text-center mb-5" style="font-weight: bold; color: #2c3e50; font-size: 2.5rem;">Explore Our Blogs</h1>

    <!-- Blog Cards Section -->
    <div class="row g-4">
        @foreach($blogs as $blog)
        <div class="col-md-6">
            <div class="card blog-card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); border-radius: 15px;">
                <!-- Blog Image -->
                @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image" style="height: 250px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                @else
                <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Default Blog Image" style="height: 250px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                @endif
                
                <!-- Blog Content -->
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title mb-3" style="font-weight: bold; color: #34495e; font-size: 1.5rem;">{{ $blog->title }}</h5>
                    <p class="card-text text-muted mb-4" style="line-height: 1.5; font-size: 1rem;">{{ Str::limit($blog->content, 120, '...') }}</p>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary mt-auto read-more-btn" style="background-color: #3498db; border: none; border-radius: 8px; font-size: 1rem; padding: 10px 20px; text-transform: uppercase;">
                        Read More
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Footer Section -->
<footer class="footer mt-5">
    <div class="footer-section">
        <h4>Exclusive</h4>
        <p>Signup</p>
        <form>
            <input type="email" placeholder="Enter your email" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <button type="submit" style="padding: 8px 15px; border-radius: 5px; background-color: #3498db; color: white; border: none;">→</button>
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

<!-- CSS Styling -->
<style>
    /* Blog Card hover effect */
    .blog-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .blog-card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    /* Read More Button Styling */
    .read-more-btn {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .read-more-btn:hover {
        background-color: #1d6fa5;
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-img-top {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .card-title {
            font-size: 1.2rem;
        }

        .read-more-btn {
            font-size: 0.85rem;
            padding: 8px 16px;
        }
    }

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
@endsection
