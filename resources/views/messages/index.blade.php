@extends('layouts.user')

@section('content')
<div style="
    max-width: 900px; 
    margin: 0 auto; 
    padding: 20px; 
    font-family: Arial, sans-serif;">

    <h1 style="
        font-size: 24px; 
        margin-bottom: 20px; 
        color: #333; 
        text-align: center;">
        My Chats
    </h1>

    <ul style="
        list-style: none; 
        margin: 0; 
        padding: 0; 
        width: 300px; 
        border: 1px solid #ddd; 
        border-radius: 6px;">

        @forelse($contacts as $contact)
            <li style="
                border-bottom: 1px solid #ddd; 
                transition: background-color 0.2s;">

                <a href="{{ route('messages.show', $contact->id) }}"
                   style="
                       display: block; 
                       padding: 12px; 
                       text-decoration: none; 
                       color: #333;"
                   onmouseover="this.style.backgroundColor='#f9f9f9'"
                   onmouseout="this.style.backgroundColor='transparent'">
                   
                    {{ $contact->name }}
                </a>
            </li>
        @empty
            <li style="padding: 12px;">No contacts found</li>
        @endforelse

    </ul>
</div>
@endsection
