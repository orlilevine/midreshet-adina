@extends('layouts.app')

@section('title', 'Your Purchased Shiurim')

@section('content')
    <div class="container">
        <!-- Series Image at the top -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                    <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }}" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">

            </div>
        </div>

        <div class="row">
            @foreach($series->shiurs as $shiur)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border: none; border-radius: 15px;">
                        <div class="card-body" style="padding: 20px;">
                            <h5 class="card-title" style="font-weight: bold; font-size: 18px; color: #001f3f;">{{ $shiur->title }}</h5>
                            <p class="card-text">{{ $shiur->description }}</p>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>

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

