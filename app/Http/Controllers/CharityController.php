<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CharityRequest;

class CharityController extends Controller
{
    /**
     * Display the charity request creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('charity.create');
    }

    /**
     * Store a new charity request in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a charity request.');
        }

        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'certification' => 'required|file|mimes:pdf,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        $logoPath = $request->file('logo')->store('logos', 'public');
        $certificationPath = $request->file('certification')->store('certifications', 'public');

        // Save charity request to database
        CharityRequest::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'logo' => $logoPath,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'certification' => $certificationPath,
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('charity.request')->with('success', 'Your charity request has been submitted for review.');
    }

    /**
     * Display the charity requests of the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function myRequests()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your charity requests.');
        }

        // Fetch charity requests of the authenticated user
        $requests = CharityRequest::where('user_id', Auth::id())->get();

        return view('charity.my-requests', compact('requests'));
    }
    public function donationList()
{
    $approvedCharities = CharityRequest::where('status', 'approved')->get();
    return view('donations.list', compact('approvedCharities'));
}

public function myCharities()
{
    $charityRequests = CharityRequest::where('user_id', Auth::id())->get();
    return view('charities.index', compact('charityRequests'));
}


public function deleteCharity($id)
{
    $charity = CharityRequest::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $charity->delete();

    return redirect()->route('charities.index')->with('success', 'Charity request deleted successfully.');
}

public function search(Request $request)
{
    $query = $request->input('query');

    // Search for approved charities with matching descriptions
    $approvedCharities = CharityRequest::where('description', 'LIKE', '%' . $query . '%')
        ->where('status', 'approved') // Ensure you only get approved ones
        ->get();

    // Return the view with the filtered data
    return view('donations.list', compact('approvedCharities'));
}




}
