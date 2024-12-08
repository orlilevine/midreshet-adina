@extends('layouts.app')


@section('content')
    <div class="container-fluid" style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)), url('{{ asset('images/KotelNew.jpg') }}'); background-size: cover; background-position: center; height: 100vh; display: flex; align-items: center;">
        <div class="container text-center" style="padding: 40px;">
            <h1 class="mb-4" style="color: #2D6FA3; font-size: 3rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Our Mission Statement</h1>
            <div style="font-size: 1.2rem; color: black; margin-top: 20px;">  <!-- Adjusted spacing here -->
                <p>
                    Elevate inspires busy women to reignite their passion for Torah and personal growth through captivating weekly shiurim.
                    </p>
                <p>
                    Our mission is to provide a consistent and nurturing learning environment, where frum women from around the world can come together each morning to deepen their connection to Torah and strengthen their sense of yiddishkeit.
                    </p>
                <p>By learning from esteemed speakers from Eretz Yisrael, our members build a foundation for lifelong growth, transforming each day with meaningful insight and shared inspiration.
                </p>
            </div>
        </div>
    </div>
@endsection
