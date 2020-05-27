@extends('app')

@section('title', 'Courses')

@section('content') 
    <div class="bg-gray-200 min-h-screen">
        @include('partials.dashboard-header')
        @if(auth()->user()->onTrial())
                <div class="container rounded-lg mx-auto mt-8">
                    @include('partials.trial_notification', ['action_btn' => true])
                </div>
            @endif
        <div class="flex container mx-auto">

            @include('partials.dashboard-nav')

            <div class="w-full bg-white rounded-lg mx-auto my-8 px-10 py-8">
                <h1 class="text-2xl font-medium mb-2">Courses</h1>
                <h2 class="font-medium text-sm text-gray-500 mb-4 uppercase tracking-wide">View your courses below.</h2>
                @foreach(auth()->user()->courses as $course)
                    <div class="border border-gray-300 px-4 py-2 rounded">
                        <span>{{ $course->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection