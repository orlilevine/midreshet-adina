@extends('layouts.app')

@section('content')
    <section class="speakers-section text-center py-5">
        <h2 class="section-title mb-4">Meet Our Inspiring Speakers</h2>

        <!-- Speaker 1: Mrs. Shira Smiles -->
        <div class="speaker-section">
            <div class="speaker-info">
                <img src="{{ asset('images/smiles.png') }}" alt="Mrs. Shira Smiles" class="speaker-img">
                <h3 class="speaker-name">Mrs. Shira Smiles</h3>
                <p class="speaker-bio">
                    Mrs. Shira Smiles is a highly sought-after international lecturer, a popular seminary teacher, and an experienced curriculum developer. She is well-known for her unique teaching style, which seeks to bring understanding of Torah texts through analysis of relevant sources, while making the lessons learned from every verse relevant to her students' lives. Mrs. Smiles teaches at Darchei Bina Seminary. In addition, she leads women’s study groups and trains Torah teachers all around the world.
                </p>
            </div>
        </div>

        <!-- Speaker 2: Mrs. Dina Schoonmaker -->
        <div class="speaker-section">
            <div class="speaker-info">
                <img src="{{ asset('images/Schoonmaker.png') }}" alt="Mrs. Dina Schoonmaker" class="speaker-img">
                <h3 class="speaker-name">Mrs. Dina Schoonmaker</h3>
                <p class="speaker-bio">
                    Mrs. Dina Schoonmaker holds a B.Ed in Tanach and English from Michlalah College, a master’s degree in Jewish history from Touro College. She has been a member of the Michlalah faculty for over 30 years. Mrs. Schoonmaker lectures internationally and gives vaadim for women, live and over zoom. Mrs. Schoonmaker resides in Yerushalayim with her husband, Rosh Yeshiva of Shapell’s/Yeshiva Darché Noam, and their children.
                </p>
            </div>
        </div>

        <!-- Speaker 3: Rabbi Avi Slansky -->
        <div class="speaker-section">
            <div class="speaker-info">
                <img src="{{ asset('images/Slansky.png') }}" alt="Rabbi Avi Slansky" class="speaker-img">
                <h3 class="speaker-name">Rabbi Avi Slansky</h3>
                <p class="speaker-bio">
                    Rabbi Avi Slansky is rapidly making waves in the world of Torah lectures and literature. He currently serves as the Rav of Riverglen Shtieble in Haverstraw, NY, Rosh Kollel of the Cross River Bank Kollel, and Mashpiah/Director of Camp Romimu’s Rom v'Nisah Program.
                </p>
            </div>
        </div>

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
