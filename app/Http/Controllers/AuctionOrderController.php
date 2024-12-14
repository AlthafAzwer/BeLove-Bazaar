<?php

namespace App\Http\Controllers;

use App\Models\AuctionOrder;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionOrderController extends Controller
{
    /**
     * Store a newly created auction order by the buyer.
     *
     * @param Request $request
     * @param Auction $auction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Auction $auction)
    {
        // Validate the request data
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string|max:500',
            'buyer_phone' => 'required|string|max:15',
        ]);

        // Create a new auction order
        AuctionOrder::create([
            'auction_id' => $auction->id,
            'buyer_id' => Auth::id(), // Current logged-in user as the buyer
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'buyer_phone' => $request->buyer_phone,
            'status' => 'pending', // Set initial status as pending
        ]);

        // Redirect back with a success message
        return redirect()->route('auction_orders.index')
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Display a listing of auction orders for the seller.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current authenticated user's ID
        $currentUserId = Auth::id();

        // Fetch orders for auctions where the current user is the seller
        $orders = AuctionOrder::whereHas('auction', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId); // Ensure the auction belongs to the seller
        })->with('auction')->get();

        // Pass orders to the view
        return view('seller.auction_orders', compact('orders'));
    }
}
