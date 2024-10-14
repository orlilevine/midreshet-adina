@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container-fluid" style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)), url('{{ asset('images/KotelCloseUp.png') }}'); background-size: cover; background-position: center; height: 100vh; display: flex; align-items: center;">
        <div class="container text-center" style="padding: 40px;">
            <h1 class="mb-4" style="color: #001f3f; font-size: 3rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">About Midreshet Adina</h1>
            <p class="lead" style="color: black;">
                Welcome to Midreshet Adina, where we strive to inspire and connect Jewish women through meaningful learning.
            </p>
            <div style="font-size: 1.2rem; color: black; margin-top: 20px;">  <!-- Adjusted spacing here -->
                <p>
                    My name is Jodi, and I founded Midreshet Adina in honor of my dear friend, Adina Kurz. Adina was a beacon of light in my life, leading me on a journey through various shiurim that deepened my understanding of our connection to HaShem.
                </p>
                <p>
                    Living in KGH, I noticed a lack of shiurim available to our community. Inspired by Adina's dedication to learning, I took it upon myself to bring esteemed speakers from Eretz Yisrael to our area, through the computer, creating a vibrant hub for spiritual growth and connection.
                </p>
                <p>
                    When COVID-19 prompted us to shift to Zoom, a beautiful transformation occurred. We expanded our reach, allowing women from all over the globe to join us in learning and connecting. Our virtual platform has become a space where Frum Jewish women can gather, learn, and grow together, regardless of where they are in the world.
                </p>
            </div>
        </div>
    </div>
@endsection
