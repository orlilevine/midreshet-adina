@extends('layouts.app')

@section('title', $series->title)

@section('content')
    <div style="text-align: center; padding: 30px; background: linear-gradient(to bottom right, #f0f8ff, #e6f7ff); border-radius: 10px;">

        @if(session('success'))
            <div class="alert alert-success" style="text-align: center; font-size: 18px; font-weight: bold; color: #28a745; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Series Image -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover"
                 style="width: 30%; height: auto; border-radius: 15px; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2); transition: transform 0.3s;"
                 onmouseover="this.style.transform='scale(1.05)';"
                 onmouseout="this.style.transform='scale(1)';">
        </div>

        <h1 style="font-size: 2.5em; color: #003366; margin-bottom: 20px;">{{ $series->title }}</h1>
        <p style="font-size: 1.2em; color: #555;">{{ $series->description }}</p>
        <p style="font-size: 1.5em; color: #003366;">Price: <strong>${{ $series->price }}</strong></p>

        <div style="margin-bottom: 20px;">
            @auth
                @if ($hasPurchasedSeries)
                    <!-- Purchased button -->
                    <a href="{{ route('user.purchases') }}" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px; text-decoration: none; transition: transform 0.3s, box-shadow 0.3s;">
                        Series Purchased - Go to My Shiurim
                    </a>
                @else
                    <form id="checkoutForm" action="{{ route('payment.createSession.series', ['seriesId' => $series->id]) }}" method="GET">
                        <!-- Coupon Section -->
                        <div id="couponSection" style="display: none; margin-bottom: 15px;">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" style="padding: 10px; width: 250px; border-radius: 5px;">
                            <button type="submit" id="applyCoupon" class="hover-button" style="padding: 10px 20px; background-color: #001f3f; color: white; border-radius: 10px;">
                                Apply Coupon
                            </button>
                        </div>

                        <!-- Purchase Button -->
                        <button type="submit" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px;">
                            Purchase Entire Series for ${{ $series->price }}
                        </button>

                        <!-- Other Payment Options Link -->
                        <p style="margin-top: 15px;">
                            <a href="#" id="showOtherPaymentOptions" style="font-size: 14px; text-decoration: underline; color: #001f3f;">Other Payment Options</a>
                        </p>
                    </form>

                    <!-- Hidden Payment Options -->
                    <div id="paymentOptions" style="display: none; margin-top: 20px;">
                        <button class="hover-button" id="couponButton" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 5px;">Coupon</button>
                        <button class="hover-button" id="zelleButton" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 5px;">Zelle</button>
                        <button class="hover-button" id="checkButton" style="padding: 15px 30px; background-color: #001f3f; color: white; border-radius: 10px; margin: 5px;">Check</button>
                    </div>

                    <!-- Zelle Payment Form (Initially Hidden) -->
                    <div id="zellePaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you submit your Zelle.</strong></p>
                        <p>Zelle Account: 9176035614</p>
                        <p>Price of series: ${{ $series->price }}</p>
                        <form action="{{ route('payment.zelle.series') }}" method="POST">
                            @csrf
                            <input type="hidden" name="series_id" value="{{ $series->id }}">
                            <input type="text" name="zelle_account_from" placeholder="Zelle Account Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="zelle_amount" placeholder="Amount I Zelled" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="zelle_date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px;">
                                Submit Zelle Payment
                            </button>
                        </form>
                    </div>

                    <!-- Check Payment Form (Initially Hidden) -->
                    <div id="checkPaymentForm" style="display: none; text-align: center; margin-top: 10px;">
                        <p><strong>Please don't fill this out until after you mail your check.</strong></p>
                        <p>Check mail address: 136-05 72nd Road, Flushing, NY 11367</p>
                        <p>Price of series: ${{ $series->price }}</p>
                        <form action="{{ route('payment.check.series') }}" method="POST">
                            @csrf
                            <input type="hidden" name="series_id" value="{{ $series->id }}">
                            <input type="text" name="check_name" placeholder="Check Name" required style="padding: 5px; margin: 5px;">
                            <input type="number" name="check_amount" placeholder="Check Amount" required style="padding: 5px; margin: 5px;">
                            <input type="date" name="check_date" required style="padding: 5px; margin: 5px;">
                            <button type="submit" class="hover-button" style="padding: 15px 30px; background-color: #28a745; color: white; border-radius: 10px;">
                                Submit Check Payment
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Series.</p>
            @endauth
        </div>

        <!-- Shiur List -->
            <div style="text-align: center; margin-bottom: 40px;">
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($shiurs as $shiurItem)
                        <li style="margin: 15px 0;">
                        <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}"
                               style="display: inline-block; padding: 12px 30px; font-size: 18px; color: white; background-color: #ff007f; text-decoration: none; border-radius: 50px; transition: transform 0.3s, box-shadow 0.3s;"
                               onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)';"
                               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                            {{ $shiurItem->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
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
        window.onload = function() {
            var otherPaymentOptionsBtn = document.getElementById('showOtherPaymentOptions');
            var paymentOptions = document.getElementById('paymentOptions');

            if (otherPaymentOptionsBtn) {
                otherPaymentOptionsBtn.onclick = function(event) {
                    event.preventDefault();
                    paymentOptions.style.display = paymentOptions.style.display === 'none' ? 'block' : 'none';
                };
            }

            document.getElementById('zelleButton').onclick = function() {
                document.getElementById('zellePaymentForm').style.display = 'block';
                document.getElementById('checkPaymentForm').style.display = 'none';
            };

            document.getElementById('checkButton').onclick = function() {
                document.getElementById('checkPaymentForm').style.display = 'block';
                document.getElementById('zellePaymentForm').style.display = 'none';
            };

            document.getElementById('couponButton').onclick = function() {
                document.getElementById('couponSection').style.display = 'block';
            };
        };
    </script>
@endsection
