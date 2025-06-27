@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="md:flex">
            <!-- Contact Info Section -->
            <div class="md:w-1/2 bg-gradient-to-br from-blue-800 to-blue-600 p-10 md:p-12 text-white">
                <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
                <p class="mb-8 text-blue-100 text-lg">Have questions about our properties or need assistance? Our team is here to help you find your perfect student accommodation.</p>
                
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-700 rounded-xl p-4 shadow-md">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-semibold">Our Office</h3>
                            <p class="text-blue-200 mt-1">123 Campus Avenue, University City</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-700 rounded-xl p-4 shadow-md">
                            <i class="fas fa-phone-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-semibold">Phone</h3>
                            <p class="text-blue-200 mt-1">(123) 456-7890</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-700 rounded-xl p-4 shadow-md">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-semibold">Email</h3>
                            <p class="text-blue-200 mt-1">info@studentrentals.com</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form Section -->
            <div class="md:w-1/2 p-10 md:p-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
                
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full px-5 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-5 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" required>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-5 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" required></textarea>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-full transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl group">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Send Message</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection