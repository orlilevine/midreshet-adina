@extends('layouts.app')

@section('title', 'Create Shiur')

@section('content')
    <div class="container">
        <h1>Create Shiur</h1>

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

        <form action="{{ route('shiur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="speaker_id">Speaker</label>
                <select id="speaker_id" name="speaker_id" class="form-control" required>
                    <option value="">-- Select Speaker --</option>
                    @foreach($speakers as $speaker)
                        <option value="{{ $speaker->id }}">{{ $speaker->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="series_id">Series</label>
                <select id="series_id" name="series_id" class="form-control" required>
                    <option value="">-- Select Series --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Shiur Title</label>
                <input type="text" name="title" class="form-control" required>
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
                <label for="price">Price ($)</label>
                <input type="number" name="price" class="form-control" value="15" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="recording">Recording</label>
                <input type="file" name="recording" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Save Shiur</button>
        </form>
    </div>

    <!-- Include the locally hosted jQuery file -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('speaker_id').addEventListener('change', function() {
                var speakerId = this.value;
                var seriesDropdown = document.getElementById('series_id');
                if (speakerId) {
                    fetch('{{ route("fetch.series") }}?speaker_id=' + speakerId)
                        .then(response => response.json())
                        .then(data => {
                            seriesDropdown.innerHTML = '<option value="">-- Select Series --</option>';
                            data.series.forEach(series => {
                                var option = document.createElement('option');
                                option.value = series.id;
                                option.textContent = series.title;
                                seriesDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    seriesDropdown.innerHTML = '<option value="">-- Select Series --</option>';
                }
            });
        });
    </script>
@endsection
