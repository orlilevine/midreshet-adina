@extends('layouts.app')

@section('title', 'Edit Series')

@section('content')
    <div class="container">
        <h1>Edit Series</h1>

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

        <form action="{{ route('admin.series.update', $series->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Series Title</label>
                <input type="text" name="title" class="form-control" value="{{ $series->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $series->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="speaker_id">Speaker</label>
                <select name="speaker_id" class="form-control" required>
                    @foreach($speakers as $speaker)
                        <option value="{{ $speaker->id }}" {{ $series->speaker_id == $speaker->id ? 'selected' : '' }}>{{ $speaker->first_name }} {{ $speaker->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $series->price }}" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label for="series_image">Series Image (optional)</label>
                <input type="file" name="series_image" class="form-control">
            </div>

            {{-- Add fields for Zoom link, ID, and password --}}
            <div class="form-group">
                <label for="zoom_link">Zoom Link</label>
                <input type="text" name="zoom_link" class="form-control" value="{{ $series->zoom_link }}">
            </div>

            <div class="form-group">
                <label for="zoom_id">Zoom ID</label>
                <input type="text" name="zoom_id" class="form-control" value="{{ $series->zoom_id }}">
            </div>

            <div class="form-group">
                <label for="zoom_password">Zoom Password</label>
                <input type="text" name="zoom_password" class="form-control" value="{{ $series->zoom_password }}">
            </div>

            <button type="submit" class="btn btn-success">Update Series</button>
        </form>
    </div>
@endsection
