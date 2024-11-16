<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Show the form for creating a new product listing.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create'); // Ensure this view exists in resources/views/products/create.blade.php
    }

    /**
     * Store a newly created product listing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'condition' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
            'contact_info' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public'); // Store each image in 'public/product_images'
                $imagePaths[] = $path;
            }
        }

        // Create the product with the authenticated user's ID
        Product::create([
            'user_id' => Auth::id(), // Associate product with the logged-in user
            'category' => $request->category,
            'title' => $request->title,
            'condition' => $request->condition,
            'location' => $request->location,
            'price' => $request->price,
            'description' => $request->description,
            'images' => json_encode($imagePaths), // Store image paths as JSON
            'contact_info' => $request->contact_info,
            'status' => 'pending', // Set default status to pending
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Your ad has been submitted for review.');
    }

    // ProductController.php (or HomeController if products are displayed there)
// ProductController.php
public function showProducts()
{
    // Fetch only approved products
    $products = Product::where('status', 'approved')->paginate(12);
    return view('products.index', compact('products'));
}

// ProductController.php
// ProductController.php
public function myAds()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // Fetch all ads posted by the authenticated user
        $userAds = Product::where('user_id', Auth::id())->get();

        return view('products.my_ads', compact('userAds'));
    } else {
        // Redirect to login page if not authenticated
        return redirect()->route('login')->with('error', 'Please log in to view your ads.');
    }
}

public function index(Request $request)
    {
        // Start a base query for approved products only
        $query = Product::where('status', 'approved');

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by location if provided
        if ($request->has('location') && $request->location) {
            $query->where('location', $request->location);
        }

        // Search by title or description if a search query is provided
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Sort by price if requested
        if ($request->has('sort')) {
            if ($request->sort === 'price_low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high_low') {
                $query->orderBy('price', 'desc');
            }
        }

        // Paginate the results
        $products = $query->paginate(12);

        // Get all unique categories and locations for the dropdown filters
        $categories = Product::select('category')->distinct()->pluck('category');
        $locations = Product::select('location')->distinct()->pluck('location');

        return view('users.products', compact('products', 'categories', 'locations'));
    }

    public function destroy(Product $product)
{
    // Check if the authenticated user is the owner of the product
    if ($product->user_id !== Auth::id()) {
        return redirect()->route('my.ads')->with('error', 'Unauthorized action.');
    }

    $product->delete();

    return redirect()->route('my.ads')->with('success', 'Ad deleted successfully.');
}



}
