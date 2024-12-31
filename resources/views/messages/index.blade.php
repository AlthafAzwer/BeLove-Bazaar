@extends('layouts.user')

@section('content')
<div style="
    /* Make the page take the full viewport height */
    min-height: 100vh; 
    margin: 0; 
    padding: 0; 
    font-family: Arial, sans-serif; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    /* Subtle gradient background */
    background: linear-gradient(135deg, #d8e5f5 0%, #f7f7f7 100%);
">

    <!-- Main container -->
    <div style="
        background-color: #fff;
        width: 90%;
        max-width: 1100px;
        margin: 40px auto; 
        padding: 40px; 
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    ">

        <!-- Optional success alert -->
        @if(session('success'))
            <div style="
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
                color: #155724;
                padding: 10px;
                border-radius: 6px;
                margin-bottom: 15px;
                text-align: center;
                max-width: 600px;
                margin: 0 auto 15px auto;
            ">
                {{ session('success') }}
            </div>
        @endif

        <h1 style="
            font-size: 32px; 
            margin-bottom: 30px; 
            color: #333; 
            text-align: center;
            font-weight: 700;
        ">
            My Chats
        </h1>

        <!-- Container for the chat list -->
        <div style="display: flex; justify-content: center;">
            <ul style="
                list-style: none; 
                margin: 0; 
                padding: 0; 
                width: 350px; 
                border: 1px solid #ddd; 
                border-radius: 8px;
                overflow: hidden;
                background: #fafafa;
            ">
                @forelse($contacts as $contact)
                    <li style="
                        border-bottom: 1px solid #ddd; 
                        transition: background-color 0.2s, transform 0.2s;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    ">

                        <!-- Contact link to open the chat -->
                        <a href="{{ route('messages.show', $contact->id) }}"
                           style="
                               flex: 1;
                               display: block; 
                               padding: 16px; 
                               text-decoration: none; 
                               color: #333;
                               font-size: 16px;
                               font-weight: 500;
                           "
                           onmouseover="
                               this.style.backgroundColor='#f1f1f1';
                               this.style.transform='translateX(5px)';
                           "
                           onmouseout="
                               this.style.backgroundColor='transparent';
                               this.style.transform='translateX(0)';
                           ">
                            {{ $contact->name }}
                        </a>

                        <!-- Delete chat form -->
                        <form action="{{ route('messages.deleteChat', $contact->id) }}"
                              method="POST"
                              style="margin-right: 16px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="
                                        background-color: #dc3545;
                                        color: #fff;
                                        padding: 8px 12px;
                                        border: none;
                                        border-radius: 6px;
                                        font-size: 14px;
                                        cursor: pointer;
                                        font-weight: 600;
                                        transition: background-color 0.3s;
                                    "
                                    onmouseover="this.style.backgroundColor='#bb2d3b'"
                                    onmouseout="this.style.backgroundColor='#dc3545'">
                                Delete
                            </button>
                        </form>
                    </li>
                @empty
                    <li style="padding: 14px; text-align: center;">
                        No contacts found
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
