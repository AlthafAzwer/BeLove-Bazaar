@extends('layouts.user')

@section('content')
<style>
    .content-container {
        max-width: 600px;
        margin: 2rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #333;
    }

    form div {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        font-weight: bold;
        color: #555;
        margin-bottom: 0.5rem;
    }

    input[type="text"], select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        font-size: 1rem;
        color: #333;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    input[type="text"]:focus, select:focus {
        outline: none;
        border-color: #3182ce;
        box-shadow: 0 0 3px rgba(49, 130, 206, 0.5);
    }

    .hidden {
        display: none;
    }

    .installment-note {
        margin-top: -1rem;
        font-size: 0.9rem;
        color: #555;
    }

    button {
        display: inline-block;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        color: #fff;
        background-color: #3182ce;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2b6cb0;
    }

    .koko-link {
        text-align: center;
        margin-top: 10px;
        font-size: 0.9rem;
    }

    .koko-link a {
        color: #3182ce;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<div class="content-container">
    <h2>Order Details for {{ $product->title }}</h2>
    <form action="{{ route('orders.store', ['product' => $product->id]) }}" method="POST" id="payment-form">
        @csrf
        <div>
            <label for="buyer_name">Name:</label>
            <input type="text" id="buyer_name" name="buyer_name" value="{{ old('buyer_name', Auth::user()->name) }}" required>
        </div>
        <div>
            <label for="buyer_address">Address:</label>
            <input type="text" id="buyer_address" name="buyer_address" required>
        </div>
        <div>
            <label for="buyer_telephone">Telephone:</label>
            <input type="text" id="buyer_telephone" name="buyer_telephone" required>
        </div>
        <div>
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Pay by Card">Pay by Card</option>
                <option value="Koko Payment">Koko Payment</option>
            </select>
        </div>

        <!-- Card Details Section -->
        <div id="card-details" class="hidden">
            <p id="installment-note" class="installment-note hidden">Pay in 3 installments with 0% interest using Koko Payment.</p>
            <div>
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19">
            </div>
            <div>
                <label for="card_expiry">Expiry Date:</label>
                <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/YY" maxlength="5">
            </div>
            <div>
                <label for="card_cvc">CVC:</label>
                <input type="text" id="card_cvc" name="card_cvc" placeholder="123" maxlength="3">
            </div>
        </div>

        <!-- Koko Payment Redirect -->
        <div id="koko-payment" class="hidden">
            <p class="installment-note">You will be redirected to Koko to complete the payment. Once done, return here and click "Place Order".</p>
            <div class="koko-link">
                <a href="https://paykoko.com/" target="_blank">Proceed to Koko Payment</a>
            </div>
        </div>

        <button type="submit">Place Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethod = document.getElementById('payment_method');
        const cardDetails = document.getElementById('card-details');
        const kokoPayment = document.getElementById('koko-payment');
        const installmentNote = document.getElementById('installment-note');

        // Show/Hide Card Details and Koko Payment based on Payment Method
        paymentMethod.addEventListener('change', function () {
            if (paymentMethod.value === 'Pay by Card') {
                cardDetails.classList.remove('hidden');
                kokoPayment.classList.add('hidden');
                installmentNote.classList.add('hidden');
            } else if (paymentMethod.value === 'Koko Payment') {
                cardDetails.classList.remove('hidden');
                kokoPayment.classList.remove('hidden');
                installmentNote.classList.remove('hidden');
            } else {
                cardDetails.classList.add('hidden');
                kokoPayment.classList.add('hidden');
                installmentNote.classList.add('hidden');
            }
        });
    });
</script>
@endsection
