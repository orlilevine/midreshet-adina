<!-- resources/views/user/purchases.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Your Purchased Shiurs</h1>
    <ul>
        @foreach ($purchases as $purchase)
            <li>{{ $purchase->shiur->title }} - {{ $purchase->shiur->price }}</li>
        @endforeach
    </ul>
@endsection
