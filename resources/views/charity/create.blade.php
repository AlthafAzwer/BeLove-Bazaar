@extends('layouts.user')

@section('content')
    <style>
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
            font-size: 1rem;
        }

        .form-container input:focus,
        .form-container textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-container button:hover {
            background: #0056b3;
        }
    </style>

    <h1>Submit Charity Request</h1>

    <div class="form-container">
        <form action="{{ route('charity.request.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Charity Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="logo">Charity Logo:</label>
            <input type="file" name="logo" id="logo" required>

            <label for="description">Description of Needs:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="quantity">Quantity Needed:</label>
            <input type="number" name="quantity" id="quantity" required>

            <label for="certification">Charity Certification (PDF/Image):</label>
            <input type="file" name="certification" id="certification" required>

            <button type="submit">Submit Request</button>
        </form>
    </div>
@endsection
