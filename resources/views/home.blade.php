@extends('layouts.app')

@section('content')

    <!-- Introduction Section -->
    <section class="intro my-5">
        <h2 class="text-center">Discover Your Spiritual Journey</h2>
        <p class="text-center">At Midreshet Adina, we believe in empowering women through learning. Join our vibrant community and deepen your understanding of Jewish teachings.</p>
    </section>

    <!-- Featured Series -->
    <section class="featured-series my-5">
        <h2 class="text-center">Featured Series</h2>
        <div class="row">
            @foreach($featuredSeries as $series)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $series->image_path) }}" class="card-img-top" alt="{{ $series->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $series->title }}</h5>
                            <p class="card-text">{{ Str::limit($series->description, 100) }}</p>
                            <a href="{{ route('series.show', ['id' => $series->id]) }}" class="btn btn-dark">Explore Shiurim</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

   {{-- <!-- Upcoming Series -->
    <section class="upcoming-events my-5">
        <h2 class="text-center">Upcoming Series</h2>
        <ul class="list-group">
            @foreach($upcomingSeries as $series)
                <li class="list-group-item">
                    <img src="{{ asset('storage/' . $series->image_path) }}" class="img-thumbnail" alt="{{ $series->title }}">
                    {{ $series->title }}
                    <a href="{{ route('series.show', ['Id' => $series->id]) }}" class="btn btn-link">Details</a>
                </li>
            @endforeach
        </ul>
    </section>--}}
@endsection
