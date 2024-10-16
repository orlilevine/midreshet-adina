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
        @if (Route::is('home'))
.container {
            padding-left: 0;
            padding-right: 0;
            max-width: 100%;
        }
        @endif

        body {
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #ff007f;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
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
            color: #E6E6FA !important;
        }

        .nav-link.login, .nav-link.register {
            background-color: #001f3f;
            color: white !important;
            border-radius: 50px;
            font-size: 1.2rem;
            padding: 10px 25px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .nav-link.login:hover, .nav-link.register:hover {
            background-color: #006666;
            transform: scale(1.05);
        }

        .full-width-title {
            background-color: #Ff007f;
            color: white;
            text-align: center;
            padding: 40px 0;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            margin-top: 0;
            font-size: 3rem;
        }



        main {
            padding: 60px 0;
        }

        /* Footer Styles */
        footer {
            background-color: #f8f9fa;
            padding: 4rem 0;
        }

        footer h5 {
            font-size: 1.5rem;
            color: #ff007f;
        }

        footer p, footer a {
            font-size: 1.1rem;
            color: #333;
        }

        footer a:hover {
            color: #001f3f;
            text-decoration: none;
        }

        .footer-bottom {
            background-color: #ff007f;
            color: white;
            padding: 15px;
            font-size: 0.9rem;
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
            background-color: #ff007f;
            color: white;
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px;
            margin-top: 20px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .elevate-text .btn:hover {
            background-color: #001f3f;
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
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/MAlogo.jpg') }}" alt="Logo" style="height: 80px; width: auto;" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="shiursDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shiurim
                </a>
                <div class="dropdown-menu" aria-labelledby="shiursDropdown">
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 1]) }}">Mrs. Shira Smiles</a>
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 2]) }}">Mrs. Dina Schoonmaker</a>
                    <a class="dropdown-item" href="{{ route('speakers.show', ['speakerId' => 3]) }}">Rabbi Avi Slansky</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a class="nav-link login" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link register" href="{{ route('register') }}">Register</a></li>
            @else
                @if (Auth::user()->isAdmin())
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

<!-- Hero Section: Displayed only on the Home route -->
@if (Route::is('home'))
    <div class="elevate-slides-container">
        <!-- First Slide -->
        <div class="elevate-slide active" style="background-image: url('{{ asset('images/KotelBlueSky.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Connection</h1>
                <p>Stay connected to Eretz Yisrael, no matter where you are in the world.</p>
                <a href="#learn-more" class="btn">Learn about our speakers from Eretz Yisrael</a>
            </div>
        </div>

        <!-- Second Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/Seforim.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Learning</h1>
                <p>Feel disconnected from Torah, Hashkafah, or Halacha? </p>
                 <p>Elevate is where you can reignite your inner spark.</p>
                <a href="#learn-more" class="btn">Learn about our Shiurim</a>
            </div>
        </div>

        <!-- Third Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/beach.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Happiness</h1>
                <p>Grab a cozy spot on your couch, a warm cup of coffee, and your computer—it's time to spark relaxation and happiness.</p>
                <a href="#learn-more" class="btn">Learn More about our Zoom classes</a>
            </div>
        </div>

        <!-- Fourth Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/Connect.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Community</h1>
                <p>Join a community of Frum women like yourselves trying to inspire their daily lives.</p>
                <a href="#learn-more" class="btn">Learn More about our listeners</a>
            </div>
        </div>

        <!-- Fifth Slide -->
        <div class="elevate-slide" style="background-image: url('{{ asset('images/House.png') }}');">
            <div class="elevate-text">
                <h1>Elevate Your Day</h1>
                <p>Ever feel your running so many errands and never have a chance to stop and think? </p>
                   <p> Join our classes and start each morning with inspiration.</p>
                <a href="#learn-more" class="btn">See our schedule</a>
            </div>
        </div>
    </div>


@endif

<!-- Main Content -->
<main class="container">
    @yield('content')
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h5>Midreshet Adina</h5>
                <p>Helping women grow in their spiritual journey through deep Torah learning and inspiring shiurim.</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
                    <li><a href="https://www.instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://www.twitter.com" target="_blank">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <p>&copy; {{ date('Y') }} Midreshet Adina. All rights reserved.</p>
    </div>
</footer>

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

</body>
</html>
