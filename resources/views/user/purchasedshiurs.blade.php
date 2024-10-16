@extends('layouts.app')

@section('title', 'Your Purchased Shiurim | ' . $series->title)

@section('content')
    <div class="container">
        <h1 class="text-center my-4" style="color: #001f3f;">Your Purchased Shiurim</h1>
        <div class="row">
            @foreach($series->shiurs as $shiur)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border: none; border-radius: 15px;">
                        <div class="card-body" style="padding: 20px;">
                            <h5 class="card-title" style="font-weight: bold; font-size: 18px; color: #001f3f;">{{ $shiur->title }}</h5>
                            <p class="card-text">{{ $shiur->description }}</p>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>

                            @if($series->zoom_link)
                                <p><strong style="color: #ff007f;">Zoom Link:</strong> <a href="{{ $series->zoom_link }}" target="_blank" style="color: #001f3f;">{{ $series->zoom_link }}</a></p>
                            @endif

                            @if($series->zoom_id)
                                <p><strong style="color: #ff007f;">Zoom ID:</strong> {{ $series->zoom_id }}</p>
                            @endif

                            @if($series->zoom_password)
                                <p><strong style="color: #ff007f;">Zoom Password:</strong> {{ $series->zoom_password }}</p>
                            @endif

                            <audio controls style="width: 100%; margin-top: 10px;">
                                <source src="{{ Storage::url($shiur->recording_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <br>
                            <a href="{{ Storage::url($shiur->recording_path) }}" download class="btn" style="background-color: #001f3f; color: white; margin-top: 10px; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s;">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s;
    }

    .btn:hover {
        background-color: #ff007f; /* Change button color on hover */
    }

</style>
