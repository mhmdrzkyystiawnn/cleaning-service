@extends('layouts.app')

@section('title', 'Form Booking - CleanPro')

@section('content')

<style>
    /* ── Header ── */
    .booking-header {
        background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 55%, #6a8554 100%);
        padding: 2rem 0 1.8rem;
        position: relative;
        overflow: hidden;
    }

    .booking-header::before {
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

    /* ── Form Card ── */
    .form-card {
        background: white;
        border: 1px solid var(--linen);
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 8px 28px rgba(84,107,65,0.06);
    }

    /* Package Summary */
    .package-summary {
        background: rgba(153,173,122,0.08);
        border: 1px solid var(--sage);
        border-radius: 20px;
        padding: 1.25rem;
        margin-bottom: 2rem;
    }

    .summary-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--forest-dk);
        margin-bottom: 0.75rem;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
    }

    .summary-item {
        text-align: center;
    }

    .summary-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
    }

    .summary-value {
        font-weight: 700;
        color: var(--forest);
        font-size: 1rem;
    }

    .price-large {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest);
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--forest-dk);
        margin-bottom: 0.4rem;
    }

    .form-label span {
        color: #ef4444;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid var(--linen);
        border-radius: 14px;
        font-size: 0.9rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: var(--cream);
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--sage);
        box-shadow: 0 0 0 3px rgba(153,173,122,0.2);
        background: white;
    }

    .form-hint {
        font-size: 0.7rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .error-text {
        color: #dc2626;
        font-size: 0.7rem;
        margin-top: 0.25rem;
        display: block;
    }

    /* Price Box */
    .price-box {
        background: var(--cream);
        border: 1px solid var(--linen);
        border-radius: 18px;
        padding: 1rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
    }

    .price-label {
        font-weight: 600;
        color: #374151;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest);
    }

    /* Terms */
    .terms-box {
        background: rgba(153,173,122,0.08);
        border-left: 4px solid var(--sage);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        margin: 1rem 0;
        font-size: 0.8rem;
        color: #4b5563;
    }

    /* Buttons */
    .btn-submit {
        background: var(--forest);
        color: white;
        font-weight: 800;
        padding: 0.85rem;
        border-radius: 14px;
        border: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        width: 100%;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background: var(--forest-dk);
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #4b5563;
        font-weight: 700;
        padding: 0.85rem;
        border-radius: 14px;
        text-align: center;
        text-decoration: none;
        transition: background 0.2s;
        width: 100%;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .action-group {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }
</style>

<!-- Header -->
<section class="booking-header">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('katalog') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Katalog
        </a>
        <h1 class="page-title">Pesan Layanan Pembersihan</h1>
    </div>
</section>

<!-- Form Utama -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="form-card">
        <h2 class="text-2xl font-bold text-forest-dk mb-2">Isi Detail Booking</h2>
        <p class="text-gray-500 text-sm mb-6">Lengkapi formulir di bawah untuk memesan layanan</p>

        <!-- Info Paket -->
        <div class="package-summary">
            <div class="summary-title">{{ $package->name }}</div>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-label">Harga</div>
                    <div class="price-large">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Durasi</div>
                    <div class="summary-value">{{ $package->duration }}</div>
                </div>
                @if($package->max_area)
                <div class="summary-item">
                    <div class="summary-label">Maks. Luas</div>
                    <div class="summary-value">{{ $package->max_area }} m²</div>
                </div>
                @endif
                <div class="summary-item">
                    <div class="summary-label">Status</div>
                    <div class="summary-value" style="color: #15803d;">Tersedia</div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">

            <!-- Tanggal -->
            <div class="form-group">
                <label for="booking_date" class="form-label">Tanggal Pembersihan <span>*</span></label>
                <input type="date" id="booking_date" name="booking_date" required
                    class="form-input"
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    value="{{ old('booking_date') }}">
                @error('booking_date')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jam -->
            <div class="form-group">
                <label for="booking_time" class="form-label">Jam Pembersihan <span>*</span></label>
                <input type="time" id="booking_time" name="booking_time" required
                    class="form-input"
                    value="{{ old('booking_time') }}">
                <div class="form-hint">Jam operasional: 08:00 - 18:00</div>
                @error('booking_time')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="location" class="form-label">Lokasi / Alamat Lengkap <span>*</span></label>
                <textarea id="location" name="location" rows="3" required
                    class="form-textarea"
                    placeholder="Masukkan alamat lengkap, termasuk nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota">{{ old('location') }}</textarea>
                @error('location')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Telepon -->
            <div class="form-group">
                <label for="phone_number" class="form-label">Nomor Telepon <span>*</span></label>
                <input type="tel" id="phone_number" name="phone_number" required
                    class="form-input"
                    placeholder="+62 821-1234-5678"
                    value="{{ old('phone_number') }}">
                @error('phone_number')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="form-group">
                <label for="notes" class="form-label">Catatan Tambahan (Opsional)</label>
                <textarea id="notes" name="notes" rows="2"
                    class="form-textarea"
                    placeholder="Contoh: Area yang perlu perhatian khusus, akses lokasi, parkir, dll">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ringkasan Harga -->
            <div class="price-box">
                <span class="price-label">Total Harga</span>
                <span class="price-amount">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
            </div>

            <!-- Syarat & Ketentuan -->
            <div class="terms-box">
                <i class="fas fa-info-circle" style="color: var(--sage); margin-right: 6px;"></i>
                <strong>Syarat & Ketentuan:</strong> Pembatalan dapat dilakukan hingga 24 jam sebelum jadwal. Pembatalan kurang dari 24 jam akan dikenakan biaya 50%.
            </div>

            <!-- Tombol Aksi -->
            <div class="action-group">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i> Konfirmasi Booking
                </button>
                <a href="{{ route('katalog') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection