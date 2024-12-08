@extends('layouts.app')

@section('title', 'Payment Successful!')

@section('content')
    <div class="container text-center">
        <p>Thank you for your purchase. Your payment has been processed successfully.</p>
        <p>
            <a href="{{ url('/purchased-series') }}" class="cta-button">Go to My Shiurim</a>
        </p>
    </div>
@endsection

<style>
    .cta-button {
        display: inline-block;
        background-color: #2D6FA3; /* Dark turquoise */
        color: #fff; /* White text */
        padding: 10px 20px; /* Padding for a button feel */
        border-radius: 5px; /* Rounded edges */
        text-decoration: none; /* Remove underline */
        font-weight: bold; /* Emphasize the text */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        transition: all 0.3s ease; /* Smooth hover effects */
    }

    .cta-button:hover {
        color: #fff; /* Maintain white text on hover */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* More pronounced shadow on hover */
        transform: scale(1.05); /* Slightly enlarge the button */
    }

</style>
