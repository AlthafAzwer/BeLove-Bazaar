<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome'); // This renders the welcome page
    }

    public function index()
    {
        return view('home'); // This will render the homepage with banner, categories, and products
    }

    // Other methods like products, donations, blog, etc., should go here as well
    public function showProducts(Request $request)
{
    $query = Product::query();

    // Filter by category if selected
    if ($request->has('category') && $request->category) {
        $query->where('category', $request->category);
    }

    // Filter by location if selected
    if ($request->has('location') && $request->location) {
        $query->where('location', $request->location);
    }

    // Search functionality
    if ($request->has('search') && $request->search) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'LIKE', '%' . $request->search . '%')
              ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        });
    }

    // Sort by price if selected
    if ($request->has('sort') && $request->sort == 'price_low_high') {
        $query->orderBy('price', 'asc');
    } elseif ($request->has('sort') && $request->sort == 'price_high_low') {
        $query->orderBy('price', 'desc');
    }

    $products = $query->where('status', 'approved')->paginate(12);

    // Fetch unique categories and locations for filter options
    $categories = Product::select('category')->distinct()->pluck('category');
    $locations = Product::select('location')->distinct()->pluck('location');

    return view('products', compact('products', 'categories', 'locations'));
}
    
    public function postAd()
    {
        return view('user.post_ad'); // Ensure the view file exists at resources/views/user/post_ad.blade.php
    }

    // Method to handle the ad submission
    public function submitAd(Request $request)
    {
        // Validate request data
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'condition' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array', // Adjust validation based on your requirements
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image if they are files
            'contact_info' => 'required|string|max:255',
        ]);

        // Handle file upload and store image paths
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/products', 'public'); // Store in public disk
                $imagePaths[] = $path;
            }
        }

        // Create a new product listing
        Product::create([
            'category' => $request->input('category'),
            'title' => $request->input('title'),
            'condition' => $request->input('condition'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'images' => $imagePaths, // Store the array of paths
            'contact_info' => $request->input('contact_info'),
            'status' => 'pending', // Set default status to pending
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Ad submitted for approval.');
    }

    // HomeController.php
public function showProductDetails($id)
{
    $product = Product::findOrFail($id); // Retrieve the product by ID or fail if not found
    return view('products.show', compact('product'));
}

public function showHome()
{
    // 1) Fetch 4 "approved" products (change logic as needed)
    $hotProducts = Product::where('status', 'approved')
        ->orderBy('id', 'desc')
        ->take(4)
        ->get();

    // 2) Return the 'home' view with $hotProducts
    return view('home', compact('hotProducts'));
}



}
