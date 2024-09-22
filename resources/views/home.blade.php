@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div id="hero-section" class="hero-section">
        <div class="overlay">
            @foreach($slides as $slide)
                <div class="slide" style="background-image: url('{{ asset($slide->image_url) }}');">
                    <h1 class="text-white">{{ $slide->title }}</h1>
                    <p class="text-white">{{ $slide->subtitle }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .hero-section {
        position: relative;
        height: 100vh; /* Full viewport height */
        overflow: hidden; /* Prevent overflow */
    }

    .slide {
        position: absolute; /* Full coverage */
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        align-items: center; /* Center text vertically */
        justify-content: center; /* Center text horizontally */
        text-align: center; /* Center text alignment */
        opacity: 0; /* Start with opacity 0 */
        transform: translateX(100%); /* Start off-screen to the right */
        transition: opacity 0.5s ease, transform 1.5s ease; /* Longer glide effect */
        visibility: hidden; /* Hide all slides by default */
    }

    .slide.active {
        opacity: 1; /* Make it fully visible */
        transform: translateX(0); /* Move to original position */
        visibility: visible; /* Make active slide visible */
    }


</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('.slide');
        var currentIndex = 0;

        // Function to show the next slide
        function showNextSlide() {
            slides[currentIndex].classList.remove('active');

            // Update the index for the next slide
            currentIndex = (currentIndex + 1) % slides.length;

            // Add the active class to the next slide
            slides[currentIndex].classList.add('active');
        }

        // Start by showing the first slide
        if (slides.length > 0) {
            slides[currentIndex].classList.add('active');
        }

        // Change slides every 5 seconds
        setInterval(showNextSlide, 5000);
    });
</script>
