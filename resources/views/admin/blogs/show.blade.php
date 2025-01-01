@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 800px;">
    <!-- Blog Title -->
    <h1 class="text-center mb-4" style="color: #2c3e50; font-weight: bold; font-size: 28px;">
        {{ $blog->title }}
    </h1>
    
    <!-- Blog Image -->
    @if($blog->image)
    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" 
             style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
    </div>
    @endif

    <!-- Blog Content -->
    <div class="mb-4" style="font-size: 18px; line-height: 1.6; color: #34495e;">
        {!! nl2br(e($blog->content)) !!}
    </div>

    <!-- Blog Video -->
    @if($blog->video_link)
<div class="mt-4" style="text-align: center;">
    <a href="{{ $blog->video_link }}" target="_blank" style="
        font-size: 16px; 
        color: #3498db; 
        text-decoration: underline;
        font-weight: bold;
        transition: color 0.3s ease;"
        onmouseover="this.style.color='#1abc9c';"
        onmouseout="this.style.color='#3498db';">
        View Video
    </a>
</div>
@endif


    <!-- Back Button -->
    <div class="text-center mt-5">
        <a href="{{ route('admin.blogs.index') }}" class="btn" style="
            font-size: 16px; 
            padding: 12px 25px; 
            border-radius: 8px; 
            background: linear-gradient(135deg, #3498db, #2980b9); 
            color: white; 
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            border: none; 
            transition: all 0.3s ease;"
            onmouseover="this.style.background='linear-gradient(135deg, #2980b9, #1c6690)';"
            onmouseout="this.style.background='linear-gradient(135deg, #3498db, #2980b9)';">
            Back to Blogs
        </a>
    </div>
</div>
@endsection
