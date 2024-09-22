@extends('layouts.app')

@section('title', $series->title)

@section('content')
    <!-- Series Image -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 21%; height: auto;">
    </div>

    <!-- Series Description -->
    <div style="text-align: center; margin-bottom: 20px;">
        <p>{{ $series->description }}</p>
    </div>

    <div style="text-align: center; margin-bottom: 20px;">
        <form action="{{ route('payment.createSession.series', ['seriesId' => $series->id]) }}" method="GET">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
                Purchase Entire Series for ${{ $series->price }}
            </button>
        </form>
    </div>



    <!-- Shiur List -->
    <div style="text-align: center; margin-bottom: 20px;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($shiurs as $shiurItem)
                <li style="margin: 10px 0;">
                    <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}"
                       style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: lightslategray; text-decoration: none; border-radius: 5px; transition: transform 0.3s, box-shadow 0.3s;">
                        Shiur #{{ $shiurItem->shiur_number_in_series }} - {{ $shiurItem->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
