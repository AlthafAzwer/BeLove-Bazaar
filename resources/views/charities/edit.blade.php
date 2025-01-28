@extends('layouts.user')

@section('content')
<style>
    .edit-charity-container {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .edit-charity-container h1 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #555;
    }

    .form-control {
        border: 2px solid #ccc;
        border-radius: 6px;
        padding: 10px;
        font-size: 16px;
        transition: border 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .alert {
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        text-align: center;
        margin-bottom: 15px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn {
        width: 48%;
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .btn-primary {
        background: #007bff;
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }
</style>

<div class="edit-charity-container">
    <h1>Edit Charity Request</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('charities.update', $charity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control" 
                value="{{ old('quantity', $charity->quantity) }}" 
                required
            >
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('charities.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
