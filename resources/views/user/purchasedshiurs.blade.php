@extends('layouts.app')

@section('title', 'Your Purchased Shiurim')

@section('content')
    <div class="container">
        <div class="row">

                    @foreach($series->shiurs as $shiur)
                        <div class="mt-2">
                            <h5>{{ $shiur->title }}</h5>
                            <p>{{ $shiur->description }}</p>
                            <audio controls>
                                <source src="{{ asset($shiur->recording_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <a href="{{ asset( $shiur->recording_path) }}" download class="btn btn-success mt-2">Download</a>

                        </div>
                    @endforeach
                </div>
        </div>
    </div>
@endsection
