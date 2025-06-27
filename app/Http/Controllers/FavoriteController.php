<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites;
        return view('student.favorites', compact('favorites'));
    }

    public function toggle($id)
    {
        $user = Auth::user();
        $property = Property::findOrFail($id);

        if ($user->favorites()->where('property_id', $id)->exists()) {
            $user->favorites()->detach($id);
        } else {
            $user->favorites()->attach($id);
        }

        return back()->with('success', 'Favorite updated!');
    }
}

