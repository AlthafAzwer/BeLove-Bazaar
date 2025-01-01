<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    // Show all blogs in the admin panel
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show the create blog form
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Store a new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_link' => 'nullable|url',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'video_link' => $request->video_link,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }
    
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
    
        // Delete the image from storage if it exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
    
        $blog->delete();
    
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
    

}

