@extends('layouts.app')

@section('title', 'Dashboard - CleanPro')

@section('content')

<style>
    /* ── Dashboard Header ── */
    .dashboard-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 2.5rem 0 2rem;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .dashboard-title {
        font-size: clamp(1.6rem, 4vw, 2.25rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
    }

    .dashboard-sub {
        color: rgba(220,204,172,0.75);
        font-size: 0.95rem;
        margin-top: 0.25rem;
    }

    /* ── Stat Cards ── */
    .stat-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.2s;
    }

    .stat-card:hover {
        box-shadow: 0 8px 24px rgba(84,107,65,0.12);
        border-color: var(--sage);
        transform: translateY(-2px);
    }

    .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
        font-weight: 600;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--forest-dk);
        line-height: 1.2;
        margin-top: 0.25rem;
    }

    .stat-icon {
        font-size: 2rem;
        color: var(--sage);
        opacity: 0.4;
    }

    /* ── Common Card ── */
    .card-clean {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .card-clean:hover {
        box-shadow: 0 8px 24px rgba(84,107,65,0.08);
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--linen);
        background: var(--cream);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin: 0;
    }

    /* ── Booking Item ── */
    .booking-item {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--linen);
        transition: background 0.15s;
    }

    .booking-item:hover {
        background: var(--cream);
    }

    .booking-package {
        font-weight: 700;
        color: var(--forest-dk);
        font-size: 1rem;
    }

    .booking-date {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.15rem;
    }

    .booking-location {
        font-size: 0.85rem;
        color: #4b5563;
        margin: 0.5rem 0;
    }

    .booking-price {
        font-weight: 700;
        color: var(--forest);
        font-size: 0.9rem;
    }

    /* Status badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .badge-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .badge-confirmed {
        background: #e0f2fe;
        color: #0369a1;
    }

    .badge-completed {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* Sidebar */
    .profile-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 1.5rem;
    }

    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
        margin-bottom: 0.1rem;
    }

    .info-value {
        font-weight: 600;
        color: var(--forest-dk);
        font-size: 0.95rem;
    }

    .btn-edit {
        display: block;
        background: var(--forest);
        color: white;
        text-align: center;
        padding: 0.7rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-edit:hover {
        background: var(--forest-dk);
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.6rem 0;
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: color 0.18s;
        border-bottom: 1px solid var(--linen);
    }

    .quick-link:last-child {
        border-bottom: none;
    }

    .quick-link i {
        width: 20px;
        color: var(--sage);
    }

    .quick-link:hover {
        color: var(--forest);
    }

    .support-card {
        background: rgba(153,173,122,0.08);
        border: 1px solid var(--sage);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
    }

    .btn-wa {
        display: inline-block;
        background: #25D366;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-wa:hover {
        background: #128C7E;
    }

    .empty-state {
        padding: 3rem 1.5rem;
        text-align: center;
        color: #9ca3af;
    }
</style>

<!-- Header -->
<section class="dashboard-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="dashboard-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="dashboard-sub">Kelola booking dan profil Anda di sini</p>
    </div>
</section>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    @php
        $totalBookings = Auth::user()->bookings->count();
        $pendingBookings = Auth::user()->bookings->where('status', 'pending')->count();
        $completedBookings = Auth::user()->bookings->where('status', 'completed')->count();
    @endphp

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="stat-card flex justify-between items-center">
            <div>
                <div class="stat-label">Total Booking</div>
                <div class="stat-number">{{ $totalBookings }}</div>
            </div>
            <i class="fas fa-calendar-alt stat-icon"></i>
        </div>
        <div class="stat-card flex justify-between items-center">
            <div>
                <div class="stat-label">Menunggu Konfirmasi</div>
                <div class="stat-number">{{ $pendingBookings }}</div>
            </div>
            <i class="fas fa-hourglass-half stat-icon"></i>
        </div>
        <div class="stat-card flex justify-between items-center">
            <div>
                <div class="stat-label">Selesai</div>
                <div class="stat-number">{{ $completedBookings }}</div>
            </div>
            <i class="fas fa-check-circle stat-icon"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left: Recent Bookings -->
        <div class="lg:col-span-2">
            <div class="card-clean">
                <div class="card-header flex justify-between items-center">
                    <h2 class="card-title">Booking Terbaru Saya</h2>
                    <a href="{{ route('katalog') }}" class="text-sm font-semibold" style="color: var(--forest);">
                        Booking Baru <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                @if($totalBookings == 0)
                    <div class="empty-state">
                        <i class="fas fa-calendar-times text-4xl mb-3" style="color: var(--linen);"></i>
                        <p class="text-gray-500 mb-4">Anda belum memiliki booking apapun</p>
                        <a href="{{ route('katalog') }}" class="btn-primary" style="display: inline-block;">Lihat Paket Kami</a>
                    </div>
                @else
                    <div class="divide-y divide-linen max-h-[420px] overflow-y-auto">
                        @foreach(Auth::user()->bookings()->latest()->limit(5)->get() as $booking)
                        <div class="booking-item">
                            <div class="flex justify-between items-start mb-1">
                                <div>
                                    <div class="booking-package">{{ $booking->package->name }}</div>
                                    <div class="booking-date">{{ $booking->booking_date->format('d/m/Y') }} • {{ $booking->booking_time }}</div>
                                </div>
                                @php
                                    $badgeClass = match($booking->status) {
                                        'pending' => 'badge-pending',
                                        'confirmed' => 'badge-confirmed',
                                        'completed' => 'badge-completed',
                                        default => 'badge-cancelled'
                                    };
                                    $badgeText = match($booking->status) {
                                        'pending' => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'completed' => 'Selesai',
                                        default => 'Dibatalkan'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                            </div>
                            <div class="booking-location">
                                <i class="fas fa-location-dot mr-1" style="color: var(--sage);"></i>
                                {{ Str::limit($booking->location, 60) }}
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <div class="booking-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                <a href="{{ route('booking.show', $booking->id) }}" class="text-sm font-semibold" style="color: var(--forest);">
                                    Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="px-6 py-4 bg-cream border-t border-linen text-center">
                        <a href="{{ route('bookings.list') }}" class="font-semibold" style="color: var(--forest);">
                            Lihat Semua Booking <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">

            <!-- Profile Card -->
            <div class="profile-card">
                <h3 class="font-extrabold text-forest-dk mb-4 flex items-center gap-2">
                    <i class="fas fa-user-circle" style="color: var(--sage);"></i> Profil Saya
                </h3>
                <div class="space-y-3">
                    <div>
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ Auth::user()->name }}</div>
                    </div>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn-edit mt-3">
                        <i class="fas fa-pen mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="profile-card">
                <h3 class="font-extrabold text-forest-dk mb-3 flex items-center gap-2">
                    <i class="fas fa-bolt" style="color: var(--sage);"></i> Menu Cepat
                </h3>
                <div class="space-y-1">
                    <a href="{{ route('katalog') }}" class="quick-link">
                        <i class="fas fa-box"></i> Lihat Paket
                    </a>
                    <a href="{{ route('bookings.list') }}" class="quick-link">
                        <i class="fas fa-calendar"></i> Semua Booking
                    </a>
                    <a href="{{ route('faq') }}" class="quick-link">
                        <i class="fas fa-question-circle"></i> FAQ
                    </a>
                    <a href="{{ route('about') }}" class="quick-link">
                        <i class="fas fa-leaf"></i> Tentang Kami
                    </a>
                </div>
            </div>

            <!-- Support Card -->
            <div class="support-card">
                <i class="fas fa-headset text-2xl mb-2" style="color: var(--forest);"></i>
                <h3 class="font-bold text-forest-dk">Butuh Bantuan?</h3>
                <p class="text-sm text-gray-600 mb-3">Tim support kami siap membantu 24/7</p>
                <a href="https://wa.me/6282112345678" class="btn-wa" target="_blank">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection