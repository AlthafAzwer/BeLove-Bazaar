@extends('layouts.user')

@section('content')
<div class="container mt-5" style="max-width: 1200px;">
    <!-- Blog Title -->
    <h1 class="text-center mb-4" style="font-weight: bold; color: #2c3e50; font-size: 2rem;">
        {{ $blog->title }}
    </h1>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-start;">
        <!-- Blog Image -->
        @if($blog->image)
        <div style="flex: 1 1 40%; text-align: center;">
            <img 
                src="{{ asset('storage/' . $blog->image) }}" 
                alt="{{ $blog->title }}" 
                style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        </div>
        @endif

        <!-- Blog Content -->
        <div style="flex: 1 1 55%; font-size: 1rem; line-height: 1.7; color: #555; text-align: justify;">
            {{ $blog->content }}
        </div>
    </div>

    <!-- Video Link -->
    @if($blog->video_link)
    <div class="text-center mt-4">
        <a href="{{ $blog->video_link }}" target="_blank" style="
            display: inline-block;
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease;
        " onmouseover="this.style.backgroundColor='#1d6fa5';" onmouseout="this.style.backgroundColor='#3498db';">
            Watch Video
        </a>
    </div>
    @endif
</div>

<style>
    /* Responsive Styling */
    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .content-text {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 1.5rem;
        }

        .content-text {
            font-size: 0.85rem;
        }
    }
</style>
@endsection
