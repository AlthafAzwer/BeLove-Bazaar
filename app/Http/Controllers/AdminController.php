<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product; // Correctly ensure this is used from the Models namespace
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductApprovalNotification;
use App\Mail\ProductRejectionNotification;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
{
    $totalUsers = User::count();
    $totalProducts = Product::count();
    $totalOrders = Order::count();

    return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders'));
}


    /**
     * Display a list of users for management purposes.
     *
     * @return \Illuminate\View\View
     */
    public function manageUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.users.index', compact('users'));
    }

    // Method to delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Display a list of ads for approval or rejection.
     *
     * @return \Illuminate\View\View
     */
    public function manageAds()
{
    // Fetch all pending ads
    $pendingAds = Product::where('status', 'pending')->get();

    // Pass the pending ads to the view
    return view('admin.ads.index', compact('pendingAds'));
}


    /**
     * Display categories for management.
     *
     * @return \Illuminate\View\View
     */
    public function manageCategories()
    {
        return view('admin.categories.index'); // Ensure this view exists
    }

    public function approveAd($id)
{
    $ad = Product::findOrFail($id);
    $ad->status = 'approved';
    $ad->save();

    // Notify the user (You can use a notification or mail system to notify the user here)
    // For now, you can add a flash message
    return redirect()->route('admin.ads.index')->with('success', 'Ad approved successfully.');
}

public function rejectAd(Request $request, $id)
{
    $ad = Product::findOrFail($id);
    $ad->status = 'rejected';
    $ad->rejection_reason = $request->input('rejection_reason');
    $ad->save();

    // Notify the user about the rejection (via mail/notification)
    return redirect()->route('admin.ads.index')->with('success', 'Ad rejected and user notified.');
}

public function manageProducts()
{
    // Fetch all products for admin management
    $products = Product::all(); // You can modify this query to include filters or pagination as needed
    return view('admin.products.index', compact('products'));
}

public function manageOrders()
    {
        // Fetch all orders for admin management
        $orders = Order::with('product', 'buyer')->get(); // Eager load product and buyer information
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrder(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|string|in:pending,shipped,completed',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
}

public function destroyProduct($id)
{
    $product = Product::findOrFail($id); // Ensure the product exists
    $product->delete(); // Delete the product

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}

public function destroyOrder($id)
{
    // Find the order by its ID
    $order = Order::findOrFail($id);

    // Delete the order
    $order->delete();

    // Redirect back to the orders list with a success message
    return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
}




    
}

// Separate AdminProductController for handling product approval and rejection
