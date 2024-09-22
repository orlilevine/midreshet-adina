@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="{{ route('admin.shiur.create') }}" class="btn btn-block" style="background-color: slategray; color: white;">Create Shiur</a>
            </div>
            <div class="col-md-12 mb-3">
                <a href="{{ route('admin.series.create') }}" class="btn btn-block" style="background-color: slategray; color: white;">Create Series</a>
            </div>
            <div class="col-md-12 mb-3">
                <a href="{{ route('admin.speaker.create') }}" class="btn btn-block" style="background-color: slategray; color: white;">Create Speaker</a>
            </div>
            <div class="col-md-12 mb-3">
                <a href="{{ route('admin.shiurStats') }}" class="btn btn-block" style="background-color: slategray; color: white;">View Shiur Stats</a>
            </div>
        </div>

    </div>
@endsection
