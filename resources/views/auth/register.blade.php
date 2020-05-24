@extends('app')

@section('content')
@include('partials.nav')
    <div class="flex h-screen bg-gray-200 p-4 rotate">
        <div class="sm:max-w-xl md:max-w-2xl w-full m-auto">
            <form method="POST" action="{{ route('register') }}" class="flex items-stretch bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-indigo-500 sm:border-0">
                @csrf
                <div class="flex hidden overflow-hidden relative sm:block w-5/12 md:w-6/12 bg-gray-600 text-gray-300 py-4 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
                    <div class="flex-1 absolute bottom-0 text-white p-10">
                        <h3 class="text-4xl font-bold inline-block">Register</h3>
                        <p class="text-gray-500 whitespace-no-wrap">
                            Signup for an Account
                        </p>
                    </div>
                    <svg class="absolute animate h-full w-4/12 sm:w-2/12 right-0 inset-y-0 fill-current text-white" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <polygon points="0,0 100,100 100,0">
                    </svg>
                </div>
                <div class="flex-1 p-6 sm:p-10 sm:py-12">
                    <h3 class="text-xl text-gray-700 font-bold mb-6">
                        Register <span class="text-gray-400 font-light">for an account</span></h3>

                    <input id="name" type="text" class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4 {{ $errors->has('name') ? ' border-red-500' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                    @if ($errors->has('name'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('name') }}
                        </p>
                    @endif

                    <input id="email" type="email" class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4 {{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('email') }}
                        </p>
                    @endif

                    <input id="password" type="password" class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4 {{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" required placeholder="Password">
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('password') }}
                        </p>
                    @endif

                    <input id="password-confirm" type="password" class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4" name="password_confirmation" required placeholder="Confirm Password">

                    <div class="flex flex-wrap items-center">
                        <div class="w-full sm:flex-1">
                            <input type="submit" value="Register" class="w-full sm:w-auto bg-indigo-500 text-indigo-100 px-6 py-2 rounded hover:bg-indigo-600 focus:outline-none cursor-pointer">
                        </div>
                    </div>

                    <p class="w-full text-xs text-left text-gray-700 mt-8">
                        Already have an account?
                        <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                            Login
                        </a>
                    </p>

                    <div class="flex justify-center items-left flex-col mt-10">
    
                        <div class="max-w-5xl flex justify-start">
                            <a href="/login/google" class="google-blue text-gray-100 hover:text-white shadow font-bold w-10 h-10 rounded-full flex justify-center items-center cursor-pointer">
                                <svg viewBox="0 0 24 24" class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg"><path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"/></svg>
                            </a>
                            <a href="/login/github" class="bg-gray-900 text-gray-100 hover:text-white shadow font-bold w-10 h-10 rounded-full flex justify-center items-center cursor-pointer ml-2">
                                <svg viewBox="0 0 24 25" class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>  
                            </a>
                            <a href="/login/facebook" class="bg-indigo-600 text-gray-100 hover:text-white shadow font-bold w-10 h-10 rounded-full flex justify-center items-center cursor-pointer text-sm ml-2">
                                <svg viewBox="0 0 24 24" class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"><path d="M23.998 12c0-6.628-5.372-12-11.999-12C5.372 0 0 5.372 0 12c0 5.988 4.388 10.952 10.124 11.852v-8.384H7.078v-3.469h3.046V9.356c0-3.008 1.792-4.669 4.532-4.669 1.313 0 2.686.234 2.686.234v2.953H15.83c-1.49 0-1.955.925-1.955 1.874V12h3.328l-.532 3.469h-2.796v8.384c5.736-.9 10.124-5.864 10.124-11.853z"/></svg>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
