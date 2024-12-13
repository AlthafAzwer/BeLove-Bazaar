@extends('layouts.user')

@section('content')
<style>
    /* Centered and responsive form styling */
    .form-container {
        max-width: 600px;
        margin: 2rem auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        font-size: 1.8rem;
        color: #333333;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-size: 0.9rem;
        color: #555555;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem;
        font-size: 0.9rem;
        border: 1px solid #cccccc;
        border-radius: 5px;
        outline: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn {
        background-color: #007bff;
        color: #ffffff;
        padding: 0.8rem 1rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        width: 100%;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .text-danger {
        font-size: 0.85rem;
        color: #dc3545;
    }
</style>

<div class="form-container">
    <h1>Create a New Auction</h1>
    <form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Category -->
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Auction Title" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Condition -->
        <div class="form-group">
            <label for="condition">Condition</label>
            <select name="condition" id="condition" class="form-control" required>
                <option value="New">New</option>
                <option value="Used">Used</option>
            </select>
            @error('condition')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <select name="location" id="location" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location }}">{{ $location }}</option>
                @endforeach
            </select>
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe the item" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start Bid -->
        <div class="form-group">
            <label for="start_bid">Start Bid</label>
            <input type="number" name="start_bid" id="start_bid" class="form-control" placeholder="Starting bid amount" required>
            @error('start_bid')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Max Bid -->
        <div class="form-group">
            <label for="max_bid">Max Bid</label>
            <input type="number" name="max_bid" id="max_bid" class="form-control" placeholder="Maximum bid amount" required>
            @error('max_bid')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Duration -->
        <div class="form-group">
            <label for="duration">Auction Duration (in days)</label>
            <input type="number" name="duration" id="duration" class="form-control" placeholder="Auction duration in days" required>
            @error('duration')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Images -->
        <div class="form-group">
            <label for="images">Upload Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple required>
            @error('images.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contact Info -->
        <div class="form-group">
            <label for="contact_info">Contact Info</label>
            <input type="text" name="contact_info" id="contact_info" class="form-control" placeholder="Contact details" required>
            @error('contact_info')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Submit Auction</button>
    </form>
</div>
@endsection
