@extends('layouts.app')

@section('title', 'Edit Shiur')

@section('content')
    <div class="container">
        <h1>Edit Shiur</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shiurs as $shiur)
                <tr>
                    <td>{{ $shiur->title }}</td>
                    <td>
                        <a href="{{ route('admin.shiur.editForm', $shiur->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
