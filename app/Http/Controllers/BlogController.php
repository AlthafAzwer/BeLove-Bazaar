<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs for the user side.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch blogs in descending order of creation
        $blogs = Blog::latest()->get();

        // Return the user-side blog view
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display a single blog post.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Fetch the blog by ID
        $blog = Blog::findOrFail($id);

        // Return the detailed blog view
        return view('blogs.show', compact('blog'));
    }
}
