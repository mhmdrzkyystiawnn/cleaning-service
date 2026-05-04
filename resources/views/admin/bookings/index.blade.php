@extends('layouts.admin')

@section('title', 'Kelola Booking - CleanPro Admin')

@section('content')
<div>
    <h1 class="text-2xl font-extrabold text-forest-dk mb-6">Kelola Booking</h1>

    <!-- Filter -->
    <div class="data-table mb-6">
        <div class="px-6 py-4 border-b border-linen bg-cream">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Filter Status</label>
                    <select name="status" class="form-input py-2 px-3 text-sm w-40">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary-custom text-sm py-2 px-4">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                @if(request('status'))
                    <a href="{{ route('admin.bookings') }}" class="text-sm text-forest hover:underline">Reset Filter</a>
                @endif
            </form>
        </div>
    </div>

    @if($bookings->isEmpty())
        <div class="empty-state-admin">
            <i class="fas fa-calendar-alt text-5xl text-sage/40 mb-4"></i>
            <p class="text-gray-500">Belum ada booking.</p>
        </div>
    @else
        <div class="data-table overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Paket</th>
                        <th>Tanggal & Waktu</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $booking->user->email }}</p>
                            </div>
                        </td>
                        <td>{{ $booking->package->name }}</td>
                        <td>{{ $booking->booking_date->format('d/m/Y') }} • {{ $booking->booking_time }}</td>
                        <td class="font-semibold text-forest">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
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
                        </td>
                        <td>
                            <a href="{{ route('admin.booking.show', $booking->id) }}" class="font-semibold text-forest hover:text-forest-dk text-sm">
                                Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination (optional, jika ada) -->
        @if(method_exists($bookings, 'links'))
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @endif
    @endif
</div>

<style>
/* Additional inline styles for consistency if needed, but already in layout */
.empty-state-admin {
    background: white;
    border: 1px solid var(--linen);
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
}
.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--forest);
    color: white;
    font-weight: 700;
    border-radius: 12px;
    transition: background 0.2s;
    border: none;
    cursor: pointer;
}
.btn-primary-custom:hover {
    background: var(--forest-dk);
}
.form-input {
    border: 1.5px solid var(--linen);
    border-radius: 12px;
    background: white;
    padding: 0.5rem 0.75rem;
    font-size: 0.85rem;
}
.form-input:focus {
    outline: none;
    border-color: var(--sage);
    box-shadow: 0 0 0 2px rgba(153,173,122,0.2);
}
</style>
@endsection