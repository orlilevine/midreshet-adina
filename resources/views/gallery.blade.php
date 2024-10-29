@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="container my-5">
        <p>Welcome to the gallery page! Come back later to see more.</p>

        <div class="row">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/350" class="img-fluid mb-3" alt="Sample Image 1">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/350" class="img-fluid mb-3" alt="Sample Image 2">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/350" class="img-fluid mb-3" alt="Sample Image 3">
            </div>
        </div>
    </div>
@endsection
