@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("You're logged in!") }}
                    </h2>
                    <a href="{{ route('user.purchases') }}" class="btn btn-primary mt-4" style="background-color: slategray; color: white;">
                        Go to My Purchased Shiurim
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
