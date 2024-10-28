@extends('layouts.app')

@section('title', 'Your Purchased Series')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            @if(!$purchasedSeries->isEmpty())
                @foreach($purchasedSeries as $series)
                    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
                        <div style="position: relative; display: block; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 90%; max-width: 300px;">
                            <a href="{{ route('user.series.show', ['id' => $series->id]) }}">
                                <img src="{{ Storage::url($series->image_path) }}"
                                     alt="{{ $series->title }}"
                                     style="width: 100%; height: auto; display: block;"/>
                            </a>
                            @if($series->daily_link)
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
                                    <a href="{{ route('daily.meeting', ['id' => $series->id, 'url' => urlencode($series->daily_link)]) }}"
                                       class="join-live-btn">
                                        Join Live Class
                                    </a>
                                @endif
                            @endif
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
    </style>
@endsection
