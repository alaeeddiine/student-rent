@extends('layouts.app')

@section('title', $property->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Property Header -->
    <div class="mb-8">
        <a href="{{ route('properties.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors mb-4">
            <i class="fas fa-chevron-left mr-2 text-sm"></i> Back to listings
        </a>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $property->title }}</h1>
        <div class="flex items-center text-blue-600">
            <i class="fas fa-map-marker-alt mr-2 text-sm"></i>
            <p class="text-lg">{{ $property->location }}</p>
        </div>
    </div>

    <!-- Property Image Gallery -->
    <div class="relative rounded-2xl overflow-hidden shadow-sm mb-8 group">
        @if($property->image)
            <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-96 md:h-[500px] object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="w-full h-96 md:h-[500px] bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                <i class="fas fa-home fa-5x opacity-80"></i>
            </div>
        @endif
    </div>

    <!-- Property Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Key Features -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100">Key Features</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bed text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $property->bedrooms }}</p>
                            <p class="text-sm text-gray-500">Bedrooms</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bath text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $property->bathrooms }}</p>
                            <p class="text-sm text-gray-500">Bathrooms</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $property->capacity ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Capacity</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">${{ number_format($property->price, 0) }}</p>
                            <p class="text-sm text-gray-500">Monthly Rent</p>
                        </div>
                </div>

                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $property->type ?? 'Student Housing' }}</p>
                            <p class="text-sm text-gray-500">Property Type</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $property->available_from ? \Carbon\Carbon::parse($property->available_from)->format('M Y') : 'Now' }}</p>
                            <p class="text-sm text-gray-500">Available</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100">Property Description</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($property->description)) !!}
                </div>
            </div>

            <!-- Amenities -->
            @if($property->extras)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100">Amenities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach(explode(',', $property->extras) as $extra)
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">{{ trim($extra) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <br>

            <!-- Booking Form -->
            @auth
                @if (auth()->user()->role === 'student')
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-gray-200 mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Schedule a Viewing</h2>
                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                                <input type="text" id="name" name="name" class="w-full border border-gray-300 bg-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition placeholder-gray-400" placeholder="John Doe" required>
                            </div>

                            <div>
                                <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact Info</label>
                                <input type="text" id="contact" name="contact" class="w-full border border-gray-300 bg-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition placeholder-gray-400" placeholder="Phone or Email" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="tour_date" class="block text-sm font-medium text-gray-700 mb-2">Preferred Tour Date</label>
                                <input type="date" id="tour_date" name="tour_date" class="w-full border border-gray-300 bg-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-3 rounded-lg font-medium transition-all duration-300 hover:shadow-lg">
                            <i class="fas fa-calendar-check mr-2"></i> Book Viewing
                        </button>
                    </form>
                </div>
                @endif
            @endauth

        </div>

        <!-- Sidebar -->
        <div>
            <!-- Contact Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8 top-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-900">Property Agent</h3>
                        <p class="text-sm text-gray-500">{{ explode('@', $property->user->email)[0] }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <a href="mailto:{{ $property->user->email }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-center py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Email Agent
                    </a>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-phone-alt mr-2"></i> Call Agent
                    </button>
                </div>
            </div>
            <!-- Share Options -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="font-semibold text-gray-900 mb-4">Share this property</h3>
                <div class="flex space-x-3">
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-200 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-400 rounded-full flex items-center justify-center hover:bg-blue-200 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-red-100 text-red-500 rounded-full flex items-center justify-center hover:bg-red-200 transition-colors">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center hover:bg-blue-200 transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Listings -->
    <div class="flex justify-center">
        <a href="{{ route('properties.index') }}" class="inline-flex items-center bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-medium transition-colors hover:shadow-md">
            <i class="fas fa-arrow-left mr-2"></i> Browse More Properties
        </a>
    </div>
</div>
@endsection