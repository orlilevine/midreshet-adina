@extends('layouts.app')

@section('title', $shiur->title . ' | ' . $series->title)

@section('content')
    <div style="text-align: center;">
        <p>{{ $shiur->description }}</p>
        <p>Price: ${{ $shiur->price }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>
        <div style="text-align: center; margin-bottom: 20px;">
            @auth
                @if($hasPurchasedShiur || $hasPurchasedSeries)
                    <!-- If purchased, show "Go to My Shiurim" button -->
                    <a href="{{ route('user.purchases') }}" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; text-decoration: none;">
                        Shiur Purchased - Go to My Shiurim
                    </a>
                @else
                    <form id="checkoutForm" action="{{ route('payment.createSession.shiur', ['shiurId' => $shiur->id]) }}" method="GET">
                        <!-- Coupon Section (Hidden by Default) -->
                        <div id="couponSection" style="display: none; margin-bottom: 10px;">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" style="padding: 5px; width: 200px;">
                            <button type="button" id="applyCoupon" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;">
                                Apply Coupon
                            </button>
                        </div>

                        <!-- Checkout Button -->
                        <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                            Purchase this Shiur for ${{ $shiur->price }}
                        </button>

                        <!-- Button to Show Other Payment Options -->
                        <p style="margin-bottom: 10px;">
                            <a href="#" id="showOtherPaymentOptions" style="font-size: 14px; text-decoration: underline; color: #007bff;">Other Payment Options</a>
                        </p>
                    </form>

                    <!-- Hidden Payment Options Section -->
                    <div id="paymentOptions" style="display: none; text-align: center; margin-top: 10px;">
                        <button style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; margin: 5px;" onclick="toggleCouponSection()">Coupon</button>
                        <button id="zelleButton" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; margin: 5px;">Zelle</button>
                        <button id="checkButton" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; margin: 5px;">Check</button>
                    </div>

                    <!-- Zelle Payment Form (Initially Hidden) -->
                    <div id="zellePaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you submit your Zelle.</strong></p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <p>Zelle Account: </p>
                        <form action="{{ route('payment.zelle.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="zelle_account_from" placeholder="Zelle Account Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="zelle_amount" placeholder="Amount I Zelled" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="zelle_date" placeholder="Zelle Date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                                Submit Zelle Payment
                            </button>
                        </form>
                    </div>

                    <!-- Check Payment Form (Initially Hidden) -->
                    <div id="checkPaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you drop off your check.</strong></p>
                        <p>Check dropoff address is in Queens, NY. Please contact us to find out the address.</p>
                        <p>Price of shiur: ${{ $shiur->price }}</p>
                        <form action="{{ route('payment.check.shiur') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shiur_id" value="{{ $shiur->id }}">
                            <input type="text" name="check_name" placeholder="Check Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="check_amount" placeholder="Check Amount" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="check_date" placeholder="Check Date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                                Submit Check Payment
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Shiur.</p>
            @endauth
        </div>
    </div>

    <script>
        document.getElementById('showOtherPaymentOptions').onclick = function(event) {
            event.preventDefault();
            var paymentOptions = document.getElementById('paymentOptions');
            paymentOptions.style.display = paymentOptions.style.display === 'none' ? 'block' : 'none';
        };

        function toggleCouponSection() {
            var couponSection = document.getElementById('couponSection');
            couponSection.style.display = couponSection.style.display === 'none' ? 'block' : 'none';
        }

        document.getElementById('zelleButton').onclick = function() {
            document.getElementById('zellePaymentForm').style.display = 'block';
            document.getElementById('checkPaymentForm').style.display = 'none';
        };

        document.getElementById('checkButton').onclick = function() {
            document.getElementById('checkPaymentForm').style.display = 'block';
            document.getElementById('zellePaymentForm').style.display = 'none';
        };
    </script>
@endsection
