@extends('layouts.app') {{-- Use your layout if you have one --}}

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">My Properties</h1>

    {{-- Search Filter --}}
    <form method="GET" class="mb-6">
        <input type="text" name="search" placeholder="Search by title..."
            class="px-4 py-2 border border-gray-300 rounded-lg w-full md:w-1/3"
            value="{{ request('search') }}">
    </form>

    {{-- Property List --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($properties as $property)
        <div class="bg-white shadow rounded-2xl p-4">
            <h2 class="text-xl font-semibold mb-2">{{ $property->title }}</h2>
            <p class="text-gray-600 mb-2">{{ Str::limit($property->description, 100) }}</p>
            <p><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
            <p><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>

            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="w-full h-40 object-cover rounded mt-3">
            @endif

            <div class="mt-4 flex justify-between">
                <a href="{{ route('owner.properties.edit', $property->id) }}"
                    class="text-blue-600 hover:underline">Edit</a>

                <form action="{{ route('owner.properties.destroy', $property->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this property?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-500">No properties found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $properties->links() }}
    </div>
</div>
@endsection
