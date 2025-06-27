@extends('layouts.app')

@section('title', 'My Properties')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">My Properties</h1>
            <p class="text-gray-600">Manage your student rental listings</p>
        </div>
        <a href="{{ route('owner.properties.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Add New Property
        </a>
    </div>

    <!-- Property Filter/Search -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Statuses</option>
                    <option>Available</option>
                    <option>Rented</option>
                    <option>Maintenance</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Types</option>
                    <option>Apartment</option>
                    <option>House</option>
                    <option>Dorm</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Locations</option>
                    <option>Downtown</option>
                    <option>Campus Area</option>
                    <option>Suburbs</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Properties List -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 mb-8">
        <!-- Table Header -->
        <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-gray-50 border-b border-gray-100">
            <div class="col-span-4 md:col-span-5 font-medium text-gray-700">Property</div>
            <div class="col-span-3 md:col-span-2 font-medium text-gray-700">Status</div>
            <div class="col-span-3 font-medium text-gray-700">Price</div>
            <div class="col-span-2 font-medium text-gray-700 text-right">Actions</div>
        </div>

        <!-- Property Items -->
        @foreach($properties as $property)
        <div class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors">
            <!-- Property Info -->
            <div class="col-span-4 md:col-span-5 flex items-center">
                <div class="w-16 h-16 rounded-lg overflow-hidden mr-4">
                    @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                            <i class="fas fa-home"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">{{ $property->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $property->location }}</p>
                </div>
            </div>

            <!-- Status -->
            <div class="col-span-3 md:col-span-2 flex items-center">
                @if($property->status === 'available')
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Available</span>
                @elseif($property->status === 'rented')
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Rented</span>
                @else
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Maintenance</span>
                @endif
            </div>

            <!-- Price -->
            <div class="col-span-3 flex items-center">
                <span class="font-medium text-gray-900">${{ number_format($property->price, 0) }}/mo</span>
            </div>

            <!-- Actions -->
            <div class="col-span-2 flex items-center justify-end space-x-2">
                <a href="{{ route('owner.properties.edit', $property->id) }}" class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                    <i class="fas fa-edit text-sm"></i>
                </a>
                <a href="{{ route('properties.show', $property->id) }}" class="w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-eye text-sm"></i>
                </a>
                <form action="{{ route('owner.properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($properties->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm p-12 border border-gray-100 text-center">
        <div class="mx-auto w-24 h-24 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-home text-3xl"></i>
        </div>
        <h3 class="text-xl font-medium text-gray-900 mb-2">No properties listed yet</h3>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Get started by adding your first student rental property to the platform.</p>
        <a href="{{ route('owner.properties.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Add Property
        </a>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Total Properties</h3>
                <div class="bg-blue-100 text-blue-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-home"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $properties->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Available</h3>
                <div class="bg-green-100 text-green-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $properties->where('status', 'available')->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Monthly Revenue</h3>
                <div class="bg-purple-100 text-purple-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($properties->sum('price'), 0) }}</p>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        <nav class="flex items-center space-x-2">
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-medium shadow-sm">
                1
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-300 hover:bg-gray-50 font-medium">
                2
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-300 hover:bg-gray-50 font-medium">
                3
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 border border-gray-300 hover:bg-gray-50 font-medium">
                <i class="fas fa-chevron-right"></i>
            </a>
        </nav>
    </div>
</div>
@endsection