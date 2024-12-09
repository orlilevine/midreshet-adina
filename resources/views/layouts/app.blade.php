<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add custom CSS if necessary -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        @media screen and (max-width: 768px) {
            @if (Route::is('home'))
    .container {
                padding-left: 15px;
                padding-right: 15px;
                max-width: 1140px;
            }
        @endif
}


        body {
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #2D6FA3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            height: 100px; /* Adjust this to your desired navbar height */
            display: flex;
            align-items: center; /* Centers content vertically */
        }

        .navbar-brand img {
            max-height: 100%; /* Ensures the image doesn't exceed the navbar height */
            object-fit: contain; /* Keeps the aspect ratio intact */
        }

        .navbar-nav {
            flex-direction: row;
            justify-content: center;
        }

        .nav-item {
            margin: 0 15px;
        }

        .nav-link {
            color: #FFFFFF !important;
            font-weight: bold;
            font-size: 1.3rem;
            padding: 10px 15px;
        }

        .nav-link:hover {
            color: #2D6FA3 !important; /* Text turns to your desired color */
            text-shadow: 0 0 3px white, 0 0 10px white; /* Creates a white outline effect */
            transition: color 0.3s ease, text-shadow 0.3s ease; /* Smooth transition */
        }

        .navbar .nav-link.login, .navbar .nav-link.register {
            background-color: transparent; /* Match navbar background */
            color: white; /* Same as navbar text */
            border: 1px solid white; /* Subtle border */
            padding: 6px 14px; /* Slightly smaller padding than original */
            font-size: 15px; /* Between original and smaller size */
            border-radius: 4px; /* Rounded corners for a soft look */
            transition: all 0.3s ease; /* Smooth hover effects */
        }

        .navbar .nav-link.login:hover, .navbar .nav-link.register:hover {
            background-color: white; /* Highlight with a contrasting background */
            text-decoration: none; /* Remove underline */
        }

        .navbar .nav-link.login:focus, .navbar .nav-link.register:focus {
            outline: none; /* Remove focus outline */
            box-shadow: 0 0 4px white; /* Optional subtle focus glow */
        }

        main {
            padding: 60px 0;
        }


        .elevate-slides-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .elevate-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            z-index: 1;
            transition: opacity 3s ease-in-out, transform 3s ease-in-out;
        }


        .elevate-slide.active {
            opacity: 1;
            z-index: 2;
            transform: scale(1.05); /* Zoom effect for active slide */
        }

        .elevate-text {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        }

        .elevate-text h1 {
            font-size: 4rem;
        }

        .elevate-text p {
            font-size: 1.5rem;
            margin-top: 1rem;
            opacity: 0;
            animation: fadeIn 1.5s ease-out 0s forwards; /* Shortened duration */
        }

        .elevate-text .btn {
            background-color: #2D6FA3;
            color: white;
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px;
            margin-top: 20px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .elevate-text .btn:hover {
            transform: translateY(-5px);
        }

        /* Keyframes for fade-in and slide-in effects */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .btn-subscribe {
            background-color: #2F3D46;
            color: #FFFFFF;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 50px;
            border: 2px solid transparent;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-subscribe:hover {
            background-color: black;
            color: #ffffff;
            border-color: #030D22;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px); /* Lift the button slightly on hover */
        }
        .page-title {
            font-family: 'Delius';
            color: #2D6FA3;
            text-align: center;
            font-size: 3rem; /* Existing font size */
            margin: 20px 0 0 0; /* Existing margin */
            animation: popIn 0.6s ease-in-out forwards;
            opacity: 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Added text shadow */
        }


        @keyframes popIn {
            0% { transform: scale(0.7); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo_with_shadow (1).png') }}" alt="Logo" style="height: 180px; width: auto;" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="shiursDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shiurim
                </a>
                <div class="dropdown-menu" aria-labelledby="shiursDropdown">
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 1]) }}">Reb. Shira Smiles</a>
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 2]) }}">Mrs. Dina Schoonmaker</a>
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 3]) }}">Rabbi Avi Slansky</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('schedule') }}">Schedule</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    About Us
                </a>
                <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                    <a class="dropdown-item" href="{{ route('about') }}">About Us</a>
                    <a class="dropdown-item" href="{{ route('speakers') }}">About Our Speakers</a>
                    <a class="dropdown-item" href="{{ route('mission') }}">Our Mission Statement</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a class="nav-link login" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link register" href="{{ route('register') }}">Register</a></li>
            @else
                @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Area</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('user.purchases') }}">My Shiurim</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</nav>


