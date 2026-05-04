@extends('layouts.app')

@section('title', 'Katalog Paket - CleanPro')

@section('content')

<style>
    /* ── Page Header ── */
    .katalog-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    .katalog-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 90% at 90% 60%, rgba(153,173,122,0.15) 0%, transparent 65%),
            radial-gradient(ellipse 35% 60% at 5% 80%, rgba(220,204,172,0.08) 0%, transparent 55%);
        pointer-events: none;
    }

    .katalog-header-inner {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .katalog-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(153,173,122,0.2);
        border: 1px solid rgba(153,173,122,0.4);
        color: var(--sage-lt);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.28rem 0.85rem;
        border-radius: 999px;
        margin-bottom: 1rem;
    }

    .katalog-title {
        font-size: clamp(1.8rem, 4vw, 2.75rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
        margin-bottom: 0.75rem;
    }

    .katalog-subtitle {
        font-size: 1rem;
        color: rgba(220,204,172,0.75);
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 5rem 1rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--linen);
        margin-bottom: 1rem;
    }

    /* ── Package Card ── */
    .package-card {
        background: white;
        border: 1.5px solid var(--linen);
        border-radius: 22px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
    }

    .package-card:hover {
        box-shadow: 0 18px 52px rgba(84,107,65,0.14);
        transform: translateY(-4px);
        border-color: var(--sage);
    }

    /* top accent bar */
    .package-card-bar {
        height: 5px;
        background: linear-gradient(90deg, var(--forest), var(--sage));
    }

    .package-card-head {
        padding: 1.5rem 1.5rem 1rem;
        border-bottom: 1px solid var(--linen-lt);
    }

    .package-card-name {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin-bottom: 0.75rem;
    }

    .package-card-price {
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--forest);
        line-height: 1;
    }

    .package-card-price-label {
        font-size: 0.78rem;
        color: #9ca3af;
        margin-top: 3px;
    }

    .package-card-body {
        padding: 1.25rem 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .package-card-desc {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.65;
    }

    .package-meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 0.84rem;
        color: #374151;
    }

    .package-meta-item i {
        color: var(--forest);
        width: 15px;
        text-align: center;
        font-size: 0.8rem;
    }

    /* Features list */
    .features-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: var(--forest);
        margin-bottom: 0.6rem;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        font-size: 0.84rem;
        color: #4b5563;
        line-height: 1.5;
        padding: 0.2rem 0;
    }

    .feature-item i {
        color: var(--sage);
        margin-top: 2px;
        flex-shrink: 0;
        font-size: 0.75rem;
    }

    /* CTA buttons */
    .package-card-footer {
        padding: 1.25rem 1.5rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-book-full {
        display: block;
        text-align: center;
        background: var(--forest);
        color: var(--cream);
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 10px rgba(84,107,65,0.2);
    }

    .btn-book-full:hover {
        background: var(--forest-dk);
        box-shadow: 0 4px 18px rgba(84,107,65,0.32);
    }

    .btn-detail {
        display: block;
        text-align: center;
        border: 1.5px solid var(--linen);
        color: var(--forest);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.65rem 1rem;
        border-radius: 12px;
        text-decoration: none;
        transition: border-color 0.2s, background 0.2s;
    }

    .btn-detail:hover {
        border-color: var(--sage);
        background: rgba(153,173,122,0.07);
    }

    /* ── Comparison Table ── */
    .comparison-section {
        margin-top: 4rem;
    }

    .comparison-title {
        font-size: clamp(1.4rem, 2.5vw, 1.9rem);
        font-weight: 800;
        color: var(--forest-dk);
        letter-spacing: -0.01em;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .comparison-wrap {
        overflow-x: auto;
        border-radius: 18px;
        border: 1px solid var(--linen);
        box-shadow: 0 4px 24px rgba(84,107,65,0.07);
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .comparison-table thead tr {
        background: var(--forest);
    }

    .comparison-table thead th {
        padding: 1rem 1.5rem;
        color: var(--cream);
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.02em;
    }

    .comparison-table thead th:first-child {
        text-align: left;
        border-radius: 17px 0 0 0;
    }

    .comparison-table thead th:last-child {
        border-radius: 0 17px 0 0;
    }

    .comparison-table thead th:not(:first-child) {
        text-align: center;
    }

    .comparison-table tbody tr {
        border-bottom: 1px solid var(--linen-lt);
        transition: background 0.15s;
    }

    .comparison-table tbody tr:last-child {
        border-bottom: none;
    }

    .comparison-table tbody tr:nth-child(even) {
        background: rgba(255,248,236,0.6);
    }

    .comparison-table tbody tr:hover {
        background: rgba(153,173,122,0.06);
    }

    .comparison-table tbody td {
        padding: 0.9rem 1.5rem;
        color: #374151;
    }

    .comparison-table tbody td:first-child {
        font-weight: 600;
        color: var(--forest-dk);
    }

    .comparison-table tbody td:not(:first-child) {
        text-align: center;
        color: #4b5563;
    }
</style>

<!-- Page Header -->
<section class="katalog-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 katalog-header-inner">
        <div class="katalog-tag">
            <i class="fas fa-box-open" style="font-size:0.65rem;"></i>
            Semua Paket
        </div>
        <h1 class="katalog-title">Katalog Paket Pembersihan</h1>
        <p class="katalog-subtitle">Pilih paket yang sesuai dengan kebutuhan Anda</p>
    </div>
</section>

<!-- Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

    @if($packages->isEmpty())
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p class="text-lg font-semibold" style="color:#6b7280;">Belum ada paket tersedia saat ini.</p>
            <p class="text-sm mt-1">Silakan kembali lagi nanti.</p>
        </div>
    @else

        <!-- Package Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($packages as $package)
            <div class="package-card">
                <div class="package-card-bar"></div>

                <!-- Head -->
                <div class="package-card-head">
                    <div class="package-card-name">{{ $package->name }}</div>
                    <div class="package-card-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                    <div class="package-card-price-label">/sekali layanan</div>
                </div>

                <!-- Body -->
                <div class="package-card-body">
                    <p class="package-card-desc">{{ $package->description }}</p>

                    <div class="flex flex-col gap-2">
                        <div class="package-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $package->duration }}</span>
                        </div>
                        @if($package->max_area)
                        <div class="package-meta-item">
                            <i class="fas fa-ruler-combined"></i>
                            <span>Hingga {{ $package->max_area }}m²</span>
                        </div>
                        @endif
                    </div>

                    @if($package->features)
                    <div style="border-top: 1px solid var(--linen-lt); padding-top: 0.85rem;">
                        <p class="features-label">Fitur Termasuk</p>
                        <ul>
                            @foreach($package->features as $feature)
                            <li class="feature-item">
                                <i class="fas fa-circle-check"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <!-- Footer CTAs -->
                <div class="package-card-footer">
                    @auth
                        <a href="{{ route('booking.create', $package->id) }}" class="btn-book-full">
                            <i class="fas fa-calendar-check mr-2"></i>Pesan Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-book-full">
                            <i class="fas fa-calendar-check mr-2"></i>Pesan Sekarang
                        </a>
                    @endauth
                    <a href="{{ route('package.show', $package->id) }}" class="btn-detail">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Comparison Table -->
        <div class="comparison-section">
            <h2 class="comparison-title">Perbandingan Paket</h2>
            <div class="comparison-wrap">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Fitur</th>
                            @foreach($packages as $package)
                            <th>{{ $package->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Harga</td>
                            @foreach($packages as $package)
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            @foreach($packages as $package)
                            <td>{{ $package->duration }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Luas Maksimal</td>
                            @foreach($packages as $package)
                            <td>{{ $package->max_area ? $package->max_area . 'm²' : 'Unlimited' }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @endif
</div>

@endsection