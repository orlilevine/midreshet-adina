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
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $series->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description', $series->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="series_image">Series Image</label>
                <input type="file" name="series_image" class="form-control-file" id="series_image">
                @error('series_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speaker_id">Speaker</label>
                <select name="speaker_id" class="form-control" id="speaker_id" required>
                    <option value="" disabled>Select a speaker</option>
                    @foreach($speakers as $speaker)
                        <option value="{{ $speaker->id }}" {{ old('speaker_id', $series->speaker_id) == $speaker->id ? 'selected' : '' }}>
                            {{ $speaker->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="shiur_time">Shiur Time</label>
                <input type="time" name="shiur_time" class="form-control" id="shiur_time"
                       value="{{ old('shiur_time', $series->starting_time ? \Carbon\Carbon::parse($series->starting_time)->format('H:i') : '') }}"
                       required>
            </div>

        @for ($i = 1; $i <= 8; $i++)
                <div class="form-group">
                    <label for="shiur_date_{{ $i }}">Shiur Date {{ $i }}</label>
                    <input type="date" name="shiur_date_{{ $i }}" class="form-control" id="shiur_date_{{ $i }}" value="{{ old("shiur_date_$i", $series["shiur_date_$i"]) }}">
                </div>
            @endfor

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $series->price) }}" min="0" required>
            </div>

            <button type="submit" class="btn btn-success">Update Series</button>
        </form>
    </div>
@endsection
