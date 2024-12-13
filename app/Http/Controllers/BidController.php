<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function myBids()
    {
        // Fetch all bids placed by the logged-in user
        $bids = Bid::with('auction') // Eager load the related auction
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc') // Show the most recent bids first
                    ->get();

        // Return the view with the bids
        return view('bids.myBids', compact('bids'));
    }

    public function proceedToBuy($id)
{
    $bid = Bid::with('auction')->findOrFail($id);

    // Ensure the bid status is "won"
    if ($bid->status !== 'won') {
        return redirect()->route('bids.index')->with('error', 'You can only proceed for bids you have won.');
    }

    return view('bids.proceed', compact('bid'));
}

}
