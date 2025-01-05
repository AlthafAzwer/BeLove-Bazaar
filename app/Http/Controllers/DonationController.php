<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function create($charity_id)
{
    return view('donations.create', compact('charity_id'));
}


public function store(Request $request)
{
    $request->validate([
        'charity_id' => 'required|integer',
        'item_description' => 'required|string',
        'quantity' => 'required|integer',
        'delivery_preference' => 'required|string|in:Pickup,Delivery',
    ]);

    Donation::create([
        'user_id' =>  Auth::id(),
        'charity_id' => $request->charity_id,
        'item_description' => $request->item_description,
        'quantity' => $request->quantity,
        'delivery_preference' => $request->delivery_preference,
        'status' => 'Pending',
    ]);

    return redirect()->route('donation-list')->with('success', 'Donation submitted successfully.');
}
}
