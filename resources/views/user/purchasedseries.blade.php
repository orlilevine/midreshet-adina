@extends('layouts.app')

@section('title', 'Your Purchased Series')

@section('content')
    <div class="container">
        <div class="row">
            @if(!$purchasedSeries->isEmpty())
                @foreach($purchasedSeries as $series)
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <a href="{{ route('user.series.show', ['id' => $series->id]) }}"
                           style="display: block; overflow: hidden; border-radius: 8px; transition: transform 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 90%; max-width: 300px;"
                           onmouseover="this.style.transform='scale(1.05)';"
                           onmouseout="this.style.transform='scale(1)';">
                            <img src="{{ asset($series->image_path) }}"
                                 alt="{{ $series->title }}"
                                 style="width: 100%; height: auto; display: block; transition: transform 0.3s ease-in-out;"/>
                        </a>
                    </div>
                @endforeach
            @else
                <p>You haven't purchased any series yet.</p>
            @endif
        </div>
    </div>
@endsection
