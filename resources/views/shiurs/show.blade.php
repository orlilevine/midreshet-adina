@extends('layouts.app')

@section('title', $shiur->title . ' | ' . $series->title)

@section('content')
    <div style="text-align: center; padding: 30px; background: linear-gradient(to bottom right, #f0f8ff, #e6f7ff); border-radius: 10px;">
        <h1 style="font-size: 2.5em; color: #003366; margin-bottom: 20px;">{{ $shiur->title }}</h1>
        <p style="font-size: 1.2em; color: #555;">{{ $shiur->description }}</p>
        <p style="font-size: 1.5em; color: #003366;">Price: <strong>${{ $shiur->price }}</strong></p>
        <p style="font-size: 1.2em; color: #555;">Date: {{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>

        <div style="margin-bottom: 20px;">
            @auth
                @if($hasPurchasedShiur || $hasPurchasedSeries)
                    <!-- Purchased button -->
                    <a href="{{ route('user.purchases') }}" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px; text-decoration: none; transition: transform 0.3s, box-shadow 0.3s;">
                        Shiur Purchased - Go to My Shiurim
                    </a>
                @else
                    <form id="checkoutForm" action="{{ route('payment.createSession.shiur', ['shiurId' => $shiur->id]) }}" method="GET">
                        <!-- Coupon Section -->
                        <div id="couponSection" style="display: none; margin-bottom: 15px;">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" style="padding: 10px; width: 250px; border-radius: 5px;">
                            <button type="button" id="applyCoupon" class="hover-button" style="padding: 10px 20px; background-color: #001f3f; color: white; border-radius: 10px;">
                                Apply Coupon
                            </button>
                        </div>

                        <!-- Purchase Button -->
                        <button type="submit" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px;">
                            Purchase this Shiur for ${{ $shiur->price }}
                        </button>

                        <!-- Other Payment Options Link -->
                        <p style="margin-top: 15px;">
                            <a href="#" id="showOtherPaymentOptions" style="font-size: 14px; text-decoration: underline; color: #001f3f;">Other Payment Options</a>
                        </p>
                    </form>

                    <!-- Hidden Payment Options -->
                    <div id="paymentOptions" style="display: none; margin-top: 20px;">
                        <button id="couponButton" class="hover-button" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 10px;">
                            Coupon
                        </button>
                        <button id="zelleButton" class="hover-button" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 10px;">
                            Zelle
                        </button>
                        <button id="checkButton" class="hover-button" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 10px;">
                            Check
                        </button>
                    </div>

                    <!-- Zelle Payment Form (Initially Hidden) -->
                    <div id="zellePaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you submit your Zelle.</strong></p>
                        <p>Zelle Account: 9176035614</p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <form action="{{ route('payment.zelle.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="zelle_account_from" placeholder="Zelle Account Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="zelle_amount" placeholder="Amount I Zelled" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="zelle_date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                                Submit Zelle Payment
                            </button>
                        </form>
                    </div>

                    <!-- Check Payment Form (Initially Hidden) -->
                    <div id="checkPaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you mail your check.</strong></p>
                        <p>Check mail address:
                            136-05 72nd Road,
                            Flushing, NY 11367
                        </p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <form action="{{ route('payment.check.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="check_name" placeholder="Check Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="check_amount" placeholder="Check Amount" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="check_date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                                Submit Check Payment
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <p style="font-size: 1.2em; color: #003366;">Please <a href="{{ route('login') }}" style="color: #001f3f;">log in</a> or <a href="{{ route('register') }}" style="color: #001f3f;">register</a> to purchase this Shiur.</p>
            @endauth
        </div>
    </div>

    <style>
        .hover-button {
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            font-size: 1.1em;
        }
        .hover-button:hover {
            background-color: #45a049; /* Hover green effect */
            transform: scale(1.1); /* Slight zoom */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
    </style>

    <script>
        document.getElementById('showOtherPaymentOptions').onclick = function(event) {
            event.preventDefault();
            var paymentOptions = document.getElementById('paymentOptions');
            paymentOptions.style.display = paymentOptions.style.display === 'none' ? 'block' : 'none';
        };

        document.getElementById('applyCoupon').addEventListener('click', function(event) {
            event.preventDefault();
            var couponCode = document.getElementById('coupon_code').value;

            if (couponCode.trim() === '') {
                alert('Please enter a valid coupon code.');
            } else {
                document.getElementById('checkoutForm').submit();
            }
        });

        document.getElementById('couponButton').onclick = function() {
            document.getElementById('couponSection').style.display = 'block';
        };

        document.getElementById('zelleButton').onclick = function() {
            var zelleForm = document.getElementById('zellePaymentForm');
            zelleForm.style.display = zelleForm.style.display === 'none' ? 'block' : 'none';
        };

        document.getElementById('checkButton').onclick = function() {
            var checkForm = document.getElementById('checkPaymentForm');
            checkForm.style.display = checkForm.style.display === 'none' ? 'block' : 'none';
        };
    </script>
@endsection
