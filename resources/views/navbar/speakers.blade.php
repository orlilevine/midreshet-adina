@extends('layouts.app')

@section('content')
    <section class="speakers-section text-center py-5">
        <h2 class="section-title mb-4">Meet Our Inspiring Speakers</h2>

        @foreach ($speakers as $speaker)
            <div class="speaker-section">
                <div class="speaker-info">
                    <img src="{{ asset($speaker->image_path) }}" alt="{{ $speaker->salutation }} {{ $speaker->first_name }} {{ $speaker->last_name }}" class="speaker-img">
                    <h3 class="speaker-name">{{ $speaker->salutation }} {{ $speaker->first_name }} {{ $speaker->last_name }}</h3>
                    <p class="speaker-bio">{{ $speaker->bio }}</p>
                </div>
            </div>
        @endforeach

    </section>
    <style>
        .speakers-section {
             padding-top: 50px;
            padding-bottom: 50px;
        }

        .section-title {
            font-family: 'Roboto', sans-serif;
            font-size: 36px; /* Slightly smaller font */
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 40px;
            text-align: center;
        }

        .speaker-section {
            background-color: #ffffff;
            padding: 30px 15px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .speaker-info {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .speaker-img {
            width: 100%;
            max-width: 250px; /* Smaller image size */
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .speaker-name {
            font-family: 'Merriweather', serif;
            font-size: 24px; /* Slightly smaller font size */
            font-weight: 700;
            color: #1e2a47;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .speaker-bio {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px; /* Smaller font size */
            color: #7f8c8d;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
            padding: 0 15px;
        }

        @media (max-width: 768px) {
            .speaker-section {
                padding: 20px 10px;
            }

            .section-title {
                font-size: 32px;
            }

            .speaker-name {
                font-size: 22px;
            }

            .speaker-bio {
                font-size: 14px;
            }

            .speaker-img {
                max-width: 200px; /* Even smaller for mobile */
            }
        }

    </style>
@endsection
