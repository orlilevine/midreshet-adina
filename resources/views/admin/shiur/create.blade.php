<!-- resources/views/admin/shiur/create.blade.php -->

@extends('layouts.app')

@section('title', 'Create Shiur')

@section('content')
    <div class="container">
        <h1>Create Shiur</h1>

        <form action="{{ route('shiur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Shiur Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="series_id">Series</label>
                <select name="series_id" class="form-control" required>
                    <option value="">-- Select Series --</option>
                    @foreach($series as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="shiur_date">Shiur Date</label>
                <input type="date" name="shiur_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="recording">Recording (optional)</label>
                <input type="file" name="recording" class="form-control">
            </div>

            <div class="form-group">
                <label for="series_image">Series Image (optional)</label>
                <input type="file" name="series_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Save Shiur</button>
        </form>
    </div>
@endsection
