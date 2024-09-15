<!-- resources/views/admin/shiur/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create a New Shiur</h1>
    <form action="{{ route('shiur.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="series_id">Series</label>
            <select name="series_id" id="series_id">
                <!-- Populate series options -->
            </select>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="recording">Upload Recording</label>
            <input type="file" name="recording" id="recording" accept="audio/*">
        </div>

        <button type="submit">Save Shiur</button>
    </form>
@endsection
