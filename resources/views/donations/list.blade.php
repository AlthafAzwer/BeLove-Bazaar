@extends('layouts.user')

@section('content')

<style>
    /* General Styling */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    /* Page Header */
    .donations-header {
        text-align: center;
        margin: 2rem 0;
    }

    .donations-header h1 {
        font-size: 2.5rem;
        color: #333;
    }

    /* Donations Grid */
    .donations-list {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Two columns per row */
        gap: 2rem;
    }

    /* Donation Card */
    .donation-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .donation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .donation-image-container {
        width: 100%;
        height: 300px; /* Increased height for larger cards */
        overflow: hidden;
    }

    .donation-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .donation-content {
        padding: 1.5rem; /* Slightly larger padding */
        text-align: left;
    }

    .donation-content h2 {
        font-size: 1.8rem; /* Larger font for titles */
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .donation-content p {
        font-size: 1.1rem; /* Slightly larger font for description */
        color: #555;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .donate-btn {
        display: block;
        width: 100%;
        text-align: center;
        background-color: #e53e3e;
        color: #fff;
        padding: 0.8rem; /* Larger padding for button */
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .donate-btn:hover {
        background-color: #c53030;
    }

    /* Modal Styling */
    .donation-details-modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        max-width: 600px;
        width: 90%;
        text-align: left;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    }

    .modal-content h3 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .modal-content p {
        margin: 0.5rem 0;
    }

    .modal-close-btn {
        background: #e53e3e;
        color: #fff;
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        margin-top: 1rem;
        cursor: pointer;
    }

    .modal-close-btn:hover {
        background: #c53030;
    }

    /* Search Bar */
    .search-bar {
        max-width: 600px;
        margin: 0 auto 2rem auto;
        display: flex;
        gap: 1rem;
    }

    .search-bar input {
        flex: 1;
        padding: 0.6rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .search-bar button {
        padding: 0.6rem 1.5rem;
        background-color: #e53e3e;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
        background-color: #c53030;
    }
</style>

<div class="donations-header">
    <h1>Donation Requests</h1>
</div>

<form action="{{ route('donations.search') }}" method="GET" class="search-bar">
    <input 
        type="text" 
        name="query" 
        placeholder="Search donations by description..."
        value="{{ request('query') }}" 
    />
    <button type="submit">Search</button>
</form>

<div class="donations-list">
    @foreach ($approvedCharities as $charity)
    <div class="donation-card">
        <div class="donation-image-container">
            <img src="{{ asset('storage/' . $charity->logo) }}" alt="{{ $charity->name }}" class="donation-image">
        </div>
        <div class="donation-content">
            <h2>Hi, We're {{ $charity->name }}</h2>
            <p>{{ $charity->description }}</p>
            <button class="donate-btn" onclick="showDetails('{{ $charity->id }}')">Donate</button>
            <form action="{{ route('charity.chat', $charity->id) }}" method="POST">
    @csrf
    <div style="
    text-align: center; 
    margin-top: 20px; /* space above the buttons */
">
    <button style="
    background-color: #17A2B8;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.3s;
    margin-left: 15px;
"
onmouseover="
    this.style.backgroundColor='#138496';
    this.style.transform='scale(1.03)';
"
onmouseout="
    this.style.backgroundColor='#17A2B8';
    this.style.transform='scale(1)';
">
    Message Charity
</button>
    </div>
</form>

        </div>
    </div>

    <!-- Hidden Modal for Detailed Info -->
    <div id="details-{{ $charity->id }}" class="donation-details-modal">
        <div class="modal-content">
            <h3>{{ $charity->name }}</h3>
            <p><strong>Address:</strong> {{ $charity->address }}</p>
            <p><strong>Phone:</strong> {{ $charity->phone }}</p>
            <p><strong>Quantity Needed:</strong> {{ $charity->quantity }}</p>
            <p><strong>Certification:</strong> <a href="{{ asset('storage/' . $charity->certification) }}" target="_blank">View Certification</a></p>
            <button class="modal-close-btn" onclick="closeDetails('{{ $charity->id }}')">Close</button>
        </div>
    </div>
    @endforeach
</div>

<script>
    function showDetails(id) {
        const modal = document.getElementById(`details-${id}`);
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeDetails(id) {
        const modal = document.getElementById(`details-${id}`);
        if (modal) {
            modal.style.display = 'none';
        }
    }
</script>

@endsection
