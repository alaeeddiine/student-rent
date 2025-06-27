@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-50">
    <!-- Left Column - Visual Showcase -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center p-6 relative overflow-hidden">
        <!-- Floating Icon Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/4 left-1/4 w-40 h-40 rounded-full bg-white animate-float-slow"></div>
            <div class="absolute bottom-1/3 right-1/3 w-32 h-32 rounded-full bg-amber-200 animate-float-medium"></div>
            <div class="absolute top-1/2 right-1/4 w-24 h-24 rounded-full bg-blue-300 animate-float-fast"></div>
        </div>

        <div class="relative z-10 max-w-lg text-center text-white px-6">
            <!-- Main Icon Showcase -->
            <div class="mb-8">
                <div class="inline-flex items-center justify-center p-6 bg-white bg-opacity-20 rounded-full backdrop-blur-sm shadow-lg mb-6">
                    <i class="fas fa-user-plus text-4xl text-white animate-pulse"></i>
                </div>
                <h1 class="text-4xl font-bold mb-4">
                    Join <span class="text-amber-300">StudentRentals</span>
                </h1>
                <p class="text-xl opacity-90 mb-8">Find your perfect student home or manage your properties</p>
            </div>

            <!-- Benefits Grid with Icons -->
            <div class="grid grid-cols-2 gap-4 text-left">
                <div class="flex items-start space-x-3">
                    <div class="bg-white bg-opacity-30 w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shield-alt text-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg mb-1">Secure Platform</h3>
                        <p class="text-sm opacity-80">Bank-level encryption</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-white bg-opacity-30 w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-home text-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg mb-1">Verified Listings</h3>
                        <p class="text-sm opacity-80">Quality student homes</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-white bg-opacity-30 w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-comments text-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg mb-1">24/7 Support</h3>
                        <p class="text-sm opacity-80">Always here to help</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-white bg-opacity-30 w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bolt text-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg mb-1">Quick Setup</h3>
                        <p class="text-sm opacity-80">Get started in minutes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Registration Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-10 lg:p-12">
        <div class="w-full max-w-sm">
            <!-- Form Header with Icon -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center p-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full shadow-lg mb-5">
                    <i class="fas fa-user-edit text-3xl text-white"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600">Join our community today</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3 text-xl"></i>
                    <div>
                        <p class="text-base text-red-700 font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('register.submit') }}">
                @csrf

                <!-- Name Field -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                        Full Name
                    </label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                           class="block w-full px-4 py-3 text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Enter your full name">
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>
                        Email Address
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="block w-full px-4 py-3 text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="your@email.com">
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="block w-full px-4 py-3 text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-12"
                               placeholder="Create a password">
                        <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 toggle-password">
                            <i class="fas fa-eye-slash text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-users-cog text-blue-500 mr-2"></i>
                        Register As
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center space-x-3 p-4 border-2 border-gray-200 rounded-xl hover:border-blue-400 cursor-pointer transition-colors">
                            <input type="radio" name="role" value="student" class="h-6 w-6 text-blue-600 focus:ring-blue-500" checked>
                            <div class="flex items-center">
                                <i class="fas fa-user-graduate text-xl text-blue-500 mr-2"></i>
                                <div>
                                    <p class="font-medium">Student</p>
                                    <p class="text-sm text-gray-500">Looking for housing</p>
                                </div>
                            </div>
                        </label>
                        <label class="flex items-center space-x-3 p-4 border-2 border-gray-200 rounded-xl hover:border-blue-400 cursor-pointer transition-colors">
                            <input type="radio" name="role" value="owner" class="h-6 w-6 text-blue-600 focus:ring-blue-500">
                            <div class="flex items-center">
                                <i class="fas fa-home text-xl text-blue-500 mr-2"></i>
                                <div>
                                    <p class="font-medium">Property Owner</p>
                                    <p class="text-sm text-gray-500">List your properties</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-start pt-2">
                    <div class="flex items-center h-6">
                        <input id="terms" name="terms" type="checkbox" required 
                               class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded-lg">
                    </div>
                    <div class="ml-3 text-base">
                        <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">terms</a> and <a href="#" class="text-blue-600 hover:text-blue-500">privacy policy</a></label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full flex justify-center items-center py-4 px-5 border border-transparent rounded-xl shadow-lg text-xl font-bold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 group">
                    <i class="fas text-white mr-3 group-hover:animate-bounce"></i>
                    Register Now
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 text-center">
                <p class="text-gray-600 text-lg">Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-bold">
                        Sign In <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    });
</script>

<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-20px) translateX(10px); }
    }
    @keyframes float-medium {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-15px) translateX(-5px); }
    }
    @keyframes float-fast {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-10px) translateX(5px); }
    }
    .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
    .animate-float-medium { animation: float-medium 6s ease-in-out infinite; }
    .animate-float-fast { animation: float-fast 4s ease-in-out infinite; }
</style>
@endsection
