@extends('layouts.admin')

@section('title', 'Admin Dashboard - CleanPro')

@section('content')
<div>
    <h1 class="text-2xl font-extrabold text-forest-dk mb-8">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Booking -->
        <div class="stat-card">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Booking</p>
                    <p class="text-3xl font-bold text-forest-dk mt-1">{{ $totalBookings }}</p>
                </div>
                <i class="fas fa-calendar-alt text-3xl" style="color: var(--sage); opacity:0.3;"></i>
            </div>
        </div>

        <!-- Pending Booking -->
        <div class="stat-card">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Pending</p>
                    <p class="text-3xl font-bold text-amber-600 mt-1">{{ $pendingBookings }}</p>
                </div>
                <i class="fas fa-hourglass-half text-3xl" style="color: #d97706; opacity:0.3;"></i>
            </div>
        </div>

        <!-- Total Paket -->
        <div class="stat-card">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Paket</p>
                    <p class="text-3xl font-bold text-forest-dk mt-1">{{ $totalPackages }}</p>
                </div>
                <i class="fas fa-box-open text-3xl" style="color: var(--forest); opacity:0.3;"></i>
            </div>
        </div>

        <!-- Revenue -->
        <div class="stat-card">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Pendapatan (terbaru)</p>
                    <p class="text-3xl font-bold text-forest mt-1">
                        Rp {{ number_format($recentBookings->sum('total_price'), 0, ',', '.') }}
                    </p>
                </div>
                <i class="fas fa-money-bill-wave text-3xl" style="color: var(--sage); opacity:0.3;"></i>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="data-table mb-8">
        <div class="px-6 py-4 border-b border-linen flex justify-between items-center bg-cream">
            <h2 class="font-extrabold text-forest-dk">Booking Terbaru</h2>
            <a href="{{ route('admin.bookings') }}" class="text-sm font-semibold" style="color: var(--forest);">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $booking->user->email }}</p>
                            </div>
                        </td>
                        <td>{{ $booking->package->name }}</td>
                        <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                        <td class="font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = $booking->status;
                                $badgeClass = match($status) {
                                    'pending' => 'badge-pending',
                                    'confirmed' => 'badge-confirmed',
                                    'completed' => 'badge-completed',
                                    default => 'badge-cancelled'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                @if($status === 'pending') <i class="fas fa-clock"></i>
                                @elseif($status === 'confirmed') <i class="fas fa-check"></i>
                                @elseif($status === 'completed') <i class="fas fa-check-double"></i>
                                @else <i class="fas fa-times"></i>
                                @endif
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.booking.show', $booking->id) }}" class="font-semibold" style="color: var(--forest);">
                                Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-8">Belum ada booking</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.package.create') }}" class="quick-action-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sage/10 flex items-center justify-center" style="color: var(--forest);">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-forest-dk">Tambah Paket</h3>
                    <p class="text-sm text-gray-500">Buat paket layanan baru</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.faq.create') }}" class="quick-action-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sage/10 flex items-center justify-center" style="color: var(--forest);">
                    <i class="fas fa-question text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-forest-dk">Tambah FAQ</h3>
                    <p class="text-sm text-gray-500">Tambahkan pertanyaan umum</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.bookings') }}" class="quick-action-card">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sage/10 flex items-center justify-center" style="color: var(--forest);">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-forest-dk">Kelola Booking</h3>
                    <p class="text-sm text-gray-500">Lihat & update status</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection