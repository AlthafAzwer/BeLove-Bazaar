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
        .form-container select,
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
        .form-container select:focus,
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

    <h1>Create a New Product Listing</h1>

    <div class="form-container">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="electronics">Electronics</option>
                <option value="furniture">Furniture</option>
                <option value="clothing">Clothing</option>
                <option value="books">Books</option>
                <option value="toys">Toys</option>
                <option value="home_appliances">Home Appliances</option>
                <option value="sports">Sports</option>
            </select>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="condition">Condition:</label>
            <select name="condition" id="condition" required>
                <option value="New">New</option>
                <option value="Gently used">Gently Used</option>
                <option value="Heavily used">Heavily Used</option>
            </select>

            <label for="location">Location:</label>
            <select name="location" id="location" required>
                <option value="all_sri_lanka">All of Sri Lanka</option>
                <option value="colombo_1">Colombo 1</option>
                <option value="colombo_2">Colombo 2</option>
                <option value="colombo_3">Colombo 3</option>
                <option value="colombo_4">Colombo 4</option>
                <option value="colombo_5">Colombo 5</option>
                <option value="colombo_6">Colombo 6</option>
                <option value="colombo_7">Colombo 7</option>
                <option value="colombo_8">Colombo 8</option>
                <option value="colombo_9">Colombo 9</option>
                <option value="colombo_10">Colombo 10</option>
                <option value="colombo_11">Colombo 11</option>
                <option value="colombo_12">Colombo 12</option>
                <option value="colombo_13">Colombo 13</option>
                <option value="colombo_14">Colombo 14</option>
                <option value="colombo_15">Colombo 15</option>
            </select>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="0.01" required>

            <label for="images">Images:</label>
            <input type="file" name="images[]" id="images" multiple required>

            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" id="contact_info" required>

            <button type="submit">Submit for Review</button>
        </form>
    </div>
@endsection
p