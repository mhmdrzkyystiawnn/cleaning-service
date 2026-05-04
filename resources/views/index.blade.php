@extends('layouts.app')

@section('title', 'CleanPro - Layanan Pembersihan Profesional')

@section('content')

<style>
    /* ── Hero ── */
    .hero-section {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.18) 0%, transparent 70%),
            radial-gradient(ellipse 40% 60% at 10% 80%, rgba(220,204,172,0.1) 0%, transparent 60%);
        pointer-events: none;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(153,173,122,0.2);
        border: 1px solid rgba(153,173,122,0.4);
        color: var(--sage-lt);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.3rem 0.9rem;
        border-radius: 999px;
        margin-bottom: 1.25rem;
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.25rem);
        font-weight: 800;
        color: var(--cream);
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .hero-title span { color: var(--sage); }

    .hero-subtitle {
        color: rgba(220,204,172,0.8);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 480px;
    }

    .btn-primary {
        display: inline-block;
        background: var(--sage);
        color: var(--forest-dk);
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.75rem 1.75rem;
        border-radius: 12px;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        box-shadow: 0 4px 16px rgba(84,107,65,0.3);
    }

    .btn-primary:hover {
        background: var(--sage-lt);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(84,107,65,0.4);
    }

    .btn-outline {
        display: inline-block;
        border: 2px solid rgba(220,204,172,0.5);
        color: var(--linen);
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.75rem 1.75rem;
        border-radius: 12px;
        text-decoration: none;
        transition: border-color 0.2s, background 0.2s;
    }

    .btn-outline:hover {
        border-color: var(--linen);
        background: rgba(220,204,172,0.1);
    }

    .hero-visual {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-visual-ring {
        width: 260px;
        height: 260px;
        border-radius: 50%;
        border: 2px solid rgba(153,173,122,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .hero-visual-ring::before {
        content: '';
        position: absolute;
        inset: 20px;
        border-radius: 50%;
        background: rgba(153,173,122,0.12);
    }

    .hero-visual-icon {
        font-size: 6rem;
        color: rgba(153,173,122,0.5);
        position: relative;
        z-index: 1;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(153,173,122,0.2);
    }

    .hero-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--cream);
        line-height: 1;
    }

    .hero-stat-label {
        font-size: 0.72rem;
        color: rgba(220,204,172,0.6);
        margin-top: 3px;
    }

    /* ── Section helpers ── */
    .section-tag {
        display: inline-block;
        background: rgba(84,107,65,0.1);
        color: var(--forest);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        margin-bottom: 0.75rem;
    }

    .section-title {
        font-size: clamp(1.6rem, 3vw, 2.25rem);
        font-weight: 800;
        color: var(--forest-dk);
        letter-spacing: -0.01em;
    }

    .section-subtitle {
        color: #6b7280;
        font-size: 0.975rem;
        line-height: 1.7;
        max-width: 520px;
        margin: 0 auto;
    }

    /* ── Services ── */
    .services-section {
        background: var(--cream);
        padding: 5rem 0;
    }

    .service-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 18px;
        padding: 2rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
    }

    .service-card:hover {
        box-shadow: 0 12px 40px rgba(84,107,65,0.12);
        transform: translateY(-3px);
        border-color: var(--sage);
    }

    .service-icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(153,173,122,0.15), rgba(84,107,65,0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        font-size: 1.6rem;
        color: var(--forest);
    }

    .service-card h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.5rem;
    }

    .service-card p {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.6;
    }

    /* ── Packages ── */
    .packages-section {
        background: white;
        padding: 5rem 0;
    }

    .package-card {
        background: var(--cream);
        border: 1.5px solid var(--linen);
        border-radius: 20px;
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
    }

    .package-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--forest), var(--sage));
        opacity: 0;
        transition: opacity 0.2s;
    }

    .package-card:hover {
        box-shadow: 0 16px 48px rgba(84,107,65,0.14);
        transform: translateY(-3px);
        border-color: var(--sage);
    }

    .package-card:hover::before { opacity: 1; }

    .package-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.35rem;
    }

    .package-price {
        font-size: 1.7rem;
        font-weight: 800;
        color: var(--forest);
        margin-bottom: 0.75rem;
        line-height: 1;
    }

    .package-desc {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .package-meta {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        margin-bottom: 1.25rem;
    }

    .package-meta-item {
        font-size: 0.825rem;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .package-meta-item i {
        color: var(--forest);
        width: 14px;
        text-align: center;
    }

    .btn-book {
        display: block;
        text-align: center;
        background: var(--forest);
        color: var(--cream);
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s;
    }

    .btn-book:hover {
        background: var(--forest-dk);
        box-shadow: 0 4px 16px rgba(84,107,65,0.3);
    }

    .btn-more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--forest);
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: gap 0.2s, color 0.18s;
    }

    .btn-more:hover { gap: 10px; color: var(--forest-dk); }

    /* ── Why Us ── */
    .why-section {
        background: var(--cream);
        padding: 5rem 0;
    }

    .why-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 2.25rem 2rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .why-card:hover {
        box-shadow: 0 12px 40px rgba(84,107,65,0.1);
        transform: translateY(-2px);
    }

    .why-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sage), var(--forest));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.75rem;
        color: var(--cream);
        box-shadow: 0 4px 20px rgba(84,107,65,0.25);
    }

    .why-card h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.6rem;
    }

    .why-card p {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.7;
    }

    /* ── CTA ── */
    .cta-section {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 50% 80% at 90% 50%, rgba(153,173,122,0.15) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5% 80%, rgba(220,204,172,0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    .cta-title {
        font-size: clamp(1.6rem, 3.5vw, 2.25rem);
        font-weight: 800;
        color: var(--cream);
        margin-bottom: 1rem;
        letter-spacing: -0.01em;
    }

    .cta-subtitle {
        font-size: 1rem;
        color: rgba(220,204,172,0.75);
        margin-bottom: 2rem;
    }

    .btn-cta {
        display: inline-block;
        background: var(--sage);
        color: var(--forest-dk);
        font-weight: 800;
        font-size: 0.95rem;
        padding: 0.85rem 2rem;
        border-radius: 14px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .btn-cta:hover {
        background: var(--sage-lt);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(0,0,0,0.25);
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="hero-badge">
                    <i class="fas fa-leaf" style="font-size:0.65rem;"></i>
                    Layanan Pembersihan #1 di Indonesia
                </div>
                <h1 class="hero-title">
                    Rumah Bersih,<br>
                    <span>Hidup Lebih Nyaman</span>
                </h1>
                <p class="hero-subtitle">
                    Layanan pembersihan profesional dengan standar internasional untuk rumah dan kantor Anda — tepat waktu, teliti, terpercaya.
                </p>
                <div class="flex flex-wrap gap-3">
                    @auth
                        <a href="{{ route('katalog') }}" class="btn-primary">
                            <i class="fas fa-calendar-check mr-2"></i>Lihat Paket
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">
                            <i class="fas fa-calendar-check mr-2"></i>Pesan Sekarang
                        </a>
                    @endauth
                    <a href="{{ route('about') }}" class="btn-outline">Pelajari Lebih Lanjut</a>
                </div>

                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-value">2.500+</div>
                        <div class="hero-stat-label">Pelanggan Puas</div>
                    </div>
                    <div>
                        <div class="hero-stat-value">8 Thn</div>
                        <div class="hero-stat-label">Pengalaman</div>
                    </div>
                    <div>
                        <div class="hero-stat-value">100%</div>
                        <div class="hero-stat-label">Garansi Kepuasan</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual hidden md:flex">
                <div class="hero-visual-ring">
                    <i class="fas fa-house-chimney hero-visual-icon"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
@if($services->count() > 0)
<section class="services-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-tag">Layanan Kami</span>
            <h2 class="section-title">Apa yang Kami Tawarkan</h2>
            <p class="section-subtitle mt-3">Solusi lengkap untuk kebersihan hunian dan tempat usaha Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $service)
            <div class="service-card">
                <div class="service-icon-wrap">
                    <i class="fas fa-{{ $service->icon }}"></i>
                </div>
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Packages Section -->
@if($packages->count() > 0)
<section class="packages-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-tag">Paket Terbaik</span>
            <h2 class="section-title">Paket Populer</h2>
            <p class="section-subtitle mt-3">Pilih paket yang sesuai kebutuhan — mulai dari kamar hingga gedung kantor</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($packages as $package)
            <div class="package-card">
                <div class="package-name">{{ $package->name }}</div>
                <div class="package-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                <p class="package-desc">{{ $package->description }}</p>
                <div class="package-meta">
                    <div class="package-meta-item">
                        <i class="fas fa-clock"></i>{{ $package->duration }}
                    </div>
                    @if($package->max_area)
                    <div class="package-meta-item">
                        <i class="fas fa-ruler-combined"></i>Hingga {{ $package->max_area }}m²
                    </div>
                    @endif
                </div>
                @auth
                    <a href="{{ route('booking.create', $package->id) }}" class="btn-book">Pesan Sekarang</a>
                @else
                    <a href="{{ route('login') }}" class="btn-book">Pesan Sekarang</a>
                @endauth
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('katalog') }}" class="btn-more">
                Lihat Semua Paket <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Why Choose Us Section -->
<section class="why-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-tag">Keunggulan Kami</span>
            <h2 class="section-title">Mengapa Pilih CleanPro?</h2>
            <p class="section-subtitle mt-3">Kami hadir bukan hanya untuk membersihkan, tapi memastikan kenyamanan Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-shield-check"></i></div>
                <h3>Profesional & Terpercaya</h3>
                <p>Tim kami terlatih dan berpengalaman dengan standar kebersihan internasional yang ketat.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-tags"></i></div>
                <h3>Harga Kompetitif</h3>
                <p>Dapatkan harga terbaik tanpa mengorbankan kualitas layanan pembersihan terbaik kami.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-face-smile"></i></div>
                <h3>Kepuasan Terjamin</h3>
                <p>100% garansi kepuasan atau kami akan merevisi pekerjaan tanpa biaya tambahan apapun.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style="position:relative;z-index:1;">
        <div class="hero-badge" style="margin-bottom:1rem;">
            <i class="fas fa-bolt" style="font-size:0.65rem;"></i>
            Mulai Sekarang
        </div>
        <h2 class="cta-title">Siap Membuat Rumah Anda<br>Lebih Bersih & Nyaman?</h2>
        <p class="cta-subtitle">Dapatkan layanan pembersihan profesional dengan satu klik mudah</p>
        @auth
            <a href="{{ route('katalog') }}" class="btn-cta">
                <i class="fas fa-arrow-right mr-2"></i>Jelajahi Paket Kami
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-cta">
                <i class="fas fa-user-plus mr-2"></i>Daftar & Pesan Sekarang
            </a>
        @endauth
    </div>
</section>

@endsection