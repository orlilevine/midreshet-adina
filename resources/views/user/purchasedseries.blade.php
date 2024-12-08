@extends('layouts.app')

@section('title', 'Your Purchased Series')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="series-container">
            @if(!$purchasedSeries->isEmpty())
                @foreach($purchasedSeries as $series)
                    <div class="series-box">
                        <a href="{{ route('user.series.show', ['id' => $series->id]) }}">
                            <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 100%; height: auto;">
                        </a>
                        <div class="series-info">
                            <p class="series-title">{{ $series->title }}</p>
                            @if($series->zoom_link)
                                @php
                                    $shiurDates = [
                                        $series->shiur_date_1,
                                        $series->shiur_date_2,
                                        $series->shiur_date_3,
                                        $series->shiur_date_4,
                                        $series->shiur_date_5,
                                        $series->shiur_date_6,
                                        $series->shiur_date_7,
                                        $series->shiur_date_8,
                                    ];
                                    $shiurTime = \Carbon\Carbon::parse($series->starting_time);
                                    $allowedTimes = [];

                                    foreach ($shiurDates as $date) {
                                        if ($date) {
                                            $shiurDateTime = \Carbon\Carbon::parse($date)->setTimeFromTimeString($shiurTime->toTimeString());
                                            $allowedStartTime = (clone $shiurDateTime)->subMinutes(15);
                                            $allowedEndTime = (clone $shiurDateTime)->addHours(2);
                                            $allowedTimes[] = [$allowedStartTime, $allowedEndTime];
                                        }
                                    }

                                    $currentDateTime = now();
                                    $canJoin = false;
                                    foreach ($allowedTimes as [$start, $end]) {
                                        if ($currentDateTime->between($start, $end)) {
                                            $canJoin = true;
                                            break;
                                        }
                                    }
                                @endphp

                                @if($canJoin)
                                    <a href="{{ $series->zoom_link }}" target="_blank" class="join-live-btn">
                                        Join Live Class
                                    </a>
                                @endif
                            @endif
                            @if ($series->starting_time)
                                <p class="series-time">
                                    {{ \Carbon\Carbon::parse($series->starting_time)->format('g:i A') }}
                                </p>
                            @endif
                            <div class="shiur-dates">
                                @php
                                    $dates = [];
                                    for ($i = 1; $i <= 8; $i++) {
                                        $dateField = 'shiur_date_' . $i;
                                        if ($series->$dateField) {
                                            $dates[] = \Carbon\Carbon::parse($series->$dateField)->format('M j');
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
            @else
                <p>You haven't purchased any series yet.</p>
            @endif
        </div>
    </div>

<!-- Custom Styles -->
    <style>
        .join-live-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ff007f;
            color: white;
            padding: 15px 30px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            animation: flash 1s infinite alternate;
            box-shadow: 0 4px 15px rgba(255, 0, 127, 0.7);
        }

        /* Flashing effect */
        @keyframes flash {
            from {
                opacity: 1;
            }
            to {
                opacity: 0.5;
            }
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
@endsection
