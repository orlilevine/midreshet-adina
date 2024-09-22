@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="container my-5">
        <p>This is the Contact Us page. You can add contact information and a form here.</p>

        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Your Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Your Email">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection
