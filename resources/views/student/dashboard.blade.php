@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Welcome back, {{ Auth::user()->name }} <i class="fas fa-user-graduate text-blue-600"></i></h1>
            <p class="text-gray-600">Your personalized student housing dashboard</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                Student Account
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Upcoming Tours -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Upcoming Tours</h3>
                <div class="bg-blue-100 text-blue-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $upcomingTours }}</p>
            <p class="text-sm text-gray-500">Scheduled property viewings</p>
            <a href="{{ route('student.bookings') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                View all <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>

        <!-- Application Status -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Applications</h3>
                <div class="bg-green-100 text-green-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $activeApplications }}</p>
            <p class="text-sm text-gray-500">Active applications</p>
            <a href="{{ route('student.bookings') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                View status <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 mb-12">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('properties.index') }}" class="bg-gray-50 hover:bg-gray-100 p-5 rounded-xl border border-gray-200 transition-colors flex items-center">
                <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-search"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Find Housing</h3>
                    <p class="text-sm text-gray-500">Browse available properties</p>
                </div>
            </a>
            <a href="{{ route('student.bookings') }}" class="bg-gray-50 hover:bg-gray-100 p-5 rounded-xl border border-gray-200 transition-colors flex items-center">
                <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">My Bookings</h3>
                    <p class="text-sm text-gray-500">Manage property tours</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection