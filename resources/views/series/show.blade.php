@extends('layouts.app')

@section('title', $series->title)

@section('content')
    <!-- Series Image -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 21%; height: auto;">
    </div>

    <!-- Series Description -->
    <div style="text-align: center; margin-bottom: 20px;">
        @auth
            <form id="checkoutForm" action="{{ route('payment.createSession.series', ['seriesId' => $series->id]) }}" method="GET">
                <!-- Coupon Section (Hidden by Default) -->
                <div id="couponSection" style="display: none; margin-bottom: 10px;">
                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" style="padding: 5px; width: 200px;">
                    <button type="button" id="applyCoupon" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;">
                        Apply Coupon
                    </button>
                </div>

                <!-- Checkout Button -->
                <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                    Purchase Entire Series for ${{ $series->price }}
                </button>

                <!-- Button to Show Coupon Section -->
                <p style="margin-bottom: 10px;">
                    <a href="#" id="showCoupon" style="font-size: 14px; text-decoration: underline; color: #007bff;">Have a coupon?</a>
                </p>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Series.</p>
        @endauth
    </div>

    <!-- Shiur List -->
    <div style="text-align: center; margin-bottom: 20px;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($shiurs as $shiurItem)
                <li style="margin: 10px 0;">
                    <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}"
                       style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: lightslategray; text-decoration: none; border-radius: 5px; transition: transform 0.3s, box-shadow 0.3s;">
                        {{ $shiurItem->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
