@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('{{ asset('images/purpleFlowers.png') }}'); height: 100vh; background-size: cover; background-position: center;">
        <div class="overlay" style="background-color: rgba(0,0,0,0); height: 100%; display: flex; align-items: center;">
            <div class="container text-white text-center">
                <h1>Ignite Your Inner Spark</h1>
                <p>Midreshet Adina enriches our community’s spirituality through Shiurim.</p>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mt-3 animated-button" data-toggle="modal" data-target="#welcomeModal">
                    Click here to grow
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Additional content for the homepage can go here -->
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
                    <p>Thank you for visiting Midreshet Adina. We are excited to help you on your spiritual journey. Explore our Shiurim and connect with our community.</p>
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
/* Hide the button initially */
.animated-button {
opacity: 0;
transform: translateY(100px); /* Start off below the viewport */
transition: opacity 1s ease-out, transform 1s ease-out;
}

/* Animation keyframes for gliding */
@keyframes glideIn {
from {
opacity: 0;
transform: translateY(100px); /* Start position */
}
to {
opacity: 1;
transform: translateY(0); /* End position */
}
}

/* Apply animation */
.show-button {
animation: glideIn 2.5s ease-out forwards;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var button = document.querySelector('.animated-button');
        setTimeout(function() {
            button.classList.add('show-button');
        }, 500); // Delay before button appears, adjust as needed
    });
</script>
