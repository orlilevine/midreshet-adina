@extends('layouts.app')

@section('title', 'Payment Successful!')

@section('content')
    <div class="container">
        <p>Thank you for your purchase. Your payment has been processed successfully.</p>
        <p><a href="{{ url('/purchased-series') }}" class="cta-button" style="color: #001f3f;">Go to My Shiurim</a></p>
    </div>
@endsection
