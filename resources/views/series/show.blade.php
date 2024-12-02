@extends('layouts.app')

@section('content')
    <div class="series-page-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Series Image and Title -->
        <div class="series-header">
            <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover" class="series-image">
            <h1 class="series-title">{{ $series->title }}</h1>
        </div>

        <!-- Series Details and Purchase Section -->
        <div class="series-details">
            <p class="series-description">{{ $series->description }}</p>
            <p class="series-price">Price: <strong>${{ $series->price }}</strong></p>

            @auth
                @if ($hasPurchasedSeries)
                    <!-- Purchased Button -->
                    <a href="{{ route('user.purchases') }}" class="cta-button purchased-button">
                        Series Purchased - Go to My Shiurim
                    </a>
                @else
                    <form id="checkoutForm" action="{{ route('payment.createSession.series', ['seriesId' => $series->id]) }}" method="GET">
                        <div id="couponSection" class="coupon-section">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="input-field">
                            <button type="submit" id="applyCoupon" class="cta-button apply-coupon-button">Apply Coupon</button>
                        </div>

                        <button type="submit" class="cta-button purchase-button">Purchase Entire Series for ${{ $series->price }}</button>
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
                        <p><strong>Please don’t fill this out until after you submit your Zelle.</strong></p>
                        <p>Zelle Account: 9176035614</p>
                        <p>Price of series: ${{ $series->price }}</p>
                        <form action="{{ route('payment.zelle.series') }}" method="POST">
                            @csrf
                            <input type="hidden" name="series_id" value="{{ $series->id }}">
                            <input type="text" name="zelle_account_from" placeholder="Zelle Account Name" class="input-field" required>
                            <input type="number" name="zelle_amount" placeholder="Amount I Zelled" class="input-field" required>
                            <input type="date" name="zelle_date" class="input-field" required>
                            <button type="submit" class="cta-button">Submit Zelle Payment</button>
                        </form>
                    </div>

                    <div id="checkPaymentForm" class="payment-form check-form">
                        <p><strong>Please don’t fill this out until after you mail your check.</strong></p>
                        <p>Check mail address: 136-05 72nd Road, Flushing, NY 11367</p>
                        <p>Price of series: ${{ $series->price }}</p>
                        <form action="{{ route('payment.check.series') }}" method="POST">
                            @csrf
                            <input type="hidden" name="series_id" value="{{ $series->id }}">
                            <input type="text" name="check_name" placeholder="Check Name" class="input-field" required>
                            <input type="number" name="check_amount" placeholder="Check Amount" class="input-field" required>
                            <input type="date" name="check_date" class="input-field" required>
                            <button type="submit" class="cta-button">Submit Check Payment</button>
                        </form>
                    </div>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Series.</p>
            @endauth
        </div>

        <!-- Shiur List -->
        <div class="shiur-list">
            @foreach ($shiurs as $shiurItem)
                <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}" class="shiur-link">
                    {{ $shiurItem->title }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Styles -->
    <style>
        .series-page-container {
            padding: 40px;
            background: linear-gradient(135deg, #ff007f, #001f3f);
            color: white;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
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
        .series-image {
            width: 35%; /* Adjust size as needed */
            height: auto;
            /* Removed border-radius */
            transition: transform 0.3s ease;
        }
        .series-image:hover {
            transform: scale(1.05);
        }
        .series-title {
            font-size: 2.8em;
            margin-top: 15px;
        }
        .series-description, .series-price {
            font-size: 1.2em;
            margin-bottom: 15px;
        }
        .cta-button {
            padding: 15px 30px;
            font-size: 1.1em;
            color: white;
            background-color: #001f3f;
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
        .shiur-list {
            display: grid;
            gap: 10px;
            margin-top: 30px;
        }
        .shiur-link {
            padding: 15px 30px;
            color: white;
            background-color: #ff007f;
            text-decoration: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .shiur-link:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentOptions = document.getElementById('paymentOptions');
            const couponSection = document.getElementById('couponSection');
            const zellePaymentForm = document.getElementById('zellePaymentForm');
            const checkPaymentForm = document.getElementById('checkPaymentForm');

            document.getElementById('showOtherPaymentOptions').addEventListener('click', function(event) {
                event.preventDefault();
                paymentOptions.style.display = (paymentOptions.style.display === 'block') ? 'none' : 'block';
            });

            document.getElementById('couponButton').addEventListener('click', function() {
                couponSection.style.display = (couponSection.style.display === 'block') ? 'none' : 'block';
            });

            document.getElementById('zelleButton').addEventListener('click', function() {
                const isVisible = zellePaymentForm.style.display === 'block';
                zellePaymentForm.style.display = isVisible ? 'none' : 'block';
                checkPaymentForm.style.display = 'none';
            });

            document.getElementById('checkButton').addEventListener('click', function() {
                const isVisible = checkPaymentForm.style.display === 'block';
                checkPaymentForm.style.display = isVisible ? 'none' : 'block';
                zellePaymentForm.style.display = 'none';
            });
        });
    </script>

@endsection
