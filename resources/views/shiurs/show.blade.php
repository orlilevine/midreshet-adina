@extends('layouts.app')

@section('title', $shiur->title . ' | ' . $series->title)

@section('content')
    <div style="text-align: center;">
        <p>{{ $shiur->description }}</p>
        <p>Price: ${{ $shiur->price }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>
        <div style="text-align: center; margin-bottom: 20px;">
            <!-- Form to initiate purchase -->
            <form action="{{ route('payment.createSession.shiur', ['shiurId' => $shiur->id]) }}" method="GET">
                <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;">
                    Purchase this Shiur
                </button>
            </form>
        </div>
    </div>
@endsection
