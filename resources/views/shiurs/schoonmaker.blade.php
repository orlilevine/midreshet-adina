@extends('layouts.app')

@section('title', 'Mrs. Dina Schoonmaker')

@section('content')
    <h1>Mrs. Dina Schoonmaker</h1>

    <div class="series-container">
        @foreach ($series as $series)
            <div class="series-box">
                <!-- Make the image clickable and remove the title/description -->
                <a href="{{ route('series.show', ['id' => $series->id]) }}">
                    <img src="{{ asset($series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 100%; height: auto;">
                </a>
            </div>
        @endforeach
    </div>
@endsection

<style>
    .series-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .series-box {
        text-align: center;
    }

    .series-box img {
        border-radius: 10px; /* Optional: adds rounded corners to images */
        transition: transform 0.3s ease; /* Optional: adds a hover effect */
    }

    .series-box img:hover {
        transform: scale(1.05); /* Slightly zoom in on hover */
    }

</style>
