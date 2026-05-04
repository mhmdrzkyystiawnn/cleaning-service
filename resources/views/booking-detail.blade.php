@extends('layouts.app')

@section('title', 'Detail Booking - CleanPro')

@section('content')

<style>
    /* ── Header ── */
    .detail-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 2rem 0 1.8rem;
        position: relative;
        overflow: hidden;
    }

    .detail-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(220,204,172,0.8);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.18s;
        margin-bottom: 0.75rem;
    }

    .back-link:hover {
        color: var(--cream);
    }

    .page-title {
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.01em;
    }

    /* ── Card Umum ── */
    .card-clean {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 1.5rem;
        transition: box-shadow 0.2s;
    }

    .card-clean:hover {
        box-shadow: 0 8px 24px rgba(84,107,65,0.08);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--linen);
    }

    /* Status Badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
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

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
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
        font-size: 1rem;
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 0.4rem 0;
        border-bottom: 1px dashed var(--linen);
        font-size: 0.85rem;
        color: #374151;
    }
    .feature-list li:last-child {
        border-bottom: none;
    }
    .feature-list i {
        color: var(--sage);
        margin-top: 2px;
    }

    /* Sidebar */
    .price-summary {
        background: rgba(153,173,122,0.08);
        border: 1px solid var(--sage);
        border-radius: 20px;
        padding: 1.5rem;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        padding: 0.4rem 0;
        border-bottom: 1px solid var(--linen);
    }

    .price-row.total {
        border-bottom: none;
        padding-top: 0.8rem;
        font-weight: 800;
        font-size: 1rem;
        color: var(--forest);
    }

    .btn-cancel {
        background: rgba(239,68,68,0.1);
        color: #b91c1c;
        width: 100%;
        padding: 0.7rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: rgba(239,68,68,0.2);
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
        text-align: center;
        transition: background 0.2s;
    }

    .btn-wa:hover {
        background: #128C7E;
    }

    .contact-info p {
        margin-bottom: 0.75rem;
    }
</style>

<!-- Header Mini -->
<section class="detail-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('bookings.list') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Booking Saya
        </a>
        <h1 class="page-title">Detail Booking</h1>
    </div>
</section>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Kolom Kiri (2/3) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Status & ID -->
            <div class="card-clean flex flex-wrap justify-between items-center gap-3">
                <div>
                    <span class="text-sm text-gray-500">Booking #{{ $booking->id }}</span>
                    <p class="text-xs text-gray-400 mt-1">Dipesan {{ $booking->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
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

            <!-- Informasi Booking -->
            <div class="card-clean">
                <h2 class="card-title">Informasi Booking</h2>
                <div class="info-grid">
                    <div>
                        <div class="info-label">Tanggal Layanan</div>
                        <div class="info-value">{{ $booking->booking_date->format('d/m/Y') }}</div>
                    </div>
                    <div>
                        <div class="info-label">Jam Layanan</div>
                        <div class="info-value">{{ $booking->booking_time }}</div>
                    </div>
                    <div>
                        <div class="info-label">Paket</div>
                        <div class="info-value">{{ $booking->package->name }}</div>
                    </div>
                    <div>
                        <div class="info-label">Durasi</div>
                        <div class="info-value">{{ $booking->package->duration }}</div>
                    </div>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="card-clean">
                <h2 class="card-title">Lokasi Layanan</h2>
                <p class="text-gray-700">{{ $booking->location }}</p>
            </div>

            <!-- Detail Paket -->
            <div class="card-clean">
                <h2 class="card-title">Detail Paket</h2>
                <p class="text-gray-700 mb-3">{{ $booking->package->description }}</p>
                @if($booking->package->features && count($booking->package->features) > 0)
                    <h4 class="font-semibold text-forest-dk mt-2 mb-2">Fitur Termasuk:</h4>
                    <ul class="feature-list">
                        @foreach($booking->package->features as $feature)
                        <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Catatan -->
            @if($booking->notes)
            <div class="card-clean">
                <h2 class="card-title">Catatan Anda</h2>
                <p class="text-gray-700">{{ $booking->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Kolom Kanan (Sidebar) -->
        <div class="space-y-6">

            <!-- Ringkasan Harga -->
            <div class="price-summary">
                <h3 class="font-bold text-forest-dk mb-3">Ringkasan Pembayaran</h3>
                <div class="price-row">
                    <span>Harga Paket</span>
                    <span class="font-semibold">Rp {{ number_format($booking->package->price, 0, ',', '.') }}</span>
                </div>
                <div class="price-row">
                    <span>Biaya Tambahan</span>
                    <span class="font-semibold">Rp 0</span>
                </div>
                <div class="price-row total">
                    <span class="text-forest-dk">Total</span>
                    <span class="text-forest-dk text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Kontak Customer -->
            <div class="card-clean">
                <h3 class="font-bold text-forest-dk mb-3">Informasi Kontak</h3>
                <div class="contact-info">
                    <div>
                        <div class="info-label">Nama</div>
                        <div class="info-value">{{ $booking->user->name }}</div>
                    </div>
                    <div class="mt-2">
                        <div class="info-label">Nomor Telepon</div>
                        <div class="info-value">{{ $booking->phone_number }}</div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi (jika belum selesai/dibatalkan) -->
            @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                @csrf
                <button type="submit" class="btn-cancel">
                    <i class="fas fa-ban"></i> Batalkan Booking
                </button>
            </form>
            @endif

            <!-- Bantuan -->
            <div class="card-clean" style="background: rgba(153,173,122,0.05); text-align: center;">
                <i class="fas fa-headset text-2xl mb-2" style="color: var(--forest);"></i>
                <h3 class="font-bold text-forest-dk">Butuh Bantuan?</h3>
                <p class="text-sm text-gray-600 mb-3">Tim support kami siap membantu</p>
                <a href="https://wa.me/6282112345678" class="btn-wa" target="_blank">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection