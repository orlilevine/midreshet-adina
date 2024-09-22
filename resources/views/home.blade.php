@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div id="hero-section" class="hero-section" style="height: 100vh; background-size: cover; background-position: center; transition: opacity 1s ease-in-out;">
        <div class="overlay" style="background-color: rgba(0,0,0,0); height: 100%; display: flex; align-items: center;">
            <div class="container text-white text-center">
                @foreach($slides as $slide)
                    <div class="slide" style="background-image: url('{{ asset($slide->image_url) }}');">
                        <h1>{{ $slide->title }}</h1>
                        <p>{{ $slide->subtitle }}</p>
                    </div>
                @endforeach
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mt-3 animated-button" data-toggle="modal" data-target="#welcomeModal">
                    Click here to grow
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="welcomeModalLabel">Welcome to Midreshet Adina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This is a placeholder for a link to another page </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .slide {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        display: none;
        transition: opacity 1s ease-in-out;
    }

    .slide.active {
        display: block;
        opacity: 1;
    }

    .animated-button {
        opacity: 0;
        transform: translateY(100px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .show-button {
        animation: glideIn 2.5s ease-out forwards;
    }

    @keyframes glideIn {
        from {
            opacity: 0;
            transform: translateY(100px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('.slide');
        var currentIndex = 0;

        // Function to show the next slide
        function showNextSlide() {
            slides[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].classList.add('active');
        }

        // Start by showing the first slide
        slides[currentIndex].classList.add('active');

        // Change slides every 5 seconds
        setInterval(showNextSlide, 5000);
    });
</script>
