@extends('layouts.app')

@section('content')

    <!-- Featured Shiurim Section -->
    <section class="explore-shiurim my-5 container-fluid px-0">
        <div class="container featured-shiurim-container">
            <h2 class="text-center display-4">Featured Shiurim</h2>
            <p class="text-center lead">Join our most popular Series.</p>
            <div class="row justify-content-center" id="shiurContainer">
                @foreach($featuredSeries as $index => $series)
                    <div class="col-md-4 mb-4">
                        <div class="card-container" style="perspective: 1000px;">
                            <div class="card-flip" style="transition: transform 0.8s; transform-style: preserve-3d;">
                                <!-- Front Side of the Card -->
                                <div class="card front" style="position: relative; width: 100%; height: 350px; backface-visibility: hidden; background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                                    <img src="{{ asset('storage/' . $series->image_path) }}" alt="{{ $series->title }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                                    <div class="card-content text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); color: white; padding: 10px; border-radius: 10px;">
                                        <h5>{{ $series->title }}</h5>
                                    </div>
                                </div>
                                <!-- Back Side of the Card -->
                                <div class="card back" style="position: absolute; width: 100%; height: 100%; backface-visibility: hidden; background-color: #001f3f; color: white; border-radius: 10px; padding: 20px; transform: rotateY(180deg);">
                                    <h5>{{ $series->title }}</h5>
                                    <p>{{ Str::limit($series->description, 100) }}</p>
                                    <a href="{{ route('series.show', ['id' => $series->id]) }}" class="btn btn-light btn-block">View this series</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Event Countdown Timer -->
    <section class="event-countdown py-5 text-center" style="background-color: #ff007f;">
        <h2 class="text-light">Upcoming Event: Mrs. Schoonmaker Live Shiur in...</h2>
        <div id="countdown" class="d-flex justify-content-center">
            <div class="countdown-box mx-3">
                <span id="days" class="display-4">00</span>
                <p>Days</p>
            </div>
            <div class="countdown-box mx-3">
                <span id="hours" class="display-4">00</span>
                <p>Hours</p>
            </div>
            <div class="countdown-box mx-3">
                <span id="minutes" class="display-4">00</span>
                <p>Minutes</p>
            </div>
            <div class="countdown-box mx-3">
                <span id="seconds" class="display-4">00</span>
                <p>Seconds</p>
            </div>
        </div>
        <div class="shiur-info mt-4">
            <h3 class="text-light">Date: December 15, 2024</h3>
            <h4 class="text-light">Location: Kew Gardens Hills</h4>
        </div>
    </section>

    <br><br><br><br>

        <!-- Statistics Section -->
        <section class="statistics py-5 text-center" style="background-color: #001f3f; color: white;">
            <h2 class="display-4">Elevate</h2>
            <p class="lead mb-5">Join our community!</p>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #ff007f; color: white;">
                        <h1 class="count" data-count="2000">0</h1>
                        <p>Shiurim Downloads</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #ff007f; color: white;">
                        <h1 class="count" data-count="100">0</h1>
                        <p>Locations</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #ff007f; color: white;">
                        <h1 class="count" data-count="1000">0</h1>
                        <p>Listeners</p>
                    </div>
                </div>
            </div>
        </section>

    <br><br><br><br>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us py-5 text-center" style="background-color: #ff007f;">
        <h2 class="display-4">Why Choose Midreshet Adina?</h2>
        <div class="slide-container mt-5">
            <div class="slides">
                <div class="slide-item p-4" style="background-color: white;">
                    <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                    <h4>Inspiring Classes</h4>
                    <p>Engage with our deep and inspiring Torah teachings. Learn from renowned speakers and gain new insights every day.</p>
                </div>
                <div class="slide-item p-4" style="background-color: white;">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h4>Vibrant Community</h4>
                    <p>Join a supportive, like-minded community of women dedicated to learning and spiritual growth. You’ll feel right at home!</p>
                </div>
                <div class="slide-item p-4" style="background-color: white;">
                    <i class="fas fa-torah fa-3x text-primary mb-3"></i>
                    <h4>Flexible Learning</h4>
                    <p>Access our shiurim at your own pace, whenever you’re ready. Learn Torah on your terms, with courses designed to fit your life.</p>
                </div>
            </div>
        </div>
    </section>



@endsection


<style>
    /* Countdown Timer Styling */
    .countdown-box {
        background-color: #fff;
        color: #001f3f;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .card-container {
        perspective: 1000px;
    }

    .card-flip {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s;
    }

    .card-container:hover .card-flip {
        transform: rotateY(180deg);
    }

    .card {
        width: 100%;
        height: 350px;
        border-radius: 10px;
        backface-visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
    }

    .front img {
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .card-container:hover .front img {
        opacity: 1;
    }

    .back {
        background-color: #001f3f;
        color: white;
        padding: 20px;
        border-radius: 10px;
    }

    .back .btn {
        background-color: #ff007f;
        color: white;
    }

    .row .col-md-3, .col-sm-6 {
        padding: 10px; /* Add space between cards */
    }

    .statistics .statistic {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }

    .statistics .statistic:hover {
        transform: scale(1.05);
    }

    .statistics h1 {
        font-size: 3rem; /* Larger font size for impact */
        margin: 0;
    }

    .featured-shiurim-container {
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (min-width: 992px) {
        .featured-shiurim-container {
            padding-left: 20px;
            padding-right: 20px;
        }
    }


    @keyframes slide-in {
        0% {
            transform: translateX(-100%);
            opacity: 0; /* Start invisible */
        }
        100% {
            transform: translateX(0);
            opacity: 1; /* Fade in */
        }
    }

    .why-choose-us {
        position: relative;
        overflow: hidden;
    }

    .slide-container {
        width: 100%; /* Make the container span the entire width */
        margin: 0 auto;
        position: relative;
        overflow: hidden;
    }

    .slides {
        display: flex;
        animation: slide-continuous 10s linear infinite; /* Faster sliding effect */
    }

    .slide-item {
        flex-shrink: 0;
        width: 33.33%; /* Adjust width as needed */
        margin-right: 20px;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    /* Keyframes for continuous sliding with overlap */
    @keyframes slide-continuous {
        0% {
            transform: translateX(0); /* Start at the beginning */
        }
        30% {
            transform: translateX(-50%); /* Midway through the transition */
        }
        60% {
            transform: translateX(-50%); /* Hold the position with overlap */
        }
        100% {
            transform: translateX(-100%); /* Fully off-screen */
        }
    }


    @media screen and (max-width: 768px) {
        .slide-item {
            width: 100%;
            margin-bottom: 20px;
        }

        .slides {
            flex-direction: column;
            animation: none; /* No sliding on smaller screens */
        }
    }


</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const counters = document.querySelectorAll('.count');
        let observerOptions = {
            root: null,  // Use the viewport as the root
            threshold: 0.5  // Trigger when 50% of the element is visible
        };

        let observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const countTo = parseInt(counter.getAttribute('data-count'));
                    let count = 0;
                    const increment = Math.ceil(countTo / 100);
                    const interval = setInterval(() => {
                        count += increment;
                        counter.textContent = count > countTo ? countTo : count;
                        if (count >= countTo) clearInterval(interval);
                    }, 50);
                    observer.unobserve(counter);  // Stop observing once the animation is done
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);  // Start observing each counter
        });

    });
    document.addEventListener('DOMContentLoaded', function () {
        // Pass the PHP variable to JavaScript by embedding it within the script
        const eventDate = new Date("{{ $eventDate }}"); // Set event date from backend

        const countdownElement = document.getElementById('countdown');
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');

        function updateCountdown() {
            const now = new Date();
            const timeDiff = eventDate - now;

            if (timeDiff > 0) {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                daysElement.textContent = days.toString().padStart(2, '0');
                hoursElement.textContent = hours.toString().padStart(2, '0');
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                secondsElement.textContent = seconds.toString().padStart(2, '0');
            } else {
                countdownElement.textContent = "Event Started!";
            }
        }

        setInterval(updateCountdown, 1000);
    });
</script>
