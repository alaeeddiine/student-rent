<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('student-dashboard', compact('announcements'));
    }
    public function favorites()
{
    $user = Auth::user();

    // assuming there's a favorites relationship or a pivot table
    $favorites = $user->favorites ?? []; // customize based on your logic

    return view('student.favorites', compact('favorites'));
}
}