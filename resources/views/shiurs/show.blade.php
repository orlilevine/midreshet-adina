@extends('layouts.app')

@section('content')
    <div class="series-page-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Shiur Header -->
        <div class="series-header">
            <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover" class="series-image">
            <h1 class="series-title">{{ $shiur->title }}</h1>
        </div>

        <!-- Shiur Details and Purchase Section -->
        <div class="series-details">
            <p class="series-description">{{ $shiur->description }}</p>
            <p class="series-price">Price: <strong>${{ $shiur->price }}</strong></p>
            <p class="series-date">Date: <strong>{{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</strong></p>

            @auth
                @if($hasPurchasedShiur || $hasPurchasedSeries)
                    <!-- Purchased Button -->
                    <a href="{{ route('user.purchases') }}" class="cta-button purchased-button">
                        Shiur Purchased - Go to My Shiurim
                    </a>
                @else
                    <form id="checkoutForm" action="{{ route('payment.createSession.shiur', ['shiurId' => $shiur->id]) }}" method="GET">
                        <div id="couponSection" class="coupon-section">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="input-field">
                            <button type="submit" id="applyCoupon" class="cta-button apply-coupon-button">Apply Coupon</button>
                        </div>

                        <button type="submit" class="cta-button purchase-button" style="border: 2px solid black;">Purchase this Shiur for ${{ $shiur->price }}</button>
                        <p class="other-options-link"><a href="#" id="showOtherPaymentOptions">Other Payment Options</a></p>
                    </form>

                    <!-- Other Payment Options -->
                    <div id="paymentOptions" class="payment-options">
                        <button class="cta-button payment-option" id="couponButton">Coupon</button>
                        <button class="cta-button payment-option" id="zelleButton">Zelle</button>
                        <button class="cta-button payment-option" id="checkButton">Check</button>
                    </div>

                    <!-- Zelle and Check Payment Forms -->
                    <div id="zellePaymentForm" class="payment-form zelle-form">
                        <p><strong>Please don't fill this out until after you submit your Zelle.</strong></p>
                        <p>Zelle Account: 9176035614</p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <form action="{{ route('payment.zelle.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="zelle_account_from" placeholder="Zelle Account Name" class="input-field" required>
                            <input type="number" name="zelle_amount" placeholder="Amount I Zelled" class="input-field" required>
                            <input type="date" name="zelle_date" class="input-field" required>
                            <button type="submit" class="cta-button">Submit Zelle Payment</button>
                        </form>
                    </div>

                    <div id="checkPaymentForm" class="payment-form check-form">
                        <p><strong>Please don't fill this out until after you mail your check.</strong></p>
                        <p>Check mail address: 136-05 72nd Road, Flushing, NY 11367</p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <form action="{{ route('payment.check.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="check_name" placeholder="Check Name" class="input-field" required>
                            <input type="number" name="check_amount" placeholder="Check Amount" class="input-field" required>
                            <input type="date" name="check_date" class="input-field" required>
                            <button type="submit" class="cta-button">Submit Check Payment</button>
                        </form>
                    </div>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Shiur.</p>
            @endauth
        </div>
    </div>

    <!-- Styles -->
    <style>
        .series-page-container {
            padding: 40px;
            background: white; /* Removed gradient background */
            color: black; /* Changed text color to black */
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        .alert {
            font-size: 1.2em;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 20px;
        }

        .series-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .series-title {
            font-size: 2.8em;
            margin-top: 15px;
        }

        .series-description, .series-price, .series-date {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .cta-button {
            padding: 15px 30px;
            font-size: 1.1em;
            color: white;
            background-color: #2D6FA3;
            border: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }

        .cta-button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .purchased-button {
            background-color: #28a745;
        }

        .coupon-section, .payment-options, .payment-form {
            display: none;
        }

        .input-field {
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 250px;
            margin: 5px;
        }

        .other-options-link a {
            color: #001f3f;
            text-decoration: underline;
            cursor: pointer;
        }
        .series-image {
            width: 35%; /* Adjust size as needed */
            height: auto;
            /* Removed border-radius */
            transition: transform 0.3s ease;
        }
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show or hide "Other Payment Options" section
            document.getElementById('showOtherPaymentOptions').addEventListener('click', function(event) {
                event.preventDefault();
                const paymentOptions = document.getElementById('paymentOptions');
                paymentOptions.style.display = paymentOptions.style.display === 'block' ? 'none' : 'block';
            });

            // Toggle the Coupon section
            document.getElementById('couponButton').addEventListener('click', function() {
                const couponSection = document.getElementById('couponSection');
                couponSection.style.display = couponSection.style.display === 'block' ? 'none' : 'block';
            });

            // Toggle the Zelle Payment section and hide the Check section
            document.getElementById('zelleButton').addEventListener('click', function() {
                const zelleForm = document.getElementById('zellePaymentForm');
                const checkForm = document.getElementById('checkPaymentForm');
                zelleForm.style.display = zelleForm.style.display === 'block' ? 'none' : 'block';
                checkForm.style.display = 'none'; // Ensure Check form is hidden if Zelle is open
            });

            // Toggle the Check Payment section and hide the Zelle section
            document.getElementById('checkButton').addEventListener('click', function() {
                const checkForm = document.getElementById('checkPaymentForm');
                const zelleForm = document.getElementById('zellePaymentForm');
                checkForm.style.display = checkForm.style.display === 'block' ? 'none' : 'block';
                zelleForm.style.display = 'none'; // Ensure Zelle form is hidden if Check is open
            });
        });
    </script>
@endsection
