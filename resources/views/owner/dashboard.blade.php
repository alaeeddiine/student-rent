@extends('layouts.app')

@section('title', 'Owner Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Welcome Back, {{ Auth::user()->name }} <span class="fas fa-home"></span></h1>
            <p class="text-gray-600">Manage your student rental properties and bookings</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-medium">
                Property Owner
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Property Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Total Properties -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Total Properties</h3>
                <div class="bg-blue-100 text-blue-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-home"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $totalProperties }}</p>
            <p class="text-sm text-gray-500">Properties listed</p>
            <a href="{{ route('owner.properties.index') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                View all <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>

        <!-- Active Bookings -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Active Bookings</h3>
                <div class="bg-purple-100 text-purple-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $activeBookings }}</p>
            <p class="text-sm text-gray-500">Upcoming viewings</p>
            <a href="{{ route('owner.bookings') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                Manage <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>

        <!-- Occupancy Rate -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Occupancy Rate</h3>
                <div class="bg-green-100 text-green-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $occupancyRate }}%</p>
            <p class="text-sm text-gray-500">Current occupancy</p>
            <a href="#" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                View details <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 mb-12">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('owner.properties.create') }}" class="bg-gray-50 hover:bg-gray-100 p-5 rounded-xl border border-gray-200 transition-colors flex items-center">
                <div class="bg-green-100 text-green-600 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Add Property</h3>
                    <p class="text-sm text-gray-500">List a new rental</p>
                </div>
            </a>
            <a href="{{ route('owner.properties.index') }}" class="bg-gray-50 hover:bg-gray-100 p-5 rounded-xl border border-gray-200 transition-colors flex items-center">
                <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Manage Properties</h3>
                    <p class="text-sm text-gray-500">Update your listings</p>
                </div>
            </a>
            <a href="{{ route('owner.bookings') }}" class="bg-gray-50 hover:bg-gray-100 p-5 rounded-xl border border-gray-200 transition-colors flex items-center">
                <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">View Bookings</h3>
                    <p class="text-sm text-gray-500">Manage tour requests</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection