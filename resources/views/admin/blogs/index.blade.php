@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 1200px;">
    <!-- Page Header -->
    <h1 class="text-center mb-4" style="color: #2c3e50; font-weight: bold; font-size: 32px;">All Blogs</h1>
    
    <!-- Create Blog Button -->
    <div class="text-end" style="margin-bottom: 30px;">
        <a href="{{ route('admin.blogs.create') }}" class="btn" style="
            font-size: 18px; 
            padding: 12px 25px; 
            border-radius: 8px; 
            background: linear-gradient(135deg, #3498db, #2980b9); 
            color: white; 
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            border: none; 
            transition: all 0.3s ease;"
            onmouseover="this.style.background='linear-gradient(135deg, #2980b9, #1c6690)';"
            onmouseout="this.style.background='linear-gradient(135deg, #3498db, #2980b9)';">
            Create Blog
        </a>
    </div>
    
    <!-- Blogs Table -->
    <div class="table-responsive">
        <table class="table table-hover" style="
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); 
            border-radius: 12px; 
            overflow: hidden; 
            background-color: white;">
            <thead style="background-color: #3498db; color: white;">
                <tr>
                    <th style="padding: 15px; font-size: 16px;">Title</th>
                    <th style="padding: 15px; font-size: 16px;">Image</th>
                    <th style="padding: 15px; font-size: 16px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr style="transition: all 0.3s ease; cursor: pointer;" 
                    onmouseover="this.style.backgroundColor='#f2f8fd';" 
                    onmouseout="this.style.backgroundColor='white';">
                    <td style="padding: 15px; font-size: 18px; font-weight: 600; color: #34495e;">
                        {{ $blog->title }}
                    </td>
                    <td style="padding: 15px;">
                        @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" 
                            width="120" style="
                            border-radius: 10px; 
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        @else
                        <span style="color: #7f8c8d;">No Image</span>
                        @endif
                    </td>
                    <td style="padding: 15px;">
                        <!-- View Button -->
                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn" style="
                            font-size: 14px; 
                            padding: 8px 15px; 
                            border-radius: 8px; 
                            background: #1abc9c; 
                            color: white; 
                            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                            border: none; 
                            transition: all 0.3s ease;"
                            onmouseover="this.style.background='#16a085';"
                            onmouseout="this.style.background='#1abc9c';">
                            View
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="
                                font-size: 14px; 
                                padding: 8px 15px; 
                                border-radius: 8px; 
                                background: #e74c3c; 
                                color: white; 
                                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                                border: none; 
                                transition: all 0.3s ease;"
                                onmouseover="this.style.background='#c0392b';"
                                onmouseout="this.style.background='#e74c3c';">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
