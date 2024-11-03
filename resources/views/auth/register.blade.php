@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center text-white" style="background-color: #001f3f;">{{ __('Create Your Account') }}</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name -->
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                            </div>

                            <!-- Full Hebrew Name -->
                            <div class="form-group">
                                <label for="full_hebrew_name">Full Hebrew Name</label>
                                <input
                                    id="full_hebrew_name"
                                    type="text"
                                    class="form-control"
                                    name="full_hebrew_name"
                                    value="{{ old('full_hebrew_name') }}"
                                    required
                                    pattern="[\u0590-\u05FF\s]+"
                                    title="Please enter Hebrew characters only">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>


                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required>
                            </div>

                            <!-- Date of Birth -->
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            </div>

                            <!-- Street Address -->
                            <div class="form-group">
                                <label for="street_address">Street Address</label>
                                <input id="street_address" type="text" class="form-control" name="street_address" value="{{ old('street_address') }}" required>
                            </div>

                            <!-- City -->
                            <div class="form-group">
                                <label for="city">City</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                            </div>

                            <!-- State -->
                            <div class="form-group">
                                <label for="state">State</label>
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required>
                            </div>

                            <!-- Zip Code -->
                            <div class="form-group">
                                <label for="zip_code">Zip Code</label>
                                <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}">
                            </div>

                            <!-- Country -->
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required>
                            </div>


                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">Register</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
