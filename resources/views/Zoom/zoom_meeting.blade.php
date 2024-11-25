@extends('layouts.app')

@section('title', 'Live Zoom Meeting')

@section('content')
    <div class="container">
        <h2 class="text-center">Live Shiur</h2>
        <div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
            <iframe
                src="{{ $zoomLink }}"
                allow="camera; microphone; fullscreen; display-capture{{ Auth::user()->is_admin ? '; recording' : '' }}"
                style="width: 100%; height: 100%; border: none;">
            </iframe>
        </div>
    </div>
@endsection
