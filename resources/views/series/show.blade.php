@extends('layouts.app')

@section('title', $series->title)

@section('content')
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

    <!-- Series Description -->
    <div style="text-align: center; margin-bottom: 40px;">
        @auth
            @if ($hasPurchasedSeries)
                <!-- Show My Shiurim Button if Purchased -->
                <a href="{{ route('user.purchases') }}"
                   style="padding: 12px 30px; background-color: #ff007f; color: white; border: none; cursor: pointer; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 18px; transition: background-color 0.3s;">
                    Series Purchased - Go to My Shiurim
                </a>
            @else
                <form id="checkoutForm" action="{{ route('payment.createSession.series', ['seriesId' => $series->id]) }}" method="GET">
                    <!-- Checkout Button -->
                    <button type="submit"
                            style="padding: 12px 30px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 50px; font-size: 18px; font-weight: bold; transition: transform 0.3s; margin-bottom: 15px;">
                        Purchase Entire Series for ${{ $series->price }}
                    </button>

                    <!-- Button to Show Other Payment Options -->
                    <p style="margin-bottom: 10px;">
                        <a href="#" id="showOtherPaymentOptions" style="font-size: 16px; text-decoration: underline; color: #001f3f;">Other Payment Options</a>
                    </p>
                </form>

                <!-- Hidden Payment Options Section -->
                <div id="paymentOptions" style="display: none; text-align: center; margin-top: 20px;">
                    <button style="padding: 10px 20px; background-color: #001f3f; color: white; border: none; cursor: pointer; border-radius: 50px; margin: 10px; font-size: 16px; transition: transform 0.3s;">
                        Coupon
                    </button>
                    <button id="zelleButton" style="padding: 10px 20px; background-color: #001f3f; color: white; border: none; cursor: pointer; border-radius: 50px; margin: 10px; font-size: 16px; transition: transform 0.3s;">
                        Zelle
                    </button>
                    <button id="checkButton" style="padding: 10px 20px; background-color: #001f3f; color: white; border: none; cursor: pointer; border-radius: 50px; margin: 10px; font-size: 16px; transition: transform 0.3s;">
                        Check
                    </button>
                </div>
            @endif
        @else
            <p style="font-size: 16px;">Please <a href="{{ route('login') }}" style="color: #ff007f; text-decoration: underline;">log in</a> or <a href="{{ route('register') }}" style="color: #ff007f; text-decoration: underline;">register</a> to purchase this Series.</p>
        @endauth
    </div>

    <!-- Shiur List -->
    <div style="text-align: center; margin-bottom: 40px;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($shiurs as $shiurItem)
                <li style="margin: 15px 0;">
                    <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}"
                       style="display: inline-block; padding: 12px 30px; font-size: 18px; font-weight: bold; color: white; background-color: #ff007f; text-decoration: none; border-radius: 50px; transition: transform 0.3s, box-shadow 0.3s;"
                       onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)';"
                       onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                        {{ $shiurItem->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

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
    };
</script>
