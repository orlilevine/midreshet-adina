@extends('layouts.app')
@section('title', 'Shiurim')

@section('content')
    <h1>Shiurim</h1>
    <ul>
        @foreach ($shiurs as $shiur)
            <li>
                <a href="{{ route('shiurs.show', $shiur) }}">{{ $shiur->title }}</a>
                - ${{ $shiur->price }}
            </li>
        @endforeach
    </ul>
@endsection
