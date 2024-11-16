@extends('layouts.app') <!-- Or your preferred layout -->

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Post Your Ad</h2>
    <form action="{{ route('submit.ad') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Category Selection -->
        <label for="category">Category:</label>
        <select name="category" id="category" class="border p-2 rounded w-full mb-4">
            <option value="electronics">Electronics</option>
            <option value="furniture">Furniture</option>
            <!-- Add other categories as needed -->
        </select>

        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="border p-2 rounded w-full mb-4" required>

        <!-- Condition -->
        <label for="condition">Condition:</label>
        <select name="condition" id="condition" class="border p-2 rounded w-full mb-4">
            <option value="new">New</option>
            <option value="gently_used">Gently Used</option>
            <option value="heavily_used">Heavily Used</option>
        </select>

        <!-- Location -->
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" class="border p-2 rounded w-full mb-4" required>

        <!-- Description -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" class="border p-2 rounded w-full mb-4" required></textarea>

        <!-- Images -->
        <label for="images">Images:</label>
        <input type="file" name="images[]" id="images" multiple class="border p-2 rounded w-full mb-4">

        <!-- Contact Info -->
        <label for="contact_info">Contact Info:</label>
        <input type="text" name="contact_info" id="contact_info" class="border p-2 rounded w-full mb-4" required>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Submit Ad</button>
    </form>
</div>
@endsection
