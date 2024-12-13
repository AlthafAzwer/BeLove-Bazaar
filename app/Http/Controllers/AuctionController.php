<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;

class AuctionController extends Controller
{
    /**
     * Display the form for creating a new auction.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = ['Electronics', 'Furniture', 'Clothing', 'Books', 'Toys', 'Home Appliances', 'Sports'];
        $locations = ['All of Sri Lanka', 'Colombo 1', 'Colombo 2', 'Colombo 3', 'Colombo 4', 'Colombo 5', 'Colombo 6', 'Colombo 7', 'Colombo 8', 'Colombo 9', 'Colombo 10', 'Colombo 11', 'Colombo 12', 'Colombo 13', 'Colombo 14', 'Colombo 15'];
        return view('auctions.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created auction in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'condition' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'start_bid' => 'required|numeric|min:0',
            'max_bid' => 'required|numeric|min:0|gte:start_bid',
            'duration' => 'required|integer|min:1',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_info' => 'required|string|max:255',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('auction_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create the auction
        Auction::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'title' => $request->title,
            'condition' => $request->condition,
            'location' => $request->location,
            'description' => $request->description,
            'start_bid' => $request->start_bid,
            'max_bid' => $request->max_bid,
            'duration' => $request->duration,
            'images' => json_encode($imagePaths),
            'contact_info' => $request->contact_info,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Auction submitted for review.');
    }

    /**
     * Display a listing of approved auctions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $auctions = Auction::where('status', 'approved')->get();
        return view('auctions.index', compact('auctions'));
    }

    /**
     * Display the user's auctions.
     *
     * @return \Illuminate\View\View
     */
    public function myAuctions()
    {
        $auctions = Auction::where('user_id', Auth::id())->get();
        return view('auctions.my', compact('auctions'));
    }

    /**
     * Show the details of a specific auction.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\View\View
     */
    public function show(Auction $auction)
    {
        return view('auctions.show', compact('auction'));
    }

    public function destroy($id)
{
    $auction = Auction::findOrFail($id);

    // Ensure only the owner can delete the auction
    if ($auction->user_id !== Auth::id()) {
        return redirect()->route('auctions.my')->with('error', 'Unauthorized action.');
    }

    $auction->delete();

    return redirect()->route('auctions.my')->with('success', 'Auction deleted successfully.');
}

public function showBidPage($id)
{
    $auction = Auction::findOrFail($id); // Fetch the auction
    $highestBid = Bid::where('auction_id', $id)->max('bid_amount'); // Get the highest bid for this auction
    return view('auctions.bid', compact('auction', 'highestBid')); // Pass data to the view
}


public function placeBid(Request $request, $id)
{
    $request->validate([
        'bid_amount' => 'required|numeric|min:0',
    ]);

    $auction = Auction::findOrFail($id); // Find the auction
    $highestBid = Bid::where('auction_id', $id)->max('bid_amount'); // Get the current highest bid

    if ($request->bid_amount <= ($highestBid ?? $auction->start_bid)) {
        return redirect()->back()->with('error', 'Your bid must be higher than the current highest bid.');
    }

    // Save the new bid
    Bid::create([
        'auction_id' => $id,
        'user_id' => Auth::id(), // Assuming the user is logged in
        'bid_amount' => $request->bid_amount,
    ]);

    return redirect()->route('auctions.placeBid', $id)->with('success', 'Your bid has been placed successfully!');
}


}
