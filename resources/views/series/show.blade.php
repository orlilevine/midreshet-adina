@extends('layouts.app')

@section('title', $series->title)

@section('content')
    <h1>{{ $series->title }}</h1>
    <p>{{ $series->description }}</p>

    <div class="shiur-container">
        @foreach ($shiurs as $shiur)
            <div class="shiur-box">
                <h3>{{ $shiur->title }}</h3>
                <p>{{ Str::limit($shiur->description, 100) }}</p>
                <p>Price: ${{ $shiur->price }}</p>
                <a href="{{ route('purchase', ['shiur_id' => $shiur->id]) }}">Purchase & Download</a>
            </div>
        @endforeach
    </div>
@endsection
