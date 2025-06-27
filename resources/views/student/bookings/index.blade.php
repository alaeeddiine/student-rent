@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ tab: 'pending' }">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-lg shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Property Tours</h1>
            <p class="text-gray-600">Manage your scheduled property viewings</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex space-x-2 mb-8 bg-gray-100 p-1 rounded-xl">
        @foreach (['pending' => 'clock', 'accepted' => 'check-circle', 'refused' => 'times-circle'] as $key => $icon)
            <button 
                @click="tab = '{{ $key }}'"
                :class="tab === '{{ $key }}' ? 'bg-white shadow-sm text-{{ $key === 'pending' ? 'blue' : ($key === 'accepted' ? 'green' : 'red') }}-600' : 'text-gray-600 hover:text-gray-900'"
                class="px-4 py-2 rounded-lg font-medium text-sm transition-all"
            >
                <i class="fas fa-{{ $icon }} mr-2"></i> {{ ucfirst($key) }}
            </button>
        @endforeach
    </div>

    <!-- Bookings -->
    @if ($bookings->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($bookings as $booking)
                <template x-if="tab === '{{ $booking->status }}'">
                    <div
                        x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition duration-200 ease-in"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                        class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden"
                    >
                        <!-- Property Image -->
                        <div class="relative h-48 w-full overflow-hidden">
                            @if ($booking->property->image)
                                <img 
                                    src="{{ asset('storage/' . $booking->property->image) }}" 
                                    alt="{{ $booking->property->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                                    <i class="fas fa-home fa-3x opacity-80"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>

                        <!-- Booking Details -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $booking->property->title }}</h3>
                                <span class="text-xs px-2 py-1 rounded-full font-medium 
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $booking->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status === 'refused' ? 'bg-red-100 text-red-800' : '' }}
                                ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>

                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i> 
                                <span class="truncate">{{ $booking->property->location }}</span>
                            </p>

                            <div class="flex items-center text-gray-700 mb-4">
                                <i class="fas fa-calendar-day text-blue-500 mr-2"></i>
                                <span class="font-medium">{{ \Carbon\Carbon::parse($booking->tour_date)->format('M j, Y \a\t g:i A') }}</span>
                            </div>

                            <div class="flex space-x-3 mt-6">
                                <a 
                                    href="{{ route('properties.show', $booking->property->id) }}" 
                                    class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition text-sm"
                                >
                                    View Property
                                </a>

                                @if($booking->status === 'pending')
                                <form 
                                    action="{{ route('student.bookings.destroy', $booking->id) }}" 
                                    method="POST" 
                                    class="flex-1"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg font-medium transition text-sm"
                                    >
                                        Cancel
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </template>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 rounded-2xl p-12 text-center border border-gray-200">
            <div class="mx-auto h-24 w-24 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-6">
                <i class="fas fa-calendar-times text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
            <p class="text-gray-600 mb-6">You haven't scheduled any property tours yet.</p>
            <a href="{{ route('properties.index') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition hover:shadow-md">
                <i class="fas fa-search mr-2"></i> Browse Properties
            </a>
        </div>
    @endif
</div>
@endsection
