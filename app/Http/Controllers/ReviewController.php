<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display the review creation form.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function create(Order $order)
    {
        // Ensure the order is completed before allowing a review
        if ($order->status !== 'Completed') {
            return redirect()->route('orders.index')->with('error', 'You can only review completed orders.');
        }

        return view('reviews.create', compact('order'));
    }

    /**
     * Store a new review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $orderId)
    {
        // Fetch the order using the ID
        $order = Order::findOrFail($orderId);

        // Ensure the order is completed before allowing a review
        if ($order->status !== 'Completed') {
            return redirect()->route('orders.index')->with('error', 'You can only review completed orders.');
        }

        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Create the review for the completed order
        Review::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'user_id' => Auth::id(), // Use Auth facade
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Redirect to the reviews page after successful submission
        return redirect()->route('user.reviews')->with('success', 'Review submitted successfully!');

    }

    /**
     * Display all reviews for admin management.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all reviews with related user and product
        $reviews = Review::with(['user', 'product'])->get();
    
        // Return the view for displaying reviews
        return view('user_reviews', compact('reviews'));
    }
    
    

    /**
     * Delete a review.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }

    public function userReviews()
{
    // Fetch all reviews with related product and user data
    $reviews = Review::with('product', 'user')->get();

    return view('reviews.user_reviews', compact('reviews'));
}

public function adminIndex()
{
    // Fetch all reviews with related product and user information
    $reviews = Review::with(['product', 'user'])->get();

    return view('admin.reviews.index', compact('reviews'));
}


public function destroyUser(Review $review)
{
    if ($review->user_id !== Auth::id()) {
        return redirect()->route('user.reviews')->with('error', 'Unauthorized action.');
    }

    $review->delete();

    return redirect()->route('user.reviews')->with('success', 'Review deleted successfully!');
}

}
