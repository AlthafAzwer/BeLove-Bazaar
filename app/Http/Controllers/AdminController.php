<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product; // Correctly ensure this is used from the Models namespace
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductApprovalNotification;
use App\Mail\ProductRejectionNotification;
use App\Models\Order;
use App\Models\CharityRequest; // Include the CharityRequest model
use App\Models\Auction; // Include the Auction model
use App\Models\Bid; // Include the Bid model
use App\Models\Review; // Include the Review model
use App\Models\AuctionOrder; // Include the AuctionOrder model

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
    $totalCharities = CharityRequest::where('status', 'approved')->count();
    $totalReviews = Review::count(); // Count all reviews

    $approvedAuctions = Auction::where('status', 'approved')->count();
    $totalBids = Bid::count();
    

    return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders', 'totalCharities',  'approvedAuctions', 'totalBids', 'totalReviews'));
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

public function manageCharities()
    {
        // Fetch all pending charity requests with pagination (10 per page)
        $charityRequests = CharityRequest::where('status', 'pending')->paginate(10);

        return view('admin.charities.index', compact('charityRequests'));
    }

    /**
     * Approve a charity request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveCharity($id)
    {
        // Find the charity request by ID
        $charityRequest = CharityRequest::findOrFail($id);

        // Update status to approved
        $charityRequest->status = 'approved';
        $charityRequest->save();

        return redirect()->route('admin.charities')->with('success', 'Charity request approved successfully.');
    }

    /**
     * Reject a charity request with a rejection reason.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectCharity(Request $request, $id)
    {
        // Validate the rejection reason input
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Find the charity request by ID
        $charityRequest = CharityRequest::findOrFail($id);

        // Update status to rejected and store rejection reason
        $charityRequest->status = 'rejected';
        $charityRequest->rejection_reason = $request->input('reason');
        $charityRequest->save();

        return redirect()->route('admin.charities')->with('success', 'Charity request rejected successfully.');
    }

    public function manageDonations()
{
    // Fetch only approved charity requests
    $donations = CharityRequest::where('status', 'approved')->get();
    return view('admin.manage-donations', compact('donations'));
}

    
    public function deleteDonation($id)
    {
        // Find the donation request by ID and delete it
        $donation = CharityRequest::findOrFail($id);
        $donation->delete();
    
        // Redirect back with a success message
        return redirect()->route('admin.donations')->with('success', 'Donation deleted successfully.');
    }

    public function manageAuctions()
    {
        $auctions = Auction::where('status', 'pending')->get();
        return view('admin.auctions.index', compact('auctions'));
    }
    
    /**
     * Approve an auction.
     */
    public function approveAuction($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->status = 'approved';
        $auction->save();
    
        return redirect()->route('admin.auctions.index')->with('success', 'Auction approved successfully!');
    }
    
    /**
     * Reject an auction with a reason.
     */
    public function rejectAuction(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);
    
        $auction = Auction::findOrFail($id);
        $auction->status = 'rejected';
        $auction->rejection_reason = $request->rejection_reason;
        $auction->save();
    
        return redirect()->route('admin.auctions.index')->with('success', 'Auction rejected successfully!');
    }

    public function showLiveAuctions()
{
    $auctions = Auction::where('status', 'approved')->get();
    return view('admin.auctions.manage-auctions', compact('auctions'));

}

public function deleteAuction($id)
{
    $auction = Auction::findOrFail($id);
    $auction->delete();

    return redirect()->route('admin.manageAuctions')->with('success', 'Auction deleted successfully!');
}

public function showBids()
{
    // Fetch all bids with related auction and user data
    $bids = Bid::with(['auction', 'user'])->get();
    return view('admin.auctions.manage-bids', compact('bids'));
}

public function deleteBid($id)
{
    $bid = Bid::findOrFail($id); // Find the bid or throw 404
    $bid->delete(); // Delete the bid

    return redirect()->route('admin.manageBids')->with('success', 'Bid deleted successfully!');
}

public function manageAuctionOrders()
{
    // Fetch all auction orders with related auction and buyer info
    $auctionOrders = AuctionOrder::with('auction')->get();

    // Return the view for managing auction orders
    return view('admin.manage_auction_orders', compact('auctionOrders'));
}

public function deleteAuctionOrder($id)
{
    // Find and delete the auction order by ID
    $auctionOrder = AuctionOrder::findOrFail($id);
    $auctionOrder->delete();

    // Redirect back with a success message
    return redirect()->route('admin.auction_orders')->with('success', 'Auction Order deleted successfully!');
}

}

// Separate AdminProductController for handling product approval and rejection
