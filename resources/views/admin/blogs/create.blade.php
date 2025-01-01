@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 900px;">
    <h1 class="text-center mb-4" style="color: #2c3e50; font-weight: bold; font-size: 32px;">Create Blog</h1>
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
        @csrf
        <div class="form-group mb-4">
            <label for="title" style="font-size: 18px; font-weight: bold; color: #2c3e50;">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required style="padding: 15px; font-size: 16px; border-radius: 8px; border: 1px solid #ddd; width: 100%;">
        </div>
        <div class="form-group mb-4">
            <label for="content" style="font-size: 18px; font-weight: bold; color: #2c3e50;">Content</label>
            <textarea class="form-control" id="content" name="content" rows="8" placeholder="Write your blog content here" required style="padding: 15px; font-size: 16px; border-radius: 8px; border: 1px solid #ddd; width: 100%;"></textarea>
        </div>
        <div class="form-group mb-4">
            <label for="image" style="font-size: 18px; font-weight: bold; color: #2c3e50;">Image</label>
            <input type="file" class="form-control" id="image" name="image" style="padding: 10px; font-size: 16px; border-radius: 8px; border: 1px solid #ddd; width: 100%;">
        </div>
        <div class="form-group mb-4">
            <label for="video_link" style="font-size: 18px; font-weight: bold; color: #2c3e50;">Video Link</label>
            <input type="url" class="form-control" id="video_link" name="video_link" placeholder="https://example.com" style="padding: 15px; font-size: 16px; border-radius: 8px; border: 1px solid #ddd; width: 100%;">
        </div>
        <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 15px; border-radius: 8px; width: 100%; background-color: #28a745; border: none; transition: all 0.3s ease;"
        onmouseover="this.style.backgroundColor='#218838';" onmouseout="this.style.backgroundColor='#28a745';">
            Publish Blog
        </button>
    </form>
</div>
@endsection
