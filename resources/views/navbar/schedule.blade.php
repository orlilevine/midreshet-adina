@extends('layouts.app')

@section('content')
    <section class="weekly-schedule py-5 text-center">
        <h2 class="display-4">Shiurim Schedule</h2>
        <p class="lead mb-4">Join our weekly online classes!</p>
        <div class="schedule-row d-flex justify-content-center flex-wrap">

            <!-- Monday -->
            <div class="schedule-card animated-card" style="background-color: #001f3f;">
                <h3 class="day-title text-light">Monday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Shira Smiles</strong></p>
                    <p class="time text-light">9:00 - 10:00 AM</p>
                    <p class="class-title text-light"><em>Tefilla</em></p>
                </div>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Dina Schoonmaker</strong></p>
                    <p class="time text-light">10:15 - 11:15 AM</p>
                    <p class="class-title text-light"><em>Personal Growth</em></p>
                </div>
            </div>

            <!-- Tuesday -->
            <div class="schedule-card animated-card" style="background-color: #ff007f;">
                <h3 class="day-title text-light">Tuesday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Dina Schoonmaker</strong></p>
                    <p class="time text-light">10:15 - 11:15 AM</p>
                    <p class="class-title text-light"><em>Bitachon</em></p>
                </div>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Shira Smiles</strong></p>
                    <p class="time text-light">1:00 - 2:00 PM</p>
                    <p class="class-title text-light"><em>Sefer Bereishis</em></p>
                </div>
            </div>

            <!-- Wednesday -->
            <div class="schedule-card animated-card" style="background-color: #001f3f;">
                <h3 class="day-title text-light">Wednesday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Shira Smiles</strong></p>
                    <p class="time text-light">9:15 - 10:15 AM</p>
                    <p class="class-title text-light"><em>Mussar</em></p>
                </div>
            </div>

            <!-- Thursday -->
            <div class="schedule-card animated-card" style="background-color: #ff007f;">
                <h3 class="day-title text-light">Thursday</h3>
                <div class="shiur-details">
                    <p class="speaker text-light"><strong>Rabbi Avi Slansky</strong></p>
                    <p class="time text-light">9:00 - 9:50 AM</p>
                    <p class="class-title text-light"><em>Hilchos Shabbos</em></p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .weekly-schedule {
            background: linear-gradient(135deg, #ff007f, #001f3f);
            color: white;
            padding: 60px 20px;
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
        }

        .schedule-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .schedule-card {
            background-color: #001f3f;
            padding: 20px;
            width: 250px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s, box-shadow 0.4s;
            position: relative;
            overflow: hidden;
        }

        .schedule-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
        }

        .day-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .shiur-details {
            margin-bottom: 10px;
        }

        /* Bold teacher names and italicize class titles */
        .speaker {
            font-weight: bold;
        }

        .class-title {
            font-style: italic;
        }

        /* Animation */
        .animated-card {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s forwards;
            animation-delay: calc(var(--i) * 0.2s);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
