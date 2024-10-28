@extends('layouts.app')

@section('title', 'Your Purchased Series')

@section('content')
    <div class="container">
        <div class="row">
            @if(!$purchasedSeries->isEmpty())
                @foreach($purchasedSeries as $series)
                    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
                        <a href="{{ route('user.series.show', ['id' => $series->id]) }}"
                           style="display: block; overflow: hidden; border-radius: 8px; transition: transform 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 90%; max-width: 300px;"
                           onmouseover="this.style.transform='scale(1.05)';"
                           onmouseout="this.style.transform='scale(1)';">
                            <img src="{{ Storage::url($series->image_path) }}"
                                 alt="{{ $series->title }}"
                                 style="width: 100%; height: auto; display: block;"/>
                        </a>
                        @if($series->daily_link)
                            <div style="margin-top: 10px; text-align: center; width: 100%; max-width: 300px;">
                                <a href="{{ route('daily.meeting', ['id' => $series->id, 'url' => urlencode($series->daily_link)]) }}"
                                   class="btn"
                                   style="background-color: #007bff; color: white; text-decoration: none; display: block; padding: 10px; text-align: center;"
                                   onclick="console.log('{{ route('daily.meeting', ['id' => $series->id, 'url' => urlencode($series->daily_link)]) }}')">
                                    Join Daily Meeting
                                </a>
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
