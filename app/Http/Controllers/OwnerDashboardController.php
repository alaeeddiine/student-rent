<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    
public function index()
{
    $ownerId = auth()->id();

    // Count total properties
    $totalProperties = Property::where('user_id', $ownerId)->count();

    // Count active (accepted) bookings for the owner's properties
    $propertyIds = Property::where('user_id', $ownerId)->pluck('id');
    $activeBookings = Booking::whereIn('property_id', $propertyIds)
                             ->where('status', 'accepted')
                             ->count();

    // Occupancy rate example
    $occupied = Property::where('user_id', $ownerId)->where('is_occupied', true)->count();
    $total = max($totalProperties, 1); // avoid divide by zero
    $occupancyRate = round(($occupied / $total) * 100);
    

    return view('owner.dashboard', [
        'totalProperties' => $totalProperties,
        'activeBookings' => $activeBookings,
        'occupancyRate' => $occupancyRate,
    ]);
}
    
}
