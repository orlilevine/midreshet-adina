@extends('layouts.app')

@section('title', 'Purchase Options')

@section('content')
    <div style="text-align: center;">
        <h1>Purchase Options</h1>
        <p>You are purchasing: <strong>{{ $shiur->title }}</strong></p>

        <form id="payment-form" action="{{ route('purchase.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
            <input type="hidden" name="payment_intent_id" id="payment_intent_id">
            <input type="hidden" name="purchase_option" id="purchase_option" value="shiur">

            <!-- Choose between individual shiur or series -->
            <div class="form-group">
                <label for="purchase_option_select">Select Purchase Option:</label>
                <select id="purchase_option_select" class="form-control" required>
                    <option value="shiur" data-price="{{ $shiur->price * 100 }}">This Shiur - ${{ $shiur->price }}</option>
                    <option value="series" data-price="8000">Whole Series - $80</option>
                </select>
            </div>

            <!-- Stripe Elements placeholder -->
            <div id="card-element" class="mb-3"></div>

            <!-- Error message display -->
            <div id="card-errors" role="alert" class="text-danger"></div>

            <!-- Payment button -->
            <button id="submit" class="btn btn-success" type="submit">Proceed to Payment</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_PUBLISHABLE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Get the selected purchase option
            const purchaseOption = document.getElementById('purchase_option').value;

            // Determine the amount based on the purchase option
            const amount = purchaseOption === 'series' ? 8000 : {{ $shiur->price * 100 }};

            try {
                // Create a PaymentIntent and handle the confirmation
                const response = await fetch('{{ route('payment.checkout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ purchase_type: purchaseOption })
                });

                const { clientSecret, error } = await response.json();

                if (error) {
                    // Display error to your customer
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    const {error: stripeError} = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement
                        }
                    });

                    if (stripeError) {
                        // Display error to your customer
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = stripeError.message;
                    } else {
                        // Payment succeeded, redirect or handle success
                        form.submit(); // Ensure this is the correct form
                    }
                }
            } catch (err) {
                // Handle unexpected errors
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = 'An unexpected error occurred.';
            }
        });
    </script>

@endsection
