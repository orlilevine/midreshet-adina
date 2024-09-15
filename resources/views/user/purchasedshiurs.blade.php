@extends('layouts.app')

@section('title', 'Your Purchased Shiurim')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($series->shiurs as $shiur)
                <div>
                    <h5>{{ $shiur->title }}</h5>
                    <p>{{ $shiur->description }}</p>
                    <audio controls>
                        <source src="{{ asset($shiur->recording_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    <!-- Move the button below the audio element and apply inline styling -->
                    <a href="{{ asset($shiur->recording_path) }}" download class="btn" style="background-color: slategray; color: white; margin-top: 10px; display: inline-block; padding: 5px 10px; text-align: center; text-decoration: none;">Download</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
