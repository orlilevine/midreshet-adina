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
                    <!-- Form to initiate purchase if not purchased -->
                    <form action="{{ route('payment.createSession.shiur', ['shiurId' => $shiur->id]) }}" method="GET">
                        <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;">
                            Purchase this Shiur
                        </button>
                    </form>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to purchase this Shiur.</p>
            @endauth
        </div>
    </div>
@endsection
