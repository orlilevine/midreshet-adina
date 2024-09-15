<!-- resources/views/admin/shiur/create.blade.php -->
@extends('layouts.app')

@section('content')
    <form action="{{ route('shiur.store') }}" method="POST">
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
            <button type="submit">Save Shiur</button>
        </div>
    </form>
@endsection
