@extends('layouts.app')

@section('title', 'Your Purchased Series')

@section('content')
    <div class="container">
        <div class="row">
            <p>Add a filter to filter between different speakers</p>
            @if(!$purchasedSeries->isEmpty())
                @foreach($purchasedSeries as $series)
                    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
                        <a href="{{ route('user.series.show', ['id' => $series->id]) }}"
                           style="display: block; overflow: hidden; border-radius: 8px; transition: transform 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 90%; max-width: 300px;"
                           onmouseover="this.style.transform='scale(1.05)';"
                           onmouseout="this.style.transform='scale(1)';">
                            <img src="{{ asset($series->image_path) }}"
                                 alt="{{ $series->title }}"
                                 style="width: 100%; height: auto; display: block;"/>
                        </a>
                        @if($series->zoom_link)
                            <div style="margin-top: 10px; text-align: center; width: 100%; max-width: 300px;">
                                <a href="{{ $series->zoom_link }}" target="_blank" class="btn"
                                   style="background-color: #007bff; color: white; text-decoration: none; display: block; padding: 10px; text-align: center;"
                                   onmouseover="this.style.transform='scale(1.05)';"
                                   onmouseout="this.style.transform='scale(1)';">
                                    Join Zoom Meeting
                                </a>
                                @if($series->zoom_id || $series->zoom_password)
                                    <div style="margin-top: 5px; text-align: center;">
                                        @if($series->zoom_id)
                                            <p>Zoom ID: {{ $series->zoom_id }}</p>
                                        @endif
                                        @if($series->zoom_password)
                                            <p>Zoom Password: {{ $series->zoom_password }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>You haven't purchased any series yet.</p>
            @endif
        </div>
    </div>
@endsection
