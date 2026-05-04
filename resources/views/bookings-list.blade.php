@extends('layouts.app')

@section('title', 'Booking Saya - CleanPro')

@section('content')

<style>
    /* ── Header ── */
    .page-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 2.5rem 0 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .page-title {
        font-size: clamp(1.6rem, 4vw, 2rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
    }

    .page-sub {
        color: rgba(220,204,172,0.75);
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    /* ── Tombol Utama ── */
    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--sage);
        color: var(--forest-dk);
        font-weight: 700;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-primary-custom:hover {
        background: var(--sage-lt);
        transform: translateY(-1px);
    }

    /* ── Booking Card ── */
    .booking-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 1.5rem;
        transition: box-shadow 0.2s, border-color 0.2s;
    }

    .booking-card:hover {
        box-shadow: 0 8px 28px rgba(84,107,65,0.12);
        border-color: var(--sage);
    }

    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
        margin-bottom: 0.2rem;
    }

    .info-value {
        font-weight: 700;
        color: var(--forest-dk);
        font-size: 0.95rem;
    }

    .price-value {
        font-weight: 800;
        color: var(--forest);
        font-size: 1rem;
    }

    /* Badge Status */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.3rem 0.8rem;
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

    /* Tombol Aksi */
    .btn-detail {
        background: rgba(153,173,122,0.15);
        color: var(--forest);
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-detail:hover {
        background: rgba(153,173,122,0.3);
    }

    .btn-cancel {
        background: rgba(239,68,68,0.1);
        color: #b91c1c;
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-cancel:hover {
        background: rgba(239,68,68,0.2);
    }

    /* Stat Cards */
    .stat-card-simple {
        background: var(--cream);
        border: 1px solid var(--linen);
        border-radius: 18px;
        padding: 1rem 1.25rem;
        transition: all 0.2s;
    }

    .stat-card-simple:hover {
        border-color: var(--sage);
        transform: translateY(-1px);
    }

    .stat-number-sm {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--forest-dk);
        line-height: 1;
    }

    /* Empty State */
    .empty-state {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--sage);
        opacity: 0.4;
        margin-bottom: 1rem;
    }
</style>

<!-- Header -->
<section class="page-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="page-title">Riwayat Booking Saya</h1>
                <p class="page-sub">Kelola semua pemesanan layanan Anda</p>
            </div>
            <a href="{{ route('katalog') }}" class="btn-primary-custom">
                <i class="fas fa-plus"></i> Pesan Baru
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    @if($bookings->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada booking</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat booking apapun. Mulai pesan layanan kami sekarang!</p>
            <a href="{{ route('katalog') }}" class="btn-primary-custom">Lihat Paket Kami</a>
        </div>
    @else
        <!-- Daftar Booking -->
        <div class="space-y-4">
            @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-start">
                    <!-- Paket & Harga -->
                    <div>
                        <div class="info-label">Paket Layanan</div>
                        <div class="info-value">{{ $booking->package->name }}</div>
                        <div class="price-value mt-1">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div>
                        <div class="info-label">Tanggal & Waktu</div>
                        <div class="info-value">{{ $booking->booking_date->format('d/m/Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->booking_time }}</div>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <div class="info-label">Lokasi</div>
                        <div class="info-value">{{ Str::limit($booking->location, 35) }}</div>
                    </div>

                    <!-- Status -->
                    <div>
                        <div class="info-label">Status</div>
                        <div class="mt-1">
                            @php
                                $badgeClass = match($booking->status) {
                                    'pending' => 'badge-pending',
                                    'confirmed' => 'badge-confirmed',
                                    'completed' => 'badge-completed',
                                    default => 'badge-cancelled'
                                };
                                $badgeIcon = match($booking->status) {
                                    'pending' => 'fa-clock',
                                    'confirmed' => 'fa-check',
                                    'completed' => 'fa-check-double',
                                    default => 'fa-times'
                                };
                                $badgeText = match($booking->status) {
                                    'pending' => 'Pending',
                                    'confirmed' => 'Confirmed',
                                    'completed' => 'Selesai',
                                    default => 'Dibatalkan'
                                };
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                <i class="fas {{ $badgeIcon }}"></i> {{ $badgeText }}
                            </span>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="flex gap-2 justify-start md:justify-end">
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn-detail">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                        @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                            @csrf
                            <button type="submit" class="btn-cancel">
                                <i class="fas fa-ban mr-1"></i> Batalkan
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Ringkasan Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
            <div class="stat-card-simple">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Menunggu</p>
                        <p class="stat-number-sm">{{ $bookings->where('status', 'pending')->count() }}</p>
                    </div>
                    <i class="fas fa-hourglass-half text-2xl" style="color: var(--sage); opacity:0.5;"></i>
                </div>
            </div>
            <div class="stat-card-simple">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Dikonfirmasi</p>
                        <p class="stat-number-sm">{{ $bookings->where('status', 'confirmed')->count() }}</p>
                    </div>
                    <i class="fas fa-check-circle text-2xl" style="color: var(--sage); opacity:0.5;"></i>
                </div>
            </div>
            <div class="stat-card-simple">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Selesai</p>
                        <p class="stat-number-sm">{{ $bookings->where('status', 'completed')->count() }}</p>
                    </div>
                    <i class="fas fa-check-double text-2xl" style="color: var(--sage); opacity:0.5;"></i>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection