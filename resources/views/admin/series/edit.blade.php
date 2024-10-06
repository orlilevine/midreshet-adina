@extends('layouts.app')

@section('title', 'Edit Series')

@section('content')
    <div class="container">
        <h1>Edit Series</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($series as $singleSeries)
                <tr>
                    <td>{{ $singleSeries->title }}</td>
                    <td>
                        <a href="{{ route('admin.series.editForm', $singleSeries->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
