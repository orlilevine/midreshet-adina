@extends('layouts.app')

@section('content')

    <!-- Introduction Section -->
    <section class="intro my-5 text-white" style="background-color: #001f3f; padding: 40px 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center display-4">Discover Your Spiritual Journey</h2>
        <p class="text-center lead">At Midreshet Adina, we believe in empowering women through learning. Join our vibrant community and deepen your understanding of Jewish teachings.</p>
        <div class="text-center">
            <a href="{{ route('about') }}" class="btn btn-light btn-lg">Join Us Now</a>
        </div>
    </section>

    <!-- Featured Series -->
    <section class="featured-series my-5">
        <h2 class="text-center display-4">Featured Series</h2>
        <div class="row justify-content-center" id="seriesContainer">
            @foreach($featuredSeries as $index => $series)
                <div class="col-md-4 mb-4 series-card" style="opacity: 0.7;">
                    <div class="card shadow-sm" style="border-radius: 10px;">
                        <img src="{{ asset('storage/' . $series->image_path) }}" class="card-img-top" alt="{{ $series->title }}" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $series->title }}</h5>
                            <p class="card-text">{{ Str::limit($series->description, 100) }}</p>
                            <a href="{{ route('series.show', ['id' => $series->id]) }}" class="btn" style="background-color: #ff007f; color: white;">Explore Shiurim</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials my-5" style="background-color: #001f3f; padding: 40px 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center display-4" style="color: white;">What Our Students Say</h2>
        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="text-center">
                        <p class="lead" style="font-size: 1.25rem; margin-bottom: 20px; color: white;">"Midreshet Adina has transformed my understanding of Torah. The teachings are profound!"</p>
                        <h5 style="color: white;">- Sarah Cohen</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="text-center">
                        <p class="lead" style="font-size: 1.25rem; margin-bottom: 20px; color: white;">"The community here is incredibly supportive. I feel empowered every day!"</p>
                        <h5 style="color: white;">- Rachel Green</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="text-center">
                        <p class="lead" style="font-size: 1.25rem; margin-bottom: 20px; color: white;">"The lectures are engaging and enlightening. I love being a part of this community!"</p>
                        <h5 style="color: white;">- Miriam Gold</h5>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>


@endsection

<style>
    .series-card {
        transition: transform 0.5s ease, opacity 0.5s ease;
        transform: scale(0.6); /* Start even smaller */
        opacity: 0.7;
    }

    /* Animation for the cards */
    @keyframes grow {
        0%, 100% { transform: scale(0.6); opacity: 0.7; } /* Smaller initial size */
        50% { transform: scale(0.9); opacity: 1; } /* Smaller max size on hover */
    }

    /* Apply the animation to each card */
    .series-card:nth-child(1) { animation: grow 6s infinite; }
    .series-card:nth-child(2) { animation: grow 6s infinite 2s; }
    .series-card:nth-child(3) { animation: grow 6s infinite 4s; }


</style>
