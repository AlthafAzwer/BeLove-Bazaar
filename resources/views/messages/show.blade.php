@extends('layouts.user')

@section('content')
<div style="
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
">
    @php
        /**
         * 1) If the controller gave us $productName, use it. Otherwise, 
         *    find any message in $messages that has a non-null product_name.
         *    We'll grab the LAST such product_name to display.
         */
        $nonNullProductName = $messages
            ->pluck('product_name')   // Extract just product_name values
            ->filter()                // Remove null/empty
            ->last();                 // Get the last non-null
        $productName = $productName ?? $nonNullProductName;
    @endphp

    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px;">
        Chat with {{ $otherUser->name }}
    </h1>

    @if($productName)
        <h2 style="font-size: 18px; color: #555; margin-bottom: 20px;">
            Product: {{ $productName }}
        </h2>
    @endif

    <!-- 2) The chat messages container -->
    <div style="
        border: 1px solid #ccc;
        border-radius: 6px;
        height: 400px;
        overflow-y: auto;
        padding: 10px;
        margin-bottom: 15px;
    ">
        @foreach($messages as $msg)
            @if($msg->sender_id === auth()->id())
                <!-- Sent by me (align right, greenish background) -->
                <div style="text-align: right; margin-bottom: 10px;">
                    <div style="
                        display: inline-block;
                        background-color: #d4edda;
                        padding: 8px 12px;
                        border-radius: 8px;
                        max-width: 70%;
                        word-wrap: break-word;
                    ">
                        <p style="margin: 0; color: #333; font-size: 14px;">
                            {{ $msg->content }}
                        </p>
                        <small style="font-size: 12px; color: #666;">
                            {{ $msg->created_at->format('H:i') }}
                        </small>
                    </div>
                </div>
            @else
                <!-- Received (align left, gray background) -->
                <div style="text-align: left; margin-bottom: 10px;">
                    <div style="
                        display: inline-block;
                        background-color: #f0f0f0;
                        padding: 8px 12px;
                        border-radius: 8px;
                        max-width: 70%;
                        word-wrap: break-word;
                    ">
                        <p style="margin: 0; color: #333; font-size: 14px;">
                            {{ $msg->content }}
                        </p>
                        <small style="font-size: 12px; color: #666;">
                            {{ $msg->created_at->format('H:i') }}
                        </small>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- 3) Form to send a new message -->
    <form action="{{ route('messages.store', $otherUser->id) }}" method="POST"
          style="display: flex; gap: 10px;">
        @csrf

        <!-- Hidden input: store the product name the user is chatting about -->
        <input type="hidden" name="product_name" value="{{ $productName }}">

        <textarea name="content" rows="1" required
                  style="
                      flex: 1;
                      border-radius: 4px;
                      border: 1px solid #ccc;
                      padding: 8px;
                      font-size: 14px;
                      resize: none;
                  "></textarea>
        
        <button type="submit" style="
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;"
            onmouseover="this.style.backgroundColor='#0056b3'"
            onmouseout="this.style.backgroundColor='#007BFF'">
            Send
        </button>
    </form>
</div>
@endsection
