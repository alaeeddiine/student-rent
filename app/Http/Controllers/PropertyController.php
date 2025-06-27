<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    
    
    public function showAll()
    {
    $properties = Property::all();
    return view('properties.index', compact('properties'));
    }

    public function index()
    {
    $properties = Property::all();
    return view('properties.index', compact('properties'));
    }


    public function create()
    {
        return view('owner.properties.create');
    }

    public function store(Request $request)
    {
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'bedrooms' => 'required|integer',
        'bathrooms' => 'required|integer',
        'price' => 'required|numeric',
        'capacity' => 'required|integer|min:1',
        'location' => 'required|string',
        'extras' => 'nullable|string', 
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // Create a new property object
    $property = new Property();
    $property->title = $request->title;
    $property->description = $request->description;
    $property->bedrooms = $request->bedrooms;
    $property->bathrooms = $request->bathrooms;
    $property->price = $request->price;
    $property->location = $request->location;
    $property->capacity = $request->capacity;
    $property->extras = $request->extras;
    $property->user_id = auth()->id(); // Link to logged-in user

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('properties', 'public');
        $property->image = $imagePath;
    }

    // Save the property to the database
    $property->save();

    // Redirect to the properties index page with a success message
    return redirect()->route('owner.properties.index')->with('success', 'Property created successfully!');
}


    public function myProperties()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        return view('owner.properties.index', compact('properties'));
    }

    public function show($id)
    {
    $property = Property::findOrFail($id);
    return view('properties.show', compact('property'));
    }

    public function edit($id)
    {
    $property = Property::findOrFail($id);

    if (auth()->id() !== $property->user_id) {
        abort(403, 'Unauthorized');
    }

    return view('owner.properties.edit', compact('property'));
    }
    public function update(Request $request, $id)
{
    $property = Property::findOrFail($id);

    // Validate inputs
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'bedrooms' => 'required|integer|min:0',
        'bathrooms' => 'required|integer|min:0',
        'extras' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'capacity' => 'required|integer|min:1',
        'location' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
    ]);

    // Update fields
    $property->title = $request->title;
    $property->description = $request->description;
    $property->bedrooms = $request->bedrooms;
    $property->bathrooms = $request->bathrooms;
    $property->price = $request->price;
    $property->capacity = $request->capacity;
    $property->location = $request->location; // Assuming location is also being updated
    $property->extras = $request->extras;

    // If new image uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('properties', 'public');
        $property->image = $imagePath;
    }

    // Save changes
    $property->save();

    return redirect()->route('owner.properties.index')->with('success', 'Property updated successfully!');
}
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Check if the authenticated user is the owner of the property
        if (auth()->id() !== $property->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the property image from storage if it exists
        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }

        // Delete the property from the database
        $property->delete();

        return redirect()->route('owner.properties.index')->with('success', 'Property deleted successfully!');
    }
}