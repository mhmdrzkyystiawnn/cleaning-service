<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/katalog', [HomeController::class, 'katalog'])->name('katalog');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/package/{id}', [PackageController::class, 'show'])->name('package.show');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking
    Route::get('/booking/create/{packageId}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/bookings', [BookingController::class, 'list'])->name('bookings.list');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    // User Dashboard
    Route::get('/dashboard', function () {
        return view('user-dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Packages Management
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [AdminController::class, 'packageCreate'])->name('package.create');
    Route::post('/packages', [AdminController::class, 'packageStore'])->name('package.store');
    Route::get('/packages/{id}/edit', [AdminController::class, 'packageEdit'])->name('package.edit');
    Route::put('/packages/{id}', [AdminController::class, 'packageUpdate'])->name('package.update');
    Route::delete('/packages/{id}', [AdminController::class, 'packageDestroy'])->name('package.destroy');

    // Bookings Management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{id}', [AdminController::class, 'bookingShow'])->name('booking.show');
    Route::put('/bookings/{id}/status', [AdminController::class, 'bookingUpdateStatus'])->name('booking.update-status');

    // FAQ Management
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
    Route::get('/faqs/create', [AdminController::class, 'faqCreate'])->name('faq.create');
    Route::post('/faqs', [AdminController::class, 'faqStore'])->name('faq.store');
    Route::get('/faqs/{id}/edit', [AdminController::class, 'faqEdit'])->name('faq.edit');
    Route::put('/faqs/{id}', [AdminController::class, 'faqUpdate'])->name('faq.update');
    Route::delete('/faqs/{id}', [AdminController::class, 'faqDestroy'])->name('faq.destroy');
});

require __DIR__.'/auth.php';
