<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class StudentController extends Controller
{
    public function dashboard()
{
    $studentId = auth()->id();

    $upcomingTours = Booking::where('student_id', $studentId) // <== changed here
                            ->whereIn('status', ['pending', 'accepted'])
                            ->count();

    $activeApplications = Booking::where('student_id', $studentId) // <== changed here too
                                ->where('status', 'accepted')
                                ->count();


    return view('student.dashboard', [
        'upcomingTours' => $upcomingTours,
        'activeApplications' => $activeApplications,
    ]);
}
}
