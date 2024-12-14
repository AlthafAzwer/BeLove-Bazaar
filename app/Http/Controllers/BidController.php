<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display the user's bids.
     *
     * @return \Illuminate\View\View
     */
    public function myBids()
    {
        $bids = Bid::with(['auction' => function ($query) {
            $query->select('id', 'title', 'end_time', 'auction_state');
        }])->where('user_id', Auth::id())->get();

        return view('bids.myBids', compact('bids'));
    }

    /**
     * Show the purchase form for a winning bid.
     *
     * @param  int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showPurchaseForm($id)
    {
        $bid = Bid::with('auction')->findOrFail($id);

        // Ensure the user is the winner of the bid
        if ($bid->status !== 'won' || Auth::id() !== $bid->user_id) {
            return redirect()->route('bids.myBids')->with('error', 'Unauthorized access to purchase.');
        }

        return view('bids.purchase', compact('bid'));
    }

    /**
     * Process the purchase request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitPurchaseForm(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15',
        ]);

        $bid = Bid::with('auction')->findOrFail($id);

        // Ensure the user is the winner of the bid
        if ($bid->status !== 'won' || Auth::id() !== $bid->user_id) {
            return redirect()->route('bids.myBids')->with('error', 'Unauthorized access to purchase.');
        }

        // Create the order
        Order::create([
            'auction_id' => $bid->auction->id,
            'bid_id' => $bid->id,
            'buyer_id' => $bid->user_id,
            'seller_id' => $bid->auction->user_id,
            'product_title' => $bid->auction->title,
            'amount' => $bid->bid_amount,
            'buyer_name' => $request->name,
            'buyer_address' => $request->address,
            'buyer_phone' => $request->phone,
            'status' => 'pending', // Mark the order as pending initially
        ]);

        return redirect()->route('bids.myBids')->with('success', 'Your purchase has been successfully submitted!');
    }
}
