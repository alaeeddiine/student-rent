@extends('layouts.app')

@section('title', 'Properties')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header with Filter Controls -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Browse Student Properties</h1>
            <p class="text-gray-600">Find your perfect student accommodation near campus</p>
        </div>
        
        <div class="flex flex-wrap gap-3 w-full md:w-auto">
            <button class="flex items-center bg-white border border-gray-200 text-gray-700 px-5 py-3 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-filter text-blue-600 mr-3"></i> Filters
            </button>
            <button class="flex items-center bg-white border border-gray-200 text-gray-700 px-5 py-3 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-map-marker-alt text-purple-600 mr-3"></i> Map View
            </button>
        </div>
    </div>

    <!-- Property Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($properties as $property)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 group">
            <!-- Property Image -->
            <div class="relative h-64 w-full overflow-hidden">
                @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                        <i class="fas fa-home fa-3x opacity-80"></i>
                    </div>
                @endif
                
                <!-- Price Badge -->
                <div class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm backdrop-blur-sm">
                    ${{ number_format($property->price, 0) }}/mo
                </div>
                <!-- Property Type -->
                <div class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                    {{ $property['type'] ?? 'Student Housing' }}
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>

            <!-- Property Details -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-semibold text-gray-900 truncate">{{ $property['title'] }}</h3>
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">Available</span>
                </div>
                
                <p class="text-gray-600 mb-4 flex items-center">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i> 
                    <span class="truncate">{{ $property['location'] }}</span>
                </p>
                
                <!-- Features Grid -->
                <div class="grid grid-cols-3 gap-3 mb-6">
                    <div class="text-center">
                        <div class="bg-gray-50 rounded-lg p-2">
                            <i class="fas fa-bed text-blue-600 mb-1 text-lg"></i>
                            <p class="text-sm font-medium text-gray-800">{{ $property->bedrooms }}</p>
                            <p class="text-xs text-gray-500">Beds</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-gray-50 rounded-lg p-2">
                            <i class="fas fa-bath text-blue-600 mb-1 text-lg"></i>
                            <p class="text-sm font-medium text-gray-800">{{ $property->bathrooms }}</p>
                            <p class="text-xs text-gray-500">Baths</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-gray-50 rounded-lg p-2">
                            <i class="fas fa-users text-blue-600 mb-1 text-lg"></i>
                            <p class="text-sm font-medium text-gray-800">{{ $property->capacity ?? '-' }}</p>
                            <p class="text-xs text-gray-500">Capacity</p>
                        </div>
                    </div>
                </div>
                
                <!-- View Button -->
                <a href="{{ route('properties.show', $property->id) }}" class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-center py-3 rounded-lg font-medium transition-all duration-300 hover:shadow-lg">
                    View Details <i class="fas fa-chevron-right ml-2 text-sm"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        <nav class="flex items-center space-x-2">
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-medium shadow-sm">
                1
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium">
                2
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium">
                3
            </a>
            <span class="px-2 text-gray-500">...</span>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium">
                8
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium">
                <i class="fas fa-chevron-right"></i>
            </a>
        </nav>
    </div>

    <!-- CTA Section -->
    <div class="mt-16 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-10 text-center border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Can't Find What You're Looking For?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-6">Join our waiting list and be the first to know about new properties matching your criteria.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-3 max-w-md mx-auto">
            <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg">
                Notify Me
            </button>
        </div>
    </div>
</div>
@endsection