@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-white">
    <!-- Left Column - Branding/Visual -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-800 flex items-center justify-center p-12">
        <div class="max-w-md text-center text-white">
            <div class="mx-auto h-24 w-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-8 backdrop-blur-sm">
                <i class="fas fa-home text-white text-4xl"></i>
            </div>
            <h1 class="text-5xl font-bold mb-4">StudentRentals</h1>
            <p class="text-xl opacity-90">Manage your student properties with ease</p>
            <div class="mt-12 hidden md:block">
                <div class="h-1 w-16 bg-blue-300 mx-auto mb-4"></div>
                <p class="text-blue-100">"The best platform for student housing management"</p>
            </div>
        </div>
    </div>

    <!-- Right Column - Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 lg:p-24">
        <div class="w-full max-w-md">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h2>
            <p class="text-lg text-gray-600 mb-8">Sign in to your owner account</p>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ $errors->first() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition"
                               placeholder="you@example.com">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Log In
                    </button>
                </div>
            </form>

            <!-- Registration Link -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Don't have an account?
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Register 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection