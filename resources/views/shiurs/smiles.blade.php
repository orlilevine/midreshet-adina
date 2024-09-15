@extends('layouts.app')

@section('title', 'Mrs. Shira Smiles')

@section('content')
    <div class="container">
        <div class="series-container">
            @foreach ($series as $series)
                <div class="series-box">
                    <a href="{{ route('series.show', ['id' => $series->id]) }}">
                        <img src="{{ asset($series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 100%; height: auto;">
                    </a>
                </div>
            @endforeach
        </div>
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
