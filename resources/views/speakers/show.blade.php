@extends('layouts.app')

@section('title', $speaker->full_name)

@section('content')
    <div class="container">
        <div class="series-container">
            @foreach ($series as $serie)
                <div class="series-box">
                    <a href="{{ route('series.show', ['id' => $serie->id]) }}">
                        <img src="{{ asset('storage/' . $serie->image_path) }}" alt="{{ $serie->title }} Cover" style="width: 100%; height: auto;">
                    </a>
                    <p>{{ $serie->title }}</p>
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
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .series-box img:hover {
        transform: scale(1.05);
    }
</style>
