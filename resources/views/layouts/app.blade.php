<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentRentals | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
        .bg-gradient-accent {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-accent {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }
        .btn-accent:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .text-accent {
            color: #f97316;
        }
        .border-accent {
            border-color: #f97316;
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-primary shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-white flex items-center hover-scale">
                        <i class="fas fa-home mr-3"></i> StudentRentals
                        <span class="bg-gradient-to-r from-orange-300 to-amber-200 bg-clip-text text-transparent">StudentRentals</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-orange-200 transition font-medium">Home</a>
                    <a href="{{ route('properties.index')}}" class="text-white hover:text-orange-200 transition font-medium">Properties</a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-orange-200 transition font-medium">Contact</a>

                    @guest
                        <a href="{{ route('login') }}" class="bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-gray-100 transition shadow-md hover-scale">
                            Login <i class="fas fa-sign-in-alt ml-2"></i>
                        </a>
                    @else
                        @if(Auth::user()->role == 'student')
                            <a href="{{ route('student.dashboard') }}" class="bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-gray-100 transition shadow-md hover-scale">
                                My Dashboard <i class="fas fa-user-graduate ml-2"></i>
                            </a>
                        @elseif(Auth::user()->role == 'owner')
                            <a href="{{ route('owner.dashboard') }}" class="bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-gray-100 transition shadow-md hover-scale">
                                My Dashboard <i class="fas fa-user-tie ml-2"></i>
                            </a>
                        @endif
                    @endguest
                </div>
                <div class="md:hidden">
                    <button class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <h3 class="text-xl font-bold mb-6 text-orange-400 flex items-center">
                        <i class="fas fa-home mr-3"></i> StudentRentals
                    </h3>
                    <p class="text-gray-400">Finding your perfect student accommodation since 2023.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6 text-orange-400">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-white transition flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-orange-400"></i> Properties
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-orange-400"></i> Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6 text-orange-400">Contact Info</h3>
                    <div class="space-y-3 text-gray-400">
                        <p class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-orange-400"></i> 123 Campus Ave, University City
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-3 text-orange-400"></i> (123) 456-7890
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-orange-400"></i> info@studentrentals.com
                        </p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} StudentRentals. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle would go here
    </script>
</body>
</html>