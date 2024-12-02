@extends('layouts.app')

@section('content')

    <!-- Weekly Shiurim Schedule -->
    <section class="weekly-schedule py-5 text-center">
        <h2 class="display-4">Shiurim Schedule</h2>
        <p class="lead mb-4">Join our weekly online classes!</p>
        <div class="schedule-row d-flex justify-content-center flex-wrap">

            <!-- Monday -->
            <div class="schedule-card mx-3 mb-3" style="background-color: #51786F;">
                <h3 class="day-title text-light">Monday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light">Shira Smiles</p>
                    <p class="time text-light">9:00 - 10:00 AM</p>
                    <p class="class-title text-light">Birkas Krias Shma</p>
                </div>
                <div class="shiur-details">
                    <p class="speaker text-light">Dina Schoonmaker</p>
                    <p class="time text-light">10:15 - 11:15 AM</p>
                </div>
            </div>

            <!-- Tuesday -->
            <div class="schedule-card mx-3 mb-3" style="background-color: #51786F;">
                <h3 class="day-title text-light">Tuesday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light">Dina Schoonmaker</p>
                    <p class="time text-light">10:15 - 11:15 AM</p>
                </div>
                <div class="shiur-details">
                    <p class="speaker text-light">Shira Smiles</p>
                    <p class="time text-light">1:00 - 2:00 PM</p>
                    <p class="class-title text-light">Sefer Bereishis</p>
                </div>
            </div>

            <!-- Wednesday -->
            <div class="schedule-card mx-3 mb-3" style="background-color: #51786F;">
                <h3 class="day-title text-light">Wednesday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light">Shira Smiles</p>
                    <p class="time text-light">9:15 - 10:15 AM</p>
                    <p class="class-title text-light">Mussar</p>
                </div>
            </div>

            <!-- Thursday -->
            <div class="schedule-card mx-3 mb-3" style="background-color: #51786F;">
                <h3 class="day-title text-light">Thursday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light">Rabbi Avi Slansky</p>
                    <p class="time text-light">9:00 - 9:50 AM</p>
                    <p class="class-title text-light">Hilchos Shabbos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Current Shiurim Section -->
    <section class="explore-shiurim my-5 container-fluid px-0">
        <div class="container current-shiurim-container">
            <h2 class="text-center display-4">Current Shiurim</h2>
            <p class="text-center lead">Explore the shiurim happening now.</p>
            <div class="row justify-content-center" id="shiurContainer">
                @foreach($currentSeries as $series)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('series.show', ['id' => $series->id]) }}" class="card-link" style="text-decoration: none;">
                            <div class="card"
                                 style="width: 100%; height: 350px; background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                                <img src="{{ asset('storage/' . $series->image_path) }}"
                                     alt="{{ $series->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="card-body text-center" style="padding: 10px;">
                                    <h5 class="card-title text-dark">{{ $series->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Event Countdown Timer -->
    <section class="event-countdown py-5 text-center" style="background-color: #BADFC5;">
        <h2 class="text-dark">
            Upcoming Event: {{ $nextShiurSpeaker ? $nextShiurSpeaker : 'Speaker Name' }} Live Shiur in...
        </h2>
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

        <!-- Display Series Title and Description -->
        <div class="series-info mt-4 text-center">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 2.5rem; color: #2c3e50; font-weight: 700;">
                {{ $nextShiurTitle }}
            </h3>
            <p style="font-family: 'Roboto', sans-serif; font-size: 1.25rem; color: #34495e; font-style: italic;">
                {{ $nextShiurDescription ? $nextShiurDescription : '' }}
            </p>
        </div>
    </section>



    {{-- <section class="why-choose-us py-5 text-center" style="background-color: #001f3f;">
         <h2 class="display-4 text-light">Discover the Midreshet Adina Difference</h2>
         <p class="lead text-light mb-5">Experience Learning Like Never Before</p>
         <div class="carousel">
             <div class="grid-item" style="background-image: url('/images/Smiles.png'); background-size: cover; background-position: center;">
                 <div class="overlay">
                     <i class="fas fa-lightbulb fa-3x mb-3"></i>
                     <h4>Inspiring Shiurim</h4>
                     <p>Learn from top-tier Teachers and gain profound insights.</p>
                 </div>
             </div>
             <div class="grid-item" style="background-image: url('/images/Community.png'); background-size: cover; background-position: center;">
                 <div class="overlay">
                     <i class="fas fa-users fa-3x mb-3"></i>
                     <h4>Supportive Community</h4>
                     <p>Be part of a vibrant, growth-focused women's community.</p>
                 </div>
             </div>
             <div class="grid-item" style="background-image: url('/images/ComputerNew.png'); background-size: cover; background-position: center;">
                 <div class="overlay">
                     <i class="fas fa-laptop-code fa-3x mb-3"></i>
                     <h4>Accessible Anywhere</h4>
                     <p>Our online platform brings Torah learning to you, wherever you are.</p>
                 </div>
             </div>
             <div class="grid-item" style="background-image: url('/images/Calendar.png'); background-size: cover; background-position: center;">
                 <div class="overlay">
                     <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                     <h4>Flexible Schedule</h4>
                     <p>Watch shiurim anytime that fits into your busy life.</p>
                 </div>
             </div>
         </div>
     </section>
 --}}

   {{-- <!-- Statistics Section -->
    <section class="statistics py-5 text-center" style="background-color: #ff007f; color: white;">
            <h2 class="display-4">Elevate</h2>
            <p class="lead mb-5">Join our community!</p>
            <div class="row justify-content-center">
                <div class="col-md-3 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #001f3f; color: white;">
                        <h1 class="count" data-count="2000">0</h1>
                        <p>Shiurim Downloads</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #001f3f; color: white;">
                        <h1 class="count" data-count="30">0</h1>
                        <p>Communities</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #001f3f; color: white;">
                        <h1 class="count" data-count="1000">0</h1>
                        <p>Active Listeners</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="statistic" style="transition: transform 0.3s; padding: 20px; border-radius: 10px; background-color: #001f3f; color: white;">
                        <h1 class="count" data-count="600">0</h1>
                        <p>Series Completed</p>
                    </div>
                </div>
            </div>
        </section>
--}}
@endsection


<style>
    .why-choose-us {
        perspective: 1000px;
        overflow: hidden;
    }

    .carousel {
        position: relative;
        width: 100%;
        height: 300px;
        transform-style: preserve-3d;
        transform: rotateY(0deg);
        transition: transform 1s;
        animation: rotateCarousel 10s infinite linear;
    }

    /* midreshet adina difference*/
    .grid-item {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        height: 200px;
        margin: -100px 0 0 -100px;
        background-size: cover;
        background-position: center;
        transform-style: preserve-3d;
        backface-visibility: hidden;
        border-radius: 15px;
        transition: transform 1s;
    }

    /* midreshet adina difference*/
    .grid-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* Soft dark overlay for subtle contrast */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        padding: 10px;
        border-radius: 15px;
    }

    /* midreshet adina difference*/
    .grid-item .overlay h4, .grid-item .overlay p {
        color: white;
    }

    @keyframes rotateCarousel {
        from {
            transform: rotateY(0deg);
        }
        to {
            transform: rotateY(-360deg);
        }
    }

    /* Event Countdown Timer */
    .countdown-box {
        background-color: #fff;
        color: #001f3f;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    /* Current Series */
    .card-container {
        perspective: 1000px;
    }

    /* Current Series */
    .card-flip {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s;
    }

    /* Current Series */
    .card-container:hover .card-flip {
        transform: rotateY(180deg);
    }

    /* Current Series */
    .card {
        width: 100%;
        height: 350px;
        border-radius: 10px;
        backface-visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
    }

    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }


    /* Current Series */
    .front img {
        opacity: 1; /* Ensure full visibility */
        transition: none; /* Remove fade transition */
    }


    /* Current Series */
    .back {
        background-color: #2F3D46;
        color: white;
        padding: 20px;
        border-radius: 10px;
    }

    /* Current Series */
    .back .btn {
        background-color: #BADFC5;
        color: white;
    }

    .row .col-md-3, .col-sm-6 {
        padding: 10px; /* Add space between cards */
    }

    /* Statistics section */
    .statistics .statistic {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }

    /* Statistics section */
    .statistics .statistic:hover {
        transform: scale(1.05);
    }

    /* Statistics section */
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

    /* Schedule */
    .weekly-schedule {
        background-color: white;
    }

    /* Schedule */
    .schedule-row {
        max-width: 1200px;
        display: flex;
        justify-content: center; /* Center the cards */
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 0 auto; /* Center the row within the parent */
    }

    /* Schedule */
    .schedule-card {
        width: 250px;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s;
        text-align: center; /* Center the text inside cards */
    }

    /* Schedule */
    .schedule-card:hover {
        transform: scale(1.05);
    }

    /* Schedule */
    .day-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    /* Schedule */
    .shiur-details {
        margin-bottom: 1rem;
    }

    /* Schedule */
    .speaker {
        font-weight: bold;
        font-size: 1.1rem;
    }

    /* Schedule */
    .time {
        font-style: italic;
        font-size: 1rem;
    }

    /* Schedule */
    .class-title {
        font-size: 1rem;
        color: #ffddb3;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const gridItems = document.querySelectorAll('.grid-item');
        const totalItems = gridItems.length;
        const angleStep = 360 / totalItems;

        function positionItemsInCircle() {
            gridItems.forEach((item, index) => {
                const angle = angleStep * index;
                const theta = angle * (Math.PI / 180); // Convert degrees to radians

                // Decrease the radius values to make the circle smaller
                const radius = 200; // Adjust the radius size here (smaller value for a smaller circle)
                const x = radius * Math.sin(theta); // X position in the circle
                const z = radius * Math.cos(theta); // Z depth for the 3D effect

                item.style.transform = `rotateY(${angle}deg) translateZ(${z}px) translateX(${x}px)`;
            });
        }

        // Call the function to position items
        positionItemsInCircle();
    });


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
        const nextShiurTime = "{{ $nextShiur }}";
        if (!nextShiurTime) return;

        const countdownElement = document.getElementById('countdown');
        const shiurDate = new Date(nextShiurTime);

        function updateCountdown() {
        const now = new Date();
        const diff = shiurDate - now;

        if (diff <= 0) {
        countdownElement.innerHTML = '<p>Shiur is live now!</p>';
        return;
    }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = days;
        document.getElementById('hours').textContent = hours;
        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
    }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });

</script>
