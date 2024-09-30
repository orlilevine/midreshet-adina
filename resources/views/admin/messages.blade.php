@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <div class="container">
        <h1>Contact Messages</h1>

        @if ($messages->isEmpty())
            <p>No messages found.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Sent At</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
