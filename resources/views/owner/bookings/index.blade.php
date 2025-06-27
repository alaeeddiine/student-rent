@extends('layouts.app')

@section('title', 'Manage Bookings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Booking Requests</h1>
            <p class="text-gray-600">Manage student tour requests for your properties</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-medium">
                {{ $pending->count() }} Pending Requests
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Booking Status Columns -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pending Bookings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="bg-yellow-50 px-6 py-4 border-b border-yellow-100 rounded-t-2xl">
                <h3 class="text-lg font-semibold text-yellow-800 flex items-center">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                    Pending
                </h3>
            </div>
            <div class="p-4">
                @forelse($pending as $booking)
                    <div class="bg-gray-50 rounded-xl p-4 mb-4 last:mb-0 border border-gray-100">
                        <div class="flex items-start mb-3">
                            <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $booking->student->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $booking->property->title }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar-day mr-2 text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($booking->tour_date)->format('M j, Y g:i A') }}
                        </div>
                        <div class="flex space-x-2">
                            <form action="{{ route('owner.bookings.accept', $booking->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-medium transition-colors text-sm">
                                    Accept
                                </button>
                            </form>
                            <form action="{{ route('owner.bookings.refuse', $booking->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-600 py-2 rounded-lg font-medium transition-colors text-sm">
                                    Decline
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="text-gray-500">No pending booking requests</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Accepted Bookings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="bg-green-50 px-6 py-4 border-b border-green-100 rounded-t-2xl">
                <h3 class="text-lg font-semibold text-green-800 flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    Accepted
                </h3>
            </div>
            <div class="p-4">
                @forelse($accepted as $booking)
                    <div class="bg-gray-50 rounded-xl p-4 mb-4 last:mb-0 border border-gray-100">
                        <div class="flex items-start mb-3">
                            <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $booking->student->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $booking->property->title }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="fas fa-calendar-day mr-2 text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($booking->tour_date)->format('M j, Y g:i A') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-2 text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <p class="text-gray-500">No accepted bookings</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Refused Bookings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="bg-red-50 px-6 py-4 border-b border-red-100 rounded-t-2xl">
                <h3 class="text-lg font-semibold text-red-800 flex items-center">
                    <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                    Declined
                </h3>
            </div>
            <div class="p-4">
                @forelse($refused as $booking)
                    <div class="bg-gray-50 rounded-xl p-4 mb-4 last:mb-0 border border-gray-100">
                        <div class="flex items-start mb-3">
                            <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $booking->student->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $booking->property->title }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="fas fa-calendar-day mr-2 text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($booking->tour_date)->format('M j, Y g:i A') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-2 text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <p class="text-gray-500">No declined bookings</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Total Bookings</h3>
                <div class="bg-blue-100 text-blue-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pending->count() + $accepted->count() + $refused->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Pending</h3>
                <div class="bg-yellow-100 text-yellow-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pending->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Accepted</h3>
                <div class="bg-green-100 text-green-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $accepted->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Declined</h3>
                <div class="bg-red-100 text-red-800 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $refused->count() }}</p>
        </div>
    </div>
</div>
@endsection