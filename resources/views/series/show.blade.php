@extends('layouts.app')

@section('title', $series->title . ' | ' . $series->speaker->full_name)

@section('content')
    <!-- Series Image -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset($series->image_path) }}" alt="{{ $series->title }} Cover" style="width: 20%; height: auto; border-radius: 10px;">
    </div>

    <!-- Series Description -->
    <div style="text-align: center; margin-bottom: 20px;">
        <p>{{ $series->description }}</p>
    </div>

    <!-- Buttons for each Shiur -->
    <div style="text-align: center;">
        <p>{{ $series->description }}</p>

        @for ($i = 1; $i <= $series->number_of_shiurs; $i++)
            <a href="{{ route('shiurs.index', ['id' => $i]) }}" style="margin: 5px;">Shiur #{{ $i }}</a>
        @endfor
    </div>


    <!-- Shiur List -->
    <div class="shiur-container">
        @foreach ($shiurs as $shiur)
            <div class="shiur-box">
                <h3>{{ $shiur->title }}</h3>
                <p>{{ Str::limit($shiur->description, 100) }}</p>
                <p>Price: ${{ $shiur->price }}</p>
                <a href="{{ route('purchase', ['shiur_id' => $shiur->id]) }}">Purchase & Download</a>
            </div>
        @endforeach
    </div>
@endsection
