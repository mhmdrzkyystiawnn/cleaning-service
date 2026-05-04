@extends('layouts.app')

@section('title', 'FAQ - CleanPro')

@section('content')

<style>
    /* ── FAQ Hero ── */
    .faq-hero {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    .faq-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 80% at 80% 50%, rgba(153,173,122,0.18) 0%, transparent 70%),
            radial-gradient(ellipse 40% 60% at 10% 80%, rgba(220,204,172,0.1) 0%, transparent 60%);
        pointer-events: none;
    }

    .faq-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: var(--cream);
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .faq-subtitle {
        color: rgba(220,204,172,0.8);
        font-size: 1.05rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ── FAQ Section ── */
    .faq-section {
        background: white;
        padding: 5rem 0;
    }

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

    .faq-card {
        background: var(--cream);
        border: 1px solid var(--linen);
        border-radius: 20px;
        overflow: hidden;
        transition: box-shadow 0.2s, border-color 0.2s;
    }

    .faq-card:hover {
        box-shadow: 0 12px 40px rgba(84,107,65,0.12);
        border-color: var(--sage);
    }

    .faq-question {
        width: 100%;
        padding: 1.5rem;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        font-size: 1rem;
        color: var(--forest-dk);
        transition: background 0.18s;
    }

    .faq-question:hover {
        background: rgba(153,173,122,0.08);
    }

    .faq-question i {
        color: var(--sage);
        transition: transform 0.25s ease;
        font-size: 0.9rem;
    }

    .faq-question.active i {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease-out;
        border-top: 1px solid transparent;
    }

    .faq-answer.active {
        max-height: 500px;
        border-top-color: var(--linen);
    }

    .faq-answer-content {
        padding: 1.5rem;
        color: #4b5563;
        font-size: 0.9rem;
        line-height: 1.7;
        background: white;
    }

    /* ── Help Section ── */
    .help-section {
        background: var(--cream);
        padding: 4rem 0;
    }

    .help-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .help-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(84,107,65,0.12);
        border-color: var(--sage);
    }

    .help-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sage), var(--forest));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        font-size: 1.6rem;
        color: var(--cream);
        box-shadow: 0 4px 20px rgba(84,107,65,0.25);
    }

    .help-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.5rem;
    }

    .help-card p {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.6;
    }

    .help-card .contact-value {
        font-weight: 600;
        color: var(--forest);
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }

    .help-card .contact-note {
        font-size: 0.7rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--cream);
        border-radius: 24px;
        border: 1px solid var(--linen);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--sage);
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .btn-primary {
        display: block;
        text-align: center;
        background: var(--forest);
        color: var(--cream);
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.75rem 0;
        border-radius: 12px;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 10px rgba(84,107,65,0.2);
    }

    .btn-primary:hover {
        background: var(--forest-dk);
        box-shadow: 0 4px 18px rgba(84,107,65,0.32);
    }
</style>

<!-- Hero Section -->
<section class="faq-hero">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="hero-badge d-inline-flex" style="margin-bottom: 1rem;">
            <i class="fas fa-question-circle mr-1"></i>
            FAQ
        </div>
        <h1 class="faq-title">Pertanyaan yang Sering Diajukan</h1>
        <p class="faq-subtitle">Temukan jawaban untuk pertanyaan Anda tentang layanan kami</p>
    </div>
</section>

@if($faqs->isEmpty())
    <!-- Empty State -->
    <section class="faq-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="empty-title">Belum Ada FAQ</h3>
                <p class="empty-text">FAQ akan segera tersedia. Silakan hubungi tim support kami untuk pertanyaan Anda.</p>
            </div>
        </div>
    </section>
@else
    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="section-tag">Pertanyaan Umum</span>
                <h2 class="section-title" style="font-size: 1.8rem;">Apa yang Ingin Anda Tanyakan?</h2>
                <p class="section-subtitle mt-3">Cari tahu lebih lanjut tentang layanan dan kebijakan kami</p>
            </div>

            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                <div class="faq-card">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $faq->question }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Help Section -->
<section class="help-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-tag">Butuh Bantuan?</span>
            <h2 class="section-title" style="font-size: 1.8rem;">Tidak Menemukan Jawaban?</h2>
            <p class="section-subtitle mt-3">Tim support kami siap membantu Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="help-card">
                <div class="help-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Telepon</h3>
                <p class="contact-value">+62 821-1234-5678</p>
                <p class="contact-note">Senin-Jumat, 09:00-18:00</p>
            </div>

            <div class="help-card">
                <div class="help-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email</h3>
                <p class="contact-value">info@cleanpro.com</p>
                <p class="contact-note">Response dalam 24 jam</p>
            </div>

            <div class="help-card">
                <div class="help-icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3>WhatsApp</h3>
                <p class="contact-value">+62 821-1234-5678</p>
                <p class="contact-note">Response cepat, 24/7</p>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-10">
            @auth
                <a href="{{ route('katalog') }}" class="btn-primary" style="background: var(--forest);">
                    <i class="fas fa-calendar-check mr-2"></i>Lihat Paket Kami
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary" style="background: var(--forest);">
                    <i class="fas fa-user-plus mr-2"></i>Daftar & Pesan Sekarang
                </a>
            @endauth
        </div>
    </div>
</section>

<script>
    function toggleFaq(button) {
        const answer = button.nextElementSibling;
        const isActive = answer.classList.contains('active');
        
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(answers => {
            if (answers !== answer && answers.classList.contains('active')) {
                answers.classList.remove('active');
                answers.previousElementSibling.classList.remove('active');
            }
        });
        
        // Toggle current FAQ
        answer.classList.toggle('active');
        button.classList.toggle('active');
    }

    // Optional: Open first FAQ by default
    // document.addEventListener('DOMContentLoaded', function() {
    //     const firstFaq = document.querySelector('.faq-question');
    //     if (firstFaq) toggleFaq(firstFaq);
    // });
</script>

@endsection