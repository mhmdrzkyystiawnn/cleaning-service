<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('booking-create', compact('package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $package = Package::findOrFail($validated['package_id']);
        $validated['user_id'] = Auth::id();
        $validated['total_price'] = $package->price;

        Booking::create($validated);

        return redirect()->route('bookings.list')->with('success', 'Booking berhasil dibuat!');
    }

    public function list()
    {
        $bookings = Auth::user()->bookings()->with('package')->orderBy('created_at', 'desc')->get();
        return view('bookings-list', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }
        return view('booking-detail', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        if ($booking->status === 'completed') {
            return back()->with('error', 'Tidak dapat membatalkan booking yang sudah selesai.');
        }
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
