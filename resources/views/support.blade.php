@extends('app')

@section('title', 'Support')

@section('content') 
    <div class="bg-gray-200 min-h-screen">
        @include('partials.dashboard-header')
        <div class="px-4">
            <div class="max-w-3xl bg-white rounded-lg mx-auto my-16 p-16">
                <h1 class="text-2xl font-medium mb-2">Support</h1>
                <p>Please leave a detailed description of your support inquiry.</p>
                <form action="{{ route('support.send) }}" method="POST">
                    @csrf
                    <input type="text" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" name="subject" placeholder="Subject">
                    <textarea name="message" cols="30" rows="10" placeholder="Your message..."></textarea>
                    <button>Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection