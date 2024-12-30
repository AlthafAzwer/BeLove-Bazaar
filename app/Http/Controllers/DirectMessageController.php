<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DirectMessageController extends Controller
{
    /**
     * Show the list of all contacts (users) the current user has messages with.
     */
    public function index()
    {
        $authUser = Auth::user();

        // 1. All user IDs who sent messages TO me
        $contactsFromSenders = Message::where('receiver_id', $authUser->id)
            ->pluck('sender_id');

        // 2. All user IDs who received MY messages
        $contactsFromReceivers = Message::where('sender_id', $authUser->id)
            ->pluck('receiver_id');

        // 3. Merge & unique => all user IDs I've chatted with
        $allContactIds = $contactsFromSenders->merge($contactsFromReceivers)->unique();

        // 4. Fetch those user models
        $contacts = User::whereIn('id', $allContactIds)->get();

        // 5. Return the index view with the list of contacts
        return view('messages.index', compact('contacts'));
    }

    /**
     * Show all messages between the authenticated user and the given $otherUserId.
     */
    public function show($otherUserId)
    {
        $authUserId = Auth::id();

        // 1. Retrieve messages where (me->other OR other->me)
        $messages = Message::where(function ($q) use ($authUserId, $otherUserId) {
                $q->where('sender_id', $authUserId)
                  ->where('receiver_id', $otherUserId);
            })
            ->orWhere(function ($q) use ($authUserId, $otherUserId) {
                $q->where('sender_id', $otherUserId)
                  ->where('receiver_id', $authUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // 2. (Optional) Mark messages as read if needed
        // Message::where('receiver_id', $authUserId)
        //        ->where('sender_id', $otherUserId)
        //        ->whereNull('read_at')
        //        ->update(['read_at' => now()]);

        // 3. Determine product name from the first message (if any)
        $productName = null;
        if ($messages->count() > 0) {
            $productName = $messages->first()->product_name;
        }

        // 4. Load the other user
        $otherUser = User::findOrFail($otherUserId);

        // 5. Return the chat view
        return view('messages.show', compact('messages', 'otherUser', 'productName'));
    }

    /**
     * Store a new message in the 'messages' table, including optional product_name.
     */
    public function store(Request $request, $otherUserId)
    {
        // If you want to allow empty content, comment out or relax the validation
        // e.g. 'content' => 'sometimes|string|nullable'
        $request->validate([
            // 'content' => 'required|string',
        ]);

        Message::create([
            'sender_id'    => Auth::id(),
            'receiver_id'  => $otherUserId,
            'content'      => $request->input('content', ''),   // default to empty if missing
            'product_name' => $request->input('product_name'),  // from hidden input or null
        ]);

        // Redirect to show the conversation
        return redirect()->route('messages.show', $otherUserId);
    }
}
