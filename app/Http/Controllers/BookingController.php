<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Property;

class BookingController extends Controller
{
    public function store(Request $request)
        {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'tour_date' => 'required|date|after:today',
        ]);

        Booking::create([
            'property_id' => $request->property_id,
            'student_id' => auth()->id(),
            'name' => $request->name,
            'contact' => $request->contact,
            'tour_date' => $request->tour_date,
        ]);

            return redirect()->route('student.bookings')->with('success', 'Tour booking submitted successfully. Waiting for owner approval.');
        }

    public function studentIndex()
        {
            $bookings = Booking::where('student_id', auth()->id())->with('property')->latest()->get();
            return view('student.bookings.index', compact('bookings'));
        }

        public function destroy($id)
        {
            $booking = Booking::where('id', $id)->where('student_id', auth()->id())->firstOrFail();
            $booking->delete();

            return redirect()->route('student.bookings')->with('success', 'Booking deleted successfully.');
        }

    public function ownerIndex()
        {
            $bookings = Booking::whereHas('property', function ($query) {
                $query->where('user_id', auth()->id());
            })->with('property', 'student')->latest()->get();
        
            $pending = $bookings->where('status', 'pending');
            $accepted = $bookings->where('status', 'accepted');
            $refused = $bookings->where('status', 'refused');
        
            return view('owner.bookings.index', compact('pending', 'accepted', 'refused'));
        }
        
        
        public function accept($id)
        {
            $booking = Booking::findOrFail($id);
            $booking->status = 'accepted';
            $booking->save();
        
            // Mark property as occupied
            $property = Property::find($booking->property_id);
            $property->is_occupied = true;
            $property->save();
        
            return back()->with('success', 'Booking accepted.');
        }
        
        // When refusing a booking
        public function refuse($id)
        {
            $booking = Booking::findOrFail($id);
            $booking->status = 'refused';
            $booking->save();
        
            // Check if property still has other accepted bookings
            $acceptedCount = Booking::where('property_id', $booking->property_id)
                                    ->where('status', 'accepted')->count();
        
            $property = Property::find($booking->property_id);
            $property->is_occupied = $acceptedCount > 0;
            $property->save();
        
            return back()->with('error', 'Booking refused.');

        }
        


}
