@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-700 to-indigo-800 rounded-3xl shadow-2xl overflow-hidden mb-16">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="relative px-8 py-16 md:py-24 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Your Ideal <span class="text-orange-300">Student Home</span> Awaits</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-10">Premium student accommodations combining comfort, convenience, and community near your campus.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('properties.index') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/30">
                    Explore Listings <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="mb-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Why Choose StudentRentals?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">We've redefined student housing with a focus on quality, convenience, and community.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-blue-100">
                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-wallet text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-900">Transparent Pricing</h3>
                <p class="text-gray-600">No hidden fees. All-inclusive rates tailored to student budgets with flexible payment options.</p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-purple-100">
                <div class="w-16 h-16 bg-purple-50 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-map-marked-alt text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-900">Strategic Locations</h3>
                <p class="text-gray-600">Properties within 15-minute walk to campus, with verified transit times and local amenities.</p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-blue-100">
                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-user-graduate text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-900">Academic Environment</h3>
                <p class="text-gray-600">Quiet study lounges, high-speed WiFi, and academic-focused communities to support your success.</p>
            </div>
        </div>
    </section>

    <!-- Recent Properties -->
    <section class="mb-20">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Featured Properties</h2>
                <p class="text-gray-600">Curated selections based on student preferences and verified quality standards</p>
            </div>
            <a href="{{ route('properties.index') }}" class="mt-4 md:mt-0 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                View all properties <i class="fas fa-chevron-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($recentProperties as $property)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 w-full overflow-hidden">
                        @if ($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                                <i class="fas fa-home fa-3x opacity-80"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-medium shadow-xs">
                            ${{ number_format($property->price, 0) }}/mo
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-semibold text-gray-900 truncate pr-2">{{ $property->title }}</h3>
                            <span class="bg-green-50 text-green-700 text-xs px-2 py-1 rounded-full font-medium flex items-center">
                                <i class="fas fa-check-circle mr-1 text-xs"></i> Verified
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i> 
                            <span class="truncate">{{ $property->location }}</span>
                        </p>
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
                        <a href="{{ route('properties.show', $property->id) }}" class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-center py-3 rounded-lg font-medium transition-all duration-300 hover:shadow-lg">
                            View Details <i class="fas fa-chevron-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Testimonials -->
    <section class="mb-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Trusted by Students</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from students who found their perfect home through our platform</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-start mb-6">
                    <div class="text-4xl text-gray-300 mr-4">"</div>
                    <p class="text-gray-700 text-lg">Finding housing as an international student was daunting, but StudentRentals made it effortless. My apartment is just 10 minutes from campus and has everything I need.</p>
                </div>
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 w-14 h-14 rounded-full flex items-center justify-center text-white font-bold mr-4 shadow-sm">MS</div>
                    <div>
                        <p class="font-semibold text-gray-900">Maria S.</p>
                        <p class="text-sm text-gray-500">Business Administration</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-start mb-6">
                    <div class="text-4xl text-gray-300 mr-4">"</div>
                    <p class="text-gray-700 text-lg">The quality of properties on StudentRentals exceeded my expectations. I found a modern studio that fits my budget and has an amazing study lounge on-site.</p>
                </div>
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 w-14 h-14 rounded-full flex items-center justify-center text-white font-bold mr-4 shadow-sm">JD</div>
                    <div>
                        <p class="font-semibold text-gray-900">Jamie D.</p>
                        <p class="text-sm text-gray-500">Computer Science</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-3xl p-10 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Find Your Student Home?</h2>
        <p class="text-blue-100 text-lg max-w-2xl mx-auto mb-8">Join thousands of students who've found their perfect accommodation through our platform.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('properties.index') }}" class="inline-flex items-center justify-center bg-white text-blue-700 hover:bg-gray-100 font-semibold py-4 px-8 rounded-xl transition-all duration-300 hover:shadow-lg">
                Browse Properties <i class="fas fa-search ml-3"></i>
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white font-semibold py-4 px-8 rounded-xl border border-white/20 transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-question-circle mr-3"></i> Get Help
            </a>
        </div>
    </section>
</div>
@endsection