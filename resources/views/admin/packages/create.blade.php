@extends('layouts.admin')

@section('title', 'Tambah Paket - CleanPro Admin')

@section('content')
<div>
    <div class="mb-6">
        <a href="{{ route('admin.packages') }}" class="inline-flex items-center gap-2 text-forest hover:text-forest-dk font-semibold text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Paket
        </a>
    </div>

    <div class="card-clean max-w-2xl">
        <h1 class="text-2xl font-extrabold text-forest-dk mb-6">Tambah Paket Baru</h1>

        <form action="{{ route('admin.package.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Paket -->
            <div>
                <label for="name" class="form-label">Nama Paket <span>*</span></label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                    class="form-input" placeholder="Contoh: Basic Cleaning">
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="form-label">Deskripsi <span>*</span></label>
                <textarea id="description" name="description" rows="3" required
                    class="form-input" placeholder="Jelaskan layanan paket ini...">{{ old('description') }}</textarea>
                @error('description') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Harga dan Durasi (2 kolom) -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="form-label">Harga (Rp) <span>*</span></label>
                    <input type="number" id="price" name="price" required value="{{ old('price') }}" step="1000"
                        class="form-input" placeholder="Contoh: 250000">
                    @error('price') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="duration" class="form-label">Durasi <span>*</span></label>
                    <input type="text" id="duration" name="duration" required value="{{ old('duration') }}"
                        class="form-input" placeholder="Contoh: 3 jam">
                    @error('duration') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Luas Maksimal -->
            <div>
                <label for="max_area" class="form-label">Luas Maksimal (m²)</label>
                <input type="number" id="max_area" name="max_area" value="{{ old('max_area') }}"
                    class="form-input w-40" placeholder="Contoh: 100">
                @error('max_area') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Fitur (dipisah koma) -->
            <div>
                <label for="features" class="form-label">Fitur (Pisahkan dengan koma)</label>
                <textarea id="features" name="features" rows="4"
                    class="form-input" placeholder="Contoh: Pembersihan debu, Vakum karpet, Kamar mandi">{{ old('features') }}</textarea>
                <p class="form-hint">Masukkan fitur-fitur yang termasuk dalam paket, dipisah dengan tanda koma (,).</p>
                @error('features') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-4 pt-2">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save mr-2"></i> Simpan Paket
                </button>
                <a href="{{ route('admin.packages') }}" class="btn-cancel">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Style konsisten dengan Edit Paket dan halaman admin lainnya */
.card-clean {
    background: white;
    border: 1px solid var(--linen);
    border-radius: 20px;
    padding: 2rem;
    transition: box-shadow 0.2s;
}
.card-clean:hover {
    box-shadow: 0 8px 24px rgba(84,107,65,0.08);
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
.form-input {
    width: 100%;
    padding: 0.7rem 1rem;
    border: 1.5px solid var(--linen);
    border-radius: 14px;
    font-size: 0.9rem;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: var(--cream);
}
.form-input:focus {
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
.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--forest);
    color: white;
    font-weight: 700;
    padding: 0.6rem 1.2rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
}
.btn-primary-custom:hover {
    background: var(--forest-dk);
    transform: translateY(-1px);
}
.btn-cancel {
    display: inline-flex;
    align-items: center;
    background: #f3f4f6;
    color: #4b5563;
    font-weight: 700;
    padding: 0.6rem 1.2rem;
    border-radius: 12px;
    text-decoration: none;
    transition: background 0.2s;
}
.btn-cancel:hover {
    background: #e5e7eb;
}
</style>
@endsection