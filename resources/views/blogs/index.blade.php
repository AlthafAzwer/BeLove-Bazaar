@extends('layouts.user')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5" style="font-weight: bold; color: #2c3e50; font-size: 1.8rem">Explore Our Blogs</h1>
    <div class="row g-4">
        @foreach($blogs as $blog)
        <div class="col-md-4">
            <div class="card h-100 blog-card" style="border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image" style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                @else
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Default Blog Image" style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                @endif
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title mb-3" style="font-weight: bold; color: #34495e; font-size: 1.25rem;">{{ $blog->title }}</h5>
                    <p class="card-text text-muted mb-4" style="line-height: 1.5;">{{ Str::limit($blog->content, 120, '...') }}</p>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary mt-auto read-more-btn" style="background-color: #3498db; border: none; border-radius: 8px; font-size: 0.9rem; padding: 10px 20px; text-transform: uppercase; transition: all 0.3s ease;">
                        Read More
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Card hover effect */
    .blog-card:hover {
        transform: scale(1.01);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    /* Read More Button hover effect */
    .read-more-btn:hover {
        background-color: #1d6fa5;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    /* General typography for card text */
    .card-title {
        font-weight: bold;
        color: #34495e;
    }

    .card-text {
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-img-top {
            height: 150px;
        }
    }

    @media (max-width: 576px) {
        .card-title {
            font-size: 1rem;
        }

        .read-more-btn {
            font-size: 0.8rem;
            padding: 8px 16px;
        }
    }
</style>
@endsection
