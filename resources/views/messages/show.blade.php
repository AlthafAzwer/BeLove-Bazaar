@extends('layouts.user')

@section('content')
<div style="
    /* Full-screen gradient background */
    min-height: 100vh; 
    margin: 0;
    padding: 0; 
    display: flex; 
    flex-direction: column;
    align-items: center; 
    justify-content: center; 
    background: linear-gradient(135deg, #d8e5f5 0%, #f7f7f7 100%);
    font-family: Arial, sans-serif;
">

    @php
        // Determine the productName if not already set
        $nonNullProductName = $messages
            ->pluck('product_name')
            ->filter()
            ->last();
        $productName = $productName ?? $nonNullProductName;
    @endphp

    <!-- Chat container -->
    <div style="
        background-color: #fff;
        width: 90%;
        max-width: 1100px;
        height: 90vh; /* fill most of the screen vertically */
        margin: 20px auto; 
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    ">

        <!-- Header area -->
        <div style="
            padding: 24px; 
            border-bottom: 1px solid #ddd; 
            background-color: #fafafa;
        ">
            <h1 style="
                font-size: 26px; 
                color: #333; 
                margin: 0 0 6px 0;
                font-weight: 700;
            ">
                Chat with {{ $otherUser->name }}
            </h1>

            @if($productName)
                <h2 style="
                    font-size: 18px; 
                    color: #666; 
                    margin: 0;
                    font-weight: 400;
                ">
                    Product: {{ $productName }}
                </h2>
            @endif
        </div>

        <!-- Messages area (scrollable) -->
        <div style="
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #fefefe;
        ">
            @foreach($messages as $msg)
                @if($msg->sender_id === auth()->id())
                    <!-- Sent by me -->
                    <div style="
                        display: flex; 
                        justify-content: flex-end; 
                        margin-bottom: 10px;
                    ">
                        <div style="
                            background-color: #d4edda; /* light greenish for 'sent' bubble */
                            padding: 10px 14px;
                            border-radius: 12px;
                            max-width: 60%;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            transition: transform 0.2s;
                        "
                        onmouseover="this.style.transform='scale(1.02)'"
                        onmouseout="this.style.transform='scale(1)'">
                            <p style="
                                margin: 0; 
                                color: #333; 
                                font-size: 15px;
                                line-height: 1.4;
                            ">
                                {{ $msg->content }}
                            </p>
                            <small style="
                                font-size: 12px; 
                                color: #666;
                                display: block;
                                margin-top: 4px;
                                text-align: right;
                            ">
                                {{ $msg->created_at->format('H:i') }}
                            </small>
                        </div>
                    </div>
                @else
                    <!-- Received -->
                    <div style="
                        display: flex; 
                        justify-content: flex-start; 
                        margin-bottom: 10px;
                    ">
                        <div style="
                            background-color: #f0f0f0;
                            padding: 10px 14px;
                            border-radius: 12px;
                            max-width: 60%;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            transition: transform 0.2s;
                        "
                        onmouseover="this.style.transform='scale(1.02)'"
                        onmouseout="this.style.transform='scale(1)'">
                            <p style="
                                margin: 0; 
                                color: #333; 
                                font-size: 15px;
                                line-height: 1.4;
                            ">
                                {{ $msg->content }}
                            </p>
                            <small style="
                                font-size: 12px; 
                                color: #666;
                                display: block;
                                margin-top: 4px;
                                text-align: right;
                            ">
                                {{ $msg->created_at->format('H:i') }}
                            </small>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Message input area -->
        <div style="
            padding: 20px; 
            border-top: 1px solid #ddd; 
            background-color: #fafafa;
            display: flex;
            gap: 10px;
            align-items: center;
        ">
            <form action="{{ route('messages.store', $otherUser->id) }}" method="POST"
                  style="flex: 1; display: flex; gap: 10px; align-items: center;">
                @csrf
                <input type="hidden" name="product_name" value="{{ $productName }}">

                <textarea 
                    name="content" 
                    rows="1" 
                    required 
                    placeholder="Type your message..."
                    style="
                        flex: 1;
                        border-radius: 8px;
                        border: 1px solid #ccc;
                        padding: 12px;
                        font-size: 14px;
                        resize: none;
                        font-family: Arial, sans-serif;
                    "
                ></textarea>
                
                <button type="submit" 
                        style="
                            background-color: #007BFF;
                            color: #fff;
                            border: none;
                            border-radius: 8px;
                            padding: 12px 24px;
                            font-size: 14px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: background-color 0.2s;
                        "
                        onmouseover="this.style.backgroundColor='#0056b3'"
                        onmouseout="this.style.backgroundColor='#007BFF'">
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Automatically refresh the page every 3 seconds
    setInterval(() => {
        window.location.reload();
    }, 10000); // 3000ms = 3 seconds
</script>

@endsection
