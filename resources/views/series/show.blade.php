@extends('layouts.app')

@section('title',  $series->title)

@section('content')
    <!-- Series Image -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset($series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 20%; height: auto; border-radius: 10px;">
    </div>

    <!-- Series Description -->
    <div style="text-align: center; margin-bottom: 20px;">
        <p>{{ $series->description }}</p>
    </div>

    <!-- Shiur List -->
    <div style="text-align: center; margin-bottom: 20px;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($shiurs as $shiurItem)
                <li style="margin: 10px 0;">
                    <a href="{{ route('shiur.show', ['seriesId' => $series->id, 'shiurId' => $shiurItem->id]) }}"
                       style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: lightslategray; text-decoration: none; border-radius: 5px; transition: transform 0.3s, box-shadow 0.3s;"
                       onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0px 8px 15px rgba(0,0,0,0.3)';"
                       onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                        Shiur #{{ $shiurItem->shiur_number_in_series }} - {{ $shiurItem->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