<!-- Dynamic Page Title -->
@if(View::hasSection('title'))
    <h1 class="page-title">@yield('title')</h1>
@endif

<!-- Hero Section: Displayed only on the Home route -->
@if (Route::is('home'))
    <div class="elevate-slides-container">
        <!-- First Slide -->
        <div class="elevate-slide active" style="background-image: url('{{ asset('images/KotelBlue.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Connection</h1>
                <p>Stay connected to Eretz Yisrael, no matter where you are in the world.</p>
                <a href="{{ url('/speakers') }}" class="btn">Learn about our speakers from Eretz Yisrael</a>
            </div>
        </div>

        <!-- Second Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/Seforim.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Learning</h1>
                <p>Feel disconnected from Torah, Hashkafah, or Halacha? </p>
                 <p>Elevate is where you can reignite your inner spark.</p>
                <a href="{{ url('/speakers/2') }}" class="btn">Discover our Shiurim</a>
            </div>
        </div>

        <!-- Third Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/beach.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Happiness</h1>
                <p>Grab a cozy spot on your couch, a warm cup of coffee, and your computer—it's time to spark relaxation and happiness.</p>
                <a href="{{ url('/mission') }}" class="btn">Learn More about our Zoom classes</a>
            </div>
        </div>

        <!-- Fourth Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/Connect.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Community</h1>
                <p>Join a community of Frum women like yourselves trying to inspire their daily lives.</p>
                <a href="{{ url('/about') }}" class="btn">Learn More about our vision</a>
            </div>
        </div>

        <!-- Fifth Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/houseNew.jpg') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Day</h1>
                <p>Ever feel your running so many errands and never have a chance to stop and think?</p>
                <p>Join our classes and start each morning with inspiration.</p>
                <a href="{{ url('/schedule') }}" class="btn">See our schedule</a>
            </div>
        </div>
    </div>


@endif

<!-- Main Content -->
<main class="container">
    @yield('content')
</main>

<!-- Footer -->
<footer style="background-color: #2D6FA3; padding: 10px 0; color: #ffffff;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <!-- Logo on the left (Larger size) -->
            <div class="col-md-3 text-left">
                <img src="{{ asset('images/logo_with_shadow (1).png') }}" alt="Logo" style="max-width: 180px;">
            </div>

            <!-- Subscription Section on the right (Centered more) -->
            <div class="col-md-4 text-center">
                <!-- New message above the subscription form -->
                <p style="font-size: 0.85rem; color: #ffffff; margin-bottom: -3px;">
                    Subscribe to our newsletter to hear
                </p>
                <p style="font-size: 0.85rem; color: #ffffff; margin-bottom: 10px;">
                about the latest shiurim!
                </p>
                <form id="subscriptionForm" onsubmit="showSubscriptionMessage(event)" class="d-flex justify-content-center">
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Enter your email"
                        required
                        style="max-width: 180px; font-size: 0.85rem; padding: 6px; border-radius: 20px; border: none; margin-right: 10px;">
                    <button
                        class="btn btn-light"
                        style="font-size: 0.85rem; padding: 6px 12px; border-radius: 20px; color: #2D6FA3; border: none;">
                        Subscribe
                    </button>
                </form>
                <p id="subscriptionMessage" style="color: #ffffff; font-weight: bold; display: none; font-size: 0.75rem; margin-top: 5px;">
                    Sorry, subscription is not set up yet. Try again later.
                </p>
            </div>

            <!-- Tagline in the center (Moved slightly to the right) -->
            <div class="col-md-4 text-center" style="padding-left: 20px;">
                <p style="font-size: 1rem; color: #ffffff; margin: 0;">
                    Helping women grow in their spiritual
                </p>
                <p style="font-size: 1rem; color: #ffffff; margin: 0;">
                    journey through learning.
                </p>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="row mt-2">
            <div class="col-md-12 text-center">
                <p class="mb-0" style="font-size: 0.75rem; color: #ffffff;">
                    &copy; {{ date('Y') }} Midreshet Adina. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>



<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


<!-- jQuery, Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.elevate-slide');
    const slideInterval = 7000;

    function showSlide(index) {
        slides[currentIndex].classList.remove('active');
        currentIndex = (index + slides.length) % slides.length; // Wrap around
        slides[currentIndex].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    setInterval(nextSlide, slideInterval);

</script>
<script>
    function showSubscriptionMessage(event) {
        event.preventDefault(); // Prevents form submission
        const message = document.getElementById("subscriptionMessage");
        message.style.display = "block"; // Show the message
    }
</script>
</body>
</html>
