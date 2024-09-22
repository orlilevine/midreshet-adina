@extends('layouts.app')

@section('title', 'Your Purchased Shiurim | ' . $series->title)

@section('content')
    <div class="container">
        <div class="row">
            @foreach($series->shiurs as $shiur)
                <div style="border: 1px solid black; border-radius: 8px; padding: 15px; margin: 0 10px 20px 10px; box-sizing: border-box; font-size: 12px;">
                    <h5 style="font-weight: bold; font-size: 15px;">{{ $shiur->title }}</h5>
                    <br>
                    <p>{{ $shiur->description }}</p>
                    <p>{{ \Carbon\Carbon::parse($shiur->shiur_date)->format('F j, Y') }}</p>

                    @if($series->zoom_link)
                        <p><strong>Zoom Link:</strong> <a href="{{ $series->zoom_link }}" target="_blank">{{ $series->zoom_link }}</a></p>
                    @endif

                    @if($series->zoom_id)
                        <p><strong>Zoom ID:</strong> {{ $series->zoom_id }}</p>
                    @endif

                    @if($series->zoom_password)
                        <p><strong>Zoom Password:</strong> {{ $series->zoom_password }}</p>
                    @endif

                    <audio controls>
                        <source src="{{ Storage::url($shiur->recording_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    <a href="{{ asset($shiur->recording_path) }}" download class="btn" style="background-color: slategray; color: white; margin-top: 10px; display: inline-block; padding: 5px 10px; text-align: center; text-decoration: none;">Download</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
