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
    <style>
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
            background-color: darkturquoise;
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

        .hero {
            background-image: url('path-to-your-image.jpg'); /* Add a beautiful background image */
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.4);
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .hero .btn {
            background-color: #ff007f;
            color: white;
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px;
            margin-top: 20px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .hero .btn:hover {
            background-color: darkturquoise;
            transform: translateY(-5px);
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
            color: darkturquoise;
            text-decoration: none;
        }

        .footer-bottom {
            background-color: #ff007f;
            color: white;
            padding: 15px;
            font-size: 0.9rem;
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
    <div class="hero" style="background-image: url('{{ asset('images/KotelBlueSky.png') }}'); background-size: cover; background-position: center; height: 100vh;">
        <div style="color: white; text-align: center; padding-top: 20vh;">
            <h1>Welcome to Midreshet Adina</h1>
            <p>Explore our enriching shiurim and grow on your spiritual journey.</p>
            <a href="{{ route('about') }}" class="btn btn-primary">Learn More</a>
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
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">YouTube</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        &copy; {{ date('Y') }} Midreshet Adina. All rights reserved.
    </div>
</footer>

<!-- Bootstrap and JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
