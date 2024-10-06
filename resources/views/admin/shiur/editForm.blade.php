@extends('layouts.app')

@section('title', 'Edit Shiur')

@section('content')
    <div class="container">
        <h1>Edit Shiur</h1>

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

        <form action="{{ route('admin.shiur.update', $shiur->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Shiur Title</label>
                <input type="text" name="title" class="form-control" value="{{ $shiur->title }}" required>
            </div>

            <div class="form-group">
                <label for="shiur_date">Shiur Date</label>
                <input type="date" name="shiur_date" class="form-control" value="{{ $shiur->shiur_date->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $shiur->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $shiur->price }}" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label for="recording">Recording (optional)</label>
                <input type="file" name="recording" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Update Shiur</button>
        </form>
    </div>
@endsection
