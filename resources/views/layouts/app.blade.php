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
        }

        /* Navbar Styles */
        .navbar {
            background-color: #B47EE5;
        }
        .navbar-nav {
            flex-direction: row;
            justify-content: center; /* Center the items horizontally */
        }
        .nav-item {
            margin: 0 15px; /* Add horizontal spacing between the items */
        }
        .nav-link {
            color: #FFFFFF !important; /* White text */
            font-weight: bold; /* Bold text */
            font-size: 1.3rem; /* Larger text */
            padding: 10px 15px; /* Add padding to make items taller */
        }
        .nav-link:hover {
            color: #E6E6FA !important; /* Light Lavender text on hover */
        }

        /* Full-width purple title section */
        .full-width-title {
            background-color: #4B0082; /* Dark purple */
            color: white;
            text-align: center;
            padding: 40px 20px;
            width: 100vw; /* Full viewport width */
            margin-left: calc(-50vw + 50%); /* Extend the background beyond the container */
            margin-top: 0;
        }

        .full-width-title h1 {
            margin: 0;
            font-size: 2.5em;
        }

        /* Footer Styles */
        footer {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/MAlogo.jpg') }}" alt="Logo" style="height: 80px; width: auto;" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="shiursDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shiurim
                </a>
                <div class="dropdown-menu" aria-labelledby="shiursDropdown">
                    <a class="dropdown-item" href="{{ route('speakers.smiles') }}">Mrs. Shira Smiles</a>
                    <a class="dropdown-item" href="{{ route('speakers.schoonmaker') }}">Mrs. Dina Schoonmaker</a>
                    <a class="dropdown-item" href="{{ route('speakers.slansky') }}">Rabbi Avi Slansky</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
    </div>
</nav>

<!-- Purple Title Section (Dynamic Title) -->
@if (Route::currentRouteName() !== 'home')
    <div class="full-width-title">
        <h1>@yield('title')</h1>
    </div>
@endif


<!-- Main Content -->
<main class="container my-5">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-light text-center text-lg-start mt-auto">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Midreshet Adina</h5>
                <p>Helping women grow in their spiritual journey.</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Quick Links</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-dark">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-dark">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">Facebook</a></li>
                    <li><a href="#" class="text-dark">Instagram</a></li>
                    <li><a href="#" class="text-dark">LinkedIn</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-white">
        &copy; {{ date('Y') }} Midreshet Adina. All rights reserved.
    </div>
</footer>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
