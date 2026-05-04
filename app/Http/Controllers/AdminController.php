<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\FAQ;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalBookings = Booking::count();
        $totalPackages = Package::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $recentBookings = Booking::with('user', 'package')->latest()->limit(10)->get();

        return view('admin.dashboard', compact('totalBookings', 'totalPackages', 'pendingBookings', 'recentBookings'));
    }

    // Packages CRUD
    public function packages()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function packageCreate()
    {
        return view('admin.packages.create');
    }

    public function packageStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string',
            'max_area' => 'nullable|integer',
            'features' => 'nullable|string',
        ]);

        if ($request->has('features')) {
            $validated['features'] = explode(',', $request->features);
        }

        Package::create($validated);
        return redirect()->route('admin.packages')->with('success', 'Package berhasil dibuat!');
    }

    public function packageEdit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function packageUpdate(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string',
            'max_area' => 'nullable|integer',
            'features' => 'nullable|string',
        ]);

        if ($request->has('features')) {
            $validated['features'] = explode(',', $request->features);
        }

        $package->update($validated);
        return redirect()->route('admin.packages')->with('success', 'Package berhasil diperbarui!');
    }

    public function packageDestroy($id)
    {
        Package::destroy($id);
        return redirect()->route('admin.packages')->with('success', 'Package berhasil dihapus!');
    }

    // Bookings Management
    public function bookings()
    {
        $bookings = Booking::with('user', 'package')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function bookingShow($id)
    {
        $booking = Booking::with('user', 'package')->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function bookingUpdateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);
        $booking->update($validated);
        return back()->with('success', 'Status booking berhasil diperbarui!');
    }

    // FAQ Management
    public function faqs()
    {
        $faqs = FAQ::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function faqCreate()
    {
        return view('admin.faqs.create');
    }

    public function faqStore(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);
        FAQ::create($validated);
        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil dibuat!');
    }

    public function faqEdit($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function faqUpdate(Request $request, $id)
    {
        $faq = FAQ::findOrFail($id);
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);
        $faq->update($validated);
        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function faqDestroy($id)
    {
        FAQ::destroy($id);
        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil dihapus!');
    }
}
