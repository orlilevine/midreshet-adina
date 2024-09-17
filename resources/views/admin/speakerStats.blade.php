@extends('layouts.app')

@section('title', 'Speaker Shiur Stats')

@section('content')
    <div class="container">
        <h1>Speaker Shiur Stats</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Speaker</th>
                <th>User</th>
                <th>Total Shiurs Purchased</th>
            </tr>
            </thead>
            <tbody>
            @foreach($speakerStats as $stat)
                <tr>
                    <td>{{ $stat->speaker_name }}</td>
                    <td>{{ $stat->user_name }}</td>
                    <td>{{ $stat->total_shiurs }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
