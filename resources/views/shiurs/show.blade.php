@extends('layouts.app')

@section('title', $shiur->title . ' | ' . $series->title)

@section('content')
    <div style="text-align: center;">
        <h1>{{ $shiur->title }}</h1>
        <p>{{ $shiur->description }}</p>
        <p>Price: ${{ $shiur->price }}</p>
        <a href="{{ route('purchase', ['shiur_id' => $shiur->id]) }}">Purchase & Download</a>
    </div>
@endsection
