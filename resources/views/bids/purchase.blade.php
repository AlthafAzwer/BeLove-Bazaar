@extends('layouts.user')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 2rem auto;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 1rem;
    }

    .btn-submit {
        background-color: #007bff;
        color: #fff;
        padding: 0.8rem 1rem;
        border-radius: 5px;
        border: none;
        font-size: 1rem;
        width: 100%;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-container">
    <h1>Proceed to Purchase</h1>
    <form action="{{ route('bids.purchase.submit', $bid->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="4" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn-submit">Submit Purchase</button>
    </form>
</div>
@endsection
