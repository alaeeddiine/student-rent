@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-10">
        <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8">
            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Edit Property</span>
        </h2>

        <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Property Title</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-home"></i>
                    </div>
                    <input type="text" name="title" id="title" placeholder="Enter the property title"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                        value="{{ old('title', $property->title) }}" required>
                </div>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Property Description</label>
                <div class="relative">
                    <div class="absolute top-3 left-3 text-gray-400">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                    <textarea name="description" id="description" rows="5" placeholder="Describe the property in detail"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                        required>{{ old('description', $property->description) }}</textarea>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bedrooms -->
                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-bed"></i>
                        </div>
                        <input type="number" name="bedrooms" id="bedrooms" placeholder="Number of bedrooms"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                            value="{{ old('bedrooms', $property->bedrooms) }}" required>
                    </div>
                    @error('bedrooms')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bathrooms -->
                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Bathrooms</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-bath"></i>
                        </div>
                        <input type="number" name="bathrooms" id="bathrooms" placeholder="Number of bathrooms"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                            value="{{ old('bathrooms', $property->bathrooms) }}" required>
                    </div>
                    @error('bathrooms')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Student Capacity</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-users"></i>
                        </div>
                        <input type="number" name="capacity" id="capacity" placeholder="E.g. 3 students"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                            value="{{ old('capacity', $property->capacity) }}" required>
                    </div>
                    @error('capacity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Monthly Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <input type="number" step="0.01" name="price" id="price" placeholder="Enter property price"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                            value="{{ old('price', $property->price) }}" required>
                    </div>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <input type="text" name="location" id="location" placeholder="Enter property location"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition"
                            value="{{ old('location', $property->location) }}" required>
                    </div>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Property Image</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-image"></i>
                    </div>
                    <input type="file" name="image" id="image"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <!-- Current Image Preview -->
                @if($property->image)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                    <div class="relative w-64 h-48 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset('storage/' . $property->image) }}" alt="Current Property Image" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Buttons -->
            <div class="flex flex-col-reverse sm:flex-row justify-between items-center pt-8 gap-4">
                <a href="{{ route('owner.properties.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Properties
                </a>
                <button type="submit"
                    class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-8 py-3 rounded-xl transition duration-300 transform hover:scale-[1.02] shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Property
                </button>
            </div>

            @if ($errors->any())
                <div class="mt-8 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                        <div>
                            <h3 class="text-sm font-medium">There were some errors with your submission:</h3>
                            <ul class="list-disc list-inside mt-2 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
