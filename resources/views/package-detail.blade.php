@extends('layouts.app')

@section('title', 'Detail Paket - CleanPro')

@section('content')

<style>
    /* ── Hero Detail ── */
    .detail-hero {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 3rem 0 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
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
        margin-bottom: 1rem;
    }

    .back-link:hover {
        color: var(--cream);
    }

    .detail-title {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
        margin-bottom: 0.5rem;
    }

    .detail-sub {
        color: rgba(220,204,172,0.7);
        font-size: 1rem;
    }

    /* ── Main Content ── */
    .package-detail-section {
        background: white;
        padding: 4rem 0;
    }

    .info-card {
        background: var(--cream);
        border: 1px solid var(--linen);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .info-card h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin-bottom: 1rem;
    }

    .desc-text {
        color: #4b5563;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    /* Stats grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border: 1px solid var(--linen);
    }

    .stat-item {
        text-align: center;
    }

    .stat-icon {
        font-size: 1.6rem;
        color: var(--forest);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--forest-dk);
    }

    /* Feature list */
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0;
    }

    .feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 0.6rem 0;
        border-bottom: 1px dashed var(--linen);
        color: #374151;
        font-size: 0.9rem;
    }

    .feature-list li:last-child {
        border-bottom: none;
    }

    .feature-list i {
        color: var(--sage);
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* Sidebar cards */
    .sidebar-card {
        background: var(--cream);
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .price-box {
        background: linear-gradient(135deg, var(--forest) 0%, var(--forest-dk) 100%);
        color: white;
        text-align: center;
    }

    .price-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.7);
    }

    .price-value {
        font-size: 2.25rem;
        font-weight: 800;
        margin: 0.5rem 0 1rem;
        line-height: 1;
    }

    .btn-book-sidebar {
        display: block;
        background: var(--sage);
        color: var(--forest-dk);
        font-weight: 800;
        padding: 0.85rem;
        border-radius: 14px;
        text-decoration: none;
        text-align: center;
        transition: background 0.2s, transform 0.15s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-book-sidebar:hover {
        background: var(--sage-lt);
        transform: translateY(-1px);
    }

    .benefit-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .benefit-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.5rem 0;
        font-size: 0.85rem;
        color: #374151;
        border-bottom: 1px solid var(--linen);
    }

    .benefit-list li:last-child {
        border-bottom: none;
    }

    .benefit-list i {
        color: var(--forest);
        width: 18px;
        text-align: center;
    }

    .contact-card {
        background: rgba(153,173,122,0.1);
        border: 1px solid var(--sage);
        text-align: center;
    }

    .contact-card h3 {
        color: var(--forest-dk);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .btn-wa {
        display: inline-block;
        background: #25D366;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        margin-top: 0.75rem;
        transition: background 0.2s;
    }

    .btn-wa:hover {
        background: #128C7E;
    }

    /* Related packages */
    .related-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid var(--linen);
    }

    .related-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin-bottom: 1.5rem;
    }

    .btn-outline-sage {
        display: inline-block;
        border: 2px solid var(--sage);
        color: var(--forest);
        padding: 0.6rem 1.5rem;
        border-radius: 40px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }

    .btn-outline-sage:hover {
        background: var(--sage);
        color: white;
    }

    /* Empty fallback */
    .text-muted {
        color: #9ca3af;
    }
</style>

<!-- Hero mini -->
<section class="detail-hero">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('katalog') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Katalog
        </a>
        <h1 class="detail-title">{{ $package->name }}</h1>
        <p class="detail-sub">Pilih paket yang sesuai dengan kebutuhan kebersihan Anda</p>
    </div>
</section>

<!-- Main Content -->
<section class="package-detail-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column: Deskripsi & Fitur -->
            <div class="lg:col-span-2 space-y-6">
                <div class="info-card">
                    <h2>Tentang Paket Ini</h2>
                    <p class="desc-text">{{ $package->description }}</p>

                    <!-- Statistik ringkas -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-label">Durasi</div>
                            <div class="stat-value">{{ $package->duration }}</div>
                        </div>
                        @if($package->max_area)
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-ruler-combined"></i></div>
                            <div class="stat-label">Maks. Luas</div>
                            <div class="stat-value">{{ $package->max_area }} m²</div>
                        </div>
                        @endif
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-tag"></i></div>
                            <div class="stat-label">Harga Mulai</div>
                            <div class="stat-value">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                @if($package->features && count($package->features) > 0)
                <div class="info-card">
                    <h2><i class="fas fa-list-check mr-2" style="color:var(--forest);"></i> Fitur Termasuk</h2>
                    <ul class="feature-list">
                        @foreach($package->features as $feature)
                        <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6">
                <!-- Price & CTA -->
                <div class="sidebar-card price-box">
                    <div class="price-label">Total Harga</div>
                    <div class="price-value">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                    @auth
                        <a href="{{ route('booking.create', $package->id) }}" class="btn-book-sidebar">
                            <i class="fas fa-calendar-check mr-2"></i> Pesan Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-book-sidebar">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login & Pesan
                        </a>
                    @endauth
                </div>

                <!-- Keuntungan Paket -->
                <div class="sidebar-card">
                    <h3 style="font-weight:800; margin-bottom:0.75rem; color:var(--forest-dk);">
                        <i class="fas fa-gem mr-1"></i> Keuntungan Paket Ini
                    </h3>
                    <ul class="benefit-list">
                        <li><i class="fas fa-brush"></i> Pembersihan profesional</li>
                        <li><i class="fas fa-leaf"></i> Produk ramah lingkungan</li>
                        <li><i class="fas fa-thumbs-up"></i> Garansi kepuasan 100%</li>
                        <li><i class="fas fa-certificate"></i> Tim terlatih & bersertifikat</li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="sidebar-card contact-card">
                    <h3><i class="fas fa-headset"></i> Ada Pertanyaan?</h3>
                    <p style="font-size:0.85rem; margin-top:-0.25rem;">Konsultasi gratis via WhatsApp</p>
                    <a href="https://wa.me/6282112345678" class="btn-wa" target="_blank">
                        <i class="fab fa-whatsapp mr-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Related packages (opsional) -->
        <div class="related-section">
            <h2 class="related-title">Paket Lain yang Mungkin Anda Suka</h2>
            <div class="text-center mt-4">
                <a href="{{ route('katalog') }}" class="btn-outline-sage">
                    Lihat Semua Paket <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection