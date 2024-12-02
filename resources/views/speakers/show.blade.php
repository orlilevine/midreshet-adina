@extends('layouts.app')

@section('title', $speaker->full_name)

@section('content')
    <div class="container">
        <h2 class="page-instructions">Click on each series to learn more!</h2>
        <div class="series-container">
            @foreach ($series as $serie)
                <div class="series-box">
                    <a href="{{ route('series.show', ['id' => $serie->id]) }}">
                        <img src="{{ asset('storage/' . $serie->image_path) }}" alt="{{ $serie->title }} Cover" style="width: 100%; height: auto;">
                    </a>
                    <div class="series-info">
                        <p class="series-title">{{ $serie->title }}</p>
                        @if ($serie->starting_time)
                            <p class="series-time">
                                {{ \Carbon\Carbon::parse($serie->starting_time)->format('g:i A') }}
                            </p>
                        @endif
                        <div class="shiur-dates">
                            @php
                                $dates = [];
                                for ($i = 1; $i <= 8; $i++) {
                                    $dateField = 'shiur_date_' . $i;
                                    if ($serie->$dateField) {
                                        $dates[] = \Carbon\Carbon::parse($serie->$dateField)->format('M j');
                                    }
                                }
                            @endphp
                            @if (!empty($dates))
                                {{ implode(', ', $dates) }}
                            @else
                                <span class="no-dates">Dates TBA</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .page-instructions {
        text-align: center;
        font-size: 1.2em;
        margin-bottom: 20px;
        color: #333;
    }

    .series-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 40px; /* Increased gap between series */
        padding: 20px;
    }

    .series-box {
        text-align: center;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 15px;
        transition: box-shadow 0.3s ease;
        margin-bottom: 30px; /* Added margin to create more space between boxes */
    }

    .series-box:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .series-box img {
        border-radius: 10px;
        transition: transform 0.3s ease;
        margin-bottom: 15px;
    }

    .series-box img:hover {
        transform: scale(1.05);
    }

    .series-info {
        padding: 10px;
    }

    .series-title {
        font-weight: bold;
        font-size: 1.2em;
        margin: 10px 0;
    }

    .series-time {
        font-size: 1em;
        color: #000;
        margin-bottom: 10px;
    }

    .shiur-dates {
        font-size: 0.9em;
        color: #555;
        margin-top: 5px;
    }

    .no-dates {
        font-size: 0.85em;
        color: #999;
    }
</style>
