@extends('layouts.app')

@section('title', 'Tentang Kami - CleanPro')

@section('content')

<style>
    /* ── Page Header ── */
    .about-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    .about-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 90% at 90% 60%, rgba(153,173,122,0.15) 0%, transparent 65%),
            radial-gradient(ellipse 35% 60% at 5% 80%, rgba(220,204,172,0.08) 0%, transparent 55%);
        pointer-events: none;
    }

    .about-header-inner {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .page-tag {
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

    .about-title {
        font-size: clamp(1.8rem, 4vw, 2.75rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
        margin-bottom: 0.75rem;
    }

    .about-subtitle {
        font-size: 1rem;
        color: rgba(220,204,172,0.75);
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.65;
    }

    /* ── Section tag (inline) ── */
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
        margin-bottom: 0.65rem;
    }

    .section-title {
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 800;
        color: var(--forest-dk);
        letter-spacing: -0.015em;
        margin-bottom: 1rem;
    }

    /* ── Who We Are ── */
    .about-prose p {
        font-size: 0.95rem;
        color: #4b5563;
        line-height: 1.8;
        margin-bottom: 0.9rem;
    }

    .about-visual {
        background: linear-gradient(135deg, rgba(153,173,122,0.15), rgba(84,107,65,0.08));
        border: 1.5px solid var(--linen);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .about-visual-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--forest), var(--sage));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--cream);
        box-shadow: 0 6px 24px rgba(84,107,65,0.25);
    }

    .about-visual p {
        font-size: 0.95rem;
        color: #4b5563;
        line-height: 1.6;
        font-weight: 500;
    }

    .about-visual strong {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest);
        display: block;
        margin-bottom: 0.25rem;
    }

    /* ── Commitment ── */
    .commit-visual {
        background: linear-gradient(135deg, rgba(153,173,122,0.12), rgba(220,204,172,0.15));
        border: 1.5px solid var(--linen);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .commit-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    .commit-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
        color: #374151;
        line-height: 1.6;
    }

    .commit-item-icon {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sage), var(--forest));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .commit-item-icon i {
        color: white;
        font-size: 0.6rem;
    }

    .commit-item strong {
        color: var(--forest-dk);
    }

    /* ── Stats Row ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--linen);
        border: 1px solid var(--linen);
        border-radius: 18px;
        overflow: hidden;
        margin: 0 0 4rem;
    }

    .stat-cell {
        background: white;
        padding: 1.75rem 1rem;
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--forest);
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .stat-label {
        font-size: 0.78rem;
        color: #6b7280;
        font-weight: 500;
    }

    /* ── Team ── */
    .team-card {
        background: white;
        border: 1.5px solid var(--linen);
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
    }

    .team-card:hover {
        box-shadow: 0 12px 40px rgba(84,107,65,0.12);
        transform: translateY(-3px);
        border-color: var(--sage);
    }

    .team-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sage), var(--forest));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.8rem;
        color: var(--cream);
        box-shadow: 0 4px 16px rgba(84,107,65,0.22);
    }

    .team-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.2rem;
    }

    .team-role {
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: var(--sage);
        margin-bottom: 0.65rem;
    }

    .team-bio {
        font-size: 0.84rem;
        color: #6b7280;
        line-height: 1.6;
    }

    /* ── Awards ── */
    .awards-section {
        background: linear-gradient(135deg, rgba(153,173,122,0.08), rgba(220,204,172,0.15));
        border: 1px solid var(--linen);
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 3rem;
    }

    .awards-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--forest-dk);
        text-align: center;
        margin-bottom: 1.75rem;
        letter-spacing: -0.01em;
    }

    .award-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 14px;
        padding: 1.25rem 1rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .award-card:hover {
        box-shadow: 0 6px 20px rgba(84,107,65,0.1);
        transform: translateY(-2px);
    }

    .award-icon {
        font-size: 1.6rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .award-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--forest-dk);
        line-height: 1.4;
    }

    /* ── Contact CTA ── */
    .contact-cta {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 100%);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .contact-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.15) 0%, transparent 65%);
        pointer-events: none;
    }

    .contact-cta-inner {
        position: relative;
        z-index: 1;
    }

    .contact-cta h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--cream);
        margin-bottom: 1.75rem;
        letter-spacing: -0.01em;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .contact-grid { grid-template-columns: repeat(3, 1fr); }
    }

    .contact-item {
        background: rgba(255,248,236,0.08);
        border: 1px solid rgba(220,204,172,0.2);
        border-radius: 14px;
        padding: 1.25rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-item-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(153,173,122,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: var(--sage);
    }

    .contact-item p {
        font-size: 0.9rem;
        color: rgba(220,204,172,0.85);
        font-weight: 500;
    }
</style>

<!-- Page Header -->
<section class="about-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 about-header-inner">
        <div class="page-tag">
            <i class="fas fa-leaf" style="font-size:0.65rem;"></i>
            Tentang Kami
        </div>
        <h1 class="about-title">Tentang CleanPro</h1>
        <p class="about-subtitle">Kami berkomitmen memberikan layanan pembersihan terbaik untuk keluarga dan bisnis Anda</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

    <!-- Stats Row -->
    <div class="stats-row mb-14">
        <div class="stat-cell">
            <div class="stat-value">5.000+</div>
            <div class="stat-label">Pelanggan Puas</div>
        </div>
        <div class="stat-cell">
            <div class="stat-value">4+ Thn</div>
            <div class="stat-label">Berpengalaman</div>
        </div>
        <div class="stat-cell">
            <div class="stat-value">4.9★</div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
    </div>

    <!-- Who We Are -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
        <div>
            <span class="section-tag">Siapa Kami</span>
            <h2 class="section-title">Layanan Pembersihan<br>yang Bisa Diandalkan</h2>
            <div class="about-prose">
                <p>CleanPro adalah layanan pembersihan profesional yang telah melayani ribuan keluarga dan bisnis di Jakarta dan sekitarnya sejak 2020.</p>
                <p>Kami percaya bahwa rumah yang bersih adalah investasi untuk kesehatan keluarga Anda. Oleh karena itu, kami menggunakan produk pembersih yang aman, ramah lingkungan, dan teknologi terkini.</p>
                <p>Tim kami terdiri dari profesional berpengalaman yang telah melalui pelatihan intensif dan memiliki sertifikasi internasional dalam pembersihan.</p>
            </div>
        </div>
        <div class="about-visual">
            <div class="about-visual-icon">
                <i class="fas fa-building"></i>
            </div>
            <div>
                <strong>5.000+</strong>
                Pelanggan telah mempercayakan kebersihan rumah dan kantor mereka kepada tim CleanPro.
            </div>
        </div>
    </div>

    <!-- Commitment -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
        <div class="commit-visual">
            <div class="about-visual-icon" style="background: linear-gradient(135deg, var(--sage), #6a8a4e);">
                <i class="fas fa-leaf"></i>
            </div>
            <div>
                <strong style="font-size:1.35rem;font-weight:800;color:var(--forest);display:block;margin-bottom:0.25rem;">100%</strong>
                <span style="font-size:0.9rem;color:#4b5563;font-weight:500;">Produk eco-friendly &amp; ramah lingkungan</span>
            </div>
        </div>
        <div>
            <span class="section-tag">Komitmen Kami</span>
            <h2 class="section-title">Standar Tinggi di<br>Setiap Layanan</h2>
            <ul class="commit-list">
                <li class="commit-item">
                    <span class="commit-item-icon"><i class="fas fa-check"></i></span>
                    <span><strong>Kebersihan Maksimal:</strong> Standar kebersihan internasional di setiap layanan</span>
                </li>
                <li class="commit-item">
                    <span class="commit-item-icon"><i class="fas fa-check"></i></span>
                    <span><strong>Lingkungan Sehat:</strong> Hanya menggunakan produk eco-friendly dan aman</span>
                </li>
                <li class="commit-item">
                    <span class="commit-item-icon"><i class="fas fa-check"></i></span>
                    <span><strong>Tim Profesional:</strong> Staf terlatih dan bersertifikat internasional</span>
                </li>
                <li class="commit-item">
                    <span class="commit-item-icon"><i class="fas fa-check"></i></span>
                    <span><strong>Harga Terjangkau:</strong> Kualitas premium dengan harga yang kompetitif</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Team -->
    <div class="mb-16">
        <div class="text-center mb-10">
            <span class="section-tag">Tim Kami</span>
            <h2 class="section-title" style="margin-bottom:0;">Orang-orang di Balik CleanPro</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="team-card">
                <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                <div class="team-name">Budi Santoso</div>
                <div class="team-role">Founder &amp; CEO</div>
                <p class="team-bio">Berpengalaman 15 tahun di industri pembersihan dengan sertifikasi internasional.</p>
            </div>
            <div class="team-card">
                <div class="team-avatar"><i class="fas fa-user-nurse"></i></div>
                <div class="team-name">Siti Rahayu</div>
                <div class="team-role">Quality Manager</div>
                <p class="team-bio">Memastikan setiap layanan memenuhi standar kualitas tertinggi kami.</p>
            </div>
            <div class="team-card">
                <div class="team-avatar"><i class="fas fa-user-gear"></i></div>
                <div class="team-name">Ahmad Wijaya</div>
                <div class="team-role">Operations Director</div>
                <p class="team-bio">Mengelola operasional dan kepuasan pelanggan dengan profesional.</p>
            </div>
        </div>
    </div>

    <!-- Awards -->
    <div class="awards-section">
        <h2 class="awards-title">Penghargaan &amp; Sertifikasi</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="award-card">
                <span class="award-icon" style="color:#d97706;">🏆</span>
                <p class="award-label">Best Cleaning Service 2023</p>
            </div>
            <div class="award-card">
                <span class="award-icon"><i class="fas fa-certificate" style="color:var(--forest);"></i></span>
                <p class="award-label">ISO 9001:2015</p>
            </div>
            <div class="award-card">
                <span class="award-icon" style="color:#d97706;">⭐</span>
                <p class="award-label">Rating 4.9/5</p>
            </div>
            <div class="award-card">
                <span class="award-icon"><i class="fas fa-heart" style="color:#ef4444;"></i></span>
                <p class="award-label">Customer Choice</p>
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="contact-cta">
        <div class="contact-cta-inner">
            <h2>Hubungi Kami</h2>
            <div class="contact-grid">
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                    <p>+62 821-1234-5678</p>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                    <p>info@cleanpro.com</p>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fas fa-location-dot"></i></div>
                    <p>Jakarta, Indonesia</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection