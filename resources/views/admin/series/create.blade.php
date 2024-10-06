@extends('layouts.app')

@section('title', 'Create Series')

@section('content')
    <div class="container">
        <h1>Create Series</h1>

        {{-- Display general validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.series.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Series Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="series_image">Series Image</label>
                <input type="file" class="form-control-file" id="series_image" name="series_image">
                @error('series_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speaker_id">Speaker</label>
                <select class="form-control" id="speaker_id" name="speaker_id" required>
                    <option value="" disabled selected>Select a speaker</option>
                    @foreach($speakers as $speaker)
                        <option value="{{ $speaker->id }}" {{ old('speaker_id') == $speaker->id ? 'selected' : '' }}>
                            {{ $speaker->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="zoom_link">Zoom Link</label>
                <input type="text" class="form-control" id="zoom_link" name="zoom_link" value="{{ old('zoom_link') }}">
            </div>

            <div class="form-group">
                <label for="zoom_id">Zoom ID</label>
                <input type="text" class="form-control" id="zoom_id" name="zoom_id" value="{{ old('zoom_id') }}">
            </div>

            <div class="form-group">
                <label for="zoom_password">Zoom Password</label>
                <input type="text" class="form-control" id="zoom_password" name="zoom_password" value="{{ old('zoom_password') }}">
            </div>

            <!-- Add price input with default value of 100 -->
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', 100) }}" min="0" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Series</button>
        </form>
    </div>
@endsection
