@extends('layouts.admin')

@section('title', 'Detail Booking - Admin CleanPro')

@section('content')
<div>
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('admin.bookings') }}" class="inline-flex items-center gap-2 text-forest hover:text-forest-dk font-semibold text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Booking
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri (2/3) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Booking -->
            <div class="card-clean">
                <h2 class="card-title">Informasi Booking</h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="info-label">Booking ID</p>
                        <p class="info-value text-base">#{{ $booking->id }}</p>
                    </div>
                    <div>
                        <p class="info-label">Tanggal Pemesanan</p>
                        <p class="info-value">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="info-label">Tanggal Layanan</p>
                        <p class="info-value">{{ $booking->booking_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="info-label">Jam Layanan</p>
                        <p class="info-value">{{ $booking->booking_time }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="card-clean">
                <h2 class="card-title">Informasi Pelanggan</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="info-label">Nama</p>
                        <p class="info-value">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <p class="info-label">Email</p>
                        <p class="info-value">{{ $booking->user->email }}</p>
                    </div>
                    <div>
                        <p class="info-label">Nomor Telepon</p>
                        <p class="info-value">{{ $booking->phone_number }}</p>
                    </div>
                    <div>
                        <p class="info-label">Alamat Layanan</p>
                        <p class="info-value">{{ $booking->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Paket -->
            <div class="card-clean">
                <h2 class="card-title">Detail Paket</h2>
                <div class="space-y-3">
                    <div>
                        <p class="info-label">Nama Paket</p>
                        <p class="info-value text-lg">{{ $booking->package->name }}</p>
                    </div>
                    <div>
                        <p class="info-label">Deskripsi</p>
                        <p class="text-gray-700">{{ $booking->package->description }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="info-label">Durasi</p>
                            <p class="info-value">{{ $booking->package->duration }}</p>
                        </div>
                        <div>
                            <p class="info-label">Luas Maksimal</p>
                            <p class="info-value">{{ $booking->package->max_area ? $booking->package->max_area . ' m²' : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Pelanggan (jika ada) -->
            @if($booking->notes)
            <div class="card-clean">
                <h2 class="card-title">Catatan Pelanggan</h2>
                <p class="text-gray-700">{{ $booking->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Kolom Kanan (Sidebar) -->
        <div class="space-y-6">
            <!-- Status Update -->
            <div class="card-clean">
                <h3 class="font-bold text-forest-dk mb-3">Status Booking</h3>
                <div class="mb-4">
                    @php
                        $status = $booking->status;
                        $badgeClass = match($status) {
                            'pending' => 'badge-pending',
                            'confirmed' => 'badge-confirmed',
                            'completed' => 'badge-completed',
                            default => 'badge-cancelled'
                        };
                        $icon = match($status) {
                            'pending' => 'fa-clock',
                            'confirmed' => 'fa-check',
                            'completed' => 'fa-check-double',
                            default => 'fa-times'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                        <i class="fas {{ $icon }}"></i> {{ ucfirst($status) }}
                    </span>
                </div>

                <form action="{{ route('admin.booking.update-status', $booking->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select">
                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn-update">
                        <i class="fas fa-sync-alt mr-1"></i> Update Status
                    </button>
                </form>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="price-summary">
                <h3 class="font-bold text-forest-dk mb-3">Informasi Pembayaran</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Harga Paket:</span>
                        <span class="font-semibold">Rp {{ number_format($booking->package->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Biaya Tambahan:</span>
                        <span class="font-semibold">Rp 0</span>
                    </div>
                    <div class="border-t border-linen pt-2 flex justify-between">
                        <span class="font-bold text-forest-dk">Total:</span>
                        <span class="font-bold text-forest text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tambahan style untuk halaman ini (sudah ada di layout admin, tapi dipastikan) */
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
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 0.3rem 0.8rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
}
.badge-pending { background: #fef3c7; color: #b45309; }
.badge-confirmed { background: #e0f2fe; color: #0369a1; }
.badge-completed { background: #dcfce7; color: #15803d; }
.badge-cancelled { background: #fee2e2; color: #b91c1c; }
.form-select {
    width: 100%;
    padding: 0.6rem 0.75rem;
    border: 1.5px solid var(--linen);
    border-radius: 12px;
    background: white;
    font-size: 0.85rem;
    color: #374151;
}
.form-select:focus {
    outline: none;
    border-color: var(--sage);
    box-shadow: 0 0 0 2px rgba(153,173,122,0.2);
}
.btn-update {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    width: 100%;
    background: var(--forest);
    color: white;
    font-weight: 700;
    padding: 0.6rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-update:hover {
    background: var(--forest-dk);
}
.price-summary {
    background: rgba(153,173,122,0.08);
    border: 1px solid var(--sage);
    border-radius: 20px;
    padding: 1.5rem;
}
</style>
@endsection