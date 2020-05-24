@extends('app')

@section('title', 'Support')

@section('content') 
    <div class="bg-gray-200 min-h-screen">
        @include('partials.dashboard-header')
        <div class="px-4 pb-16">
            <div class="max-w-3xl bg-white rounded-lg mx-auto mt-16 px-16 py-12">
                <h1 class="text-2xl font-medium mb-2">Support</h1>
                <p>Please leave a detailed description of your support inquiry.</p>
                <form action="{{ route('support.send') }}" method="POST" class="clearfix">
                    @csrf
                    <input type="text" class="wt-input" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                    <textarea name="message" class="wt-input" cols="30" rows="10" placeholder="Your message...">{{ old('message') }}</textarea>
                    <button class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer mt-4">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection