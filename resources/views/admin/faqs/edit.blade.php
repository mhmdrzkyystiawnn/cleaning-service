@extends('layouts.admin')

@section('title', 'Edit FAQ - CleanPro Admin')

@section('content')
<div>
    <div class="mb-6">
        <a href="{{ route('admin.faqs') }}" class="inline-flex items-center gap-2 text-forest hover:text-forest-dk font-semibold text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke FAQ
        </a>
    </div>

    <div class="card-clean max-w-2xl">
        <h1 class="text-2xl font-extrabold text-forest-dk mb-6">Edit FAQ</h1>

        <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Pertanyaan -->
            <div>
                <label for="question" class="form-label">Pertanyaan <span>*</span></label>
                <input type="text" id="question" name="question" required value="{{ old('question', $faq->question) }}"
                    class="form-input">
                @error('question') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Jawaban -->
            <div>
                <label for="answer" class="form-label">Jawaban <span>*</span></label>
                <textarea id="answer" name="answer" rows="6" required
                    class="form-input">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="order" class="form-label">Urutan</label>
                <input type="number" id="order" name="order" value="{{ old('order', $faq->order) }}"
                    class="form-input w-32">
                <p class="form-hint">Semakin kecil angka, semakin atas tampilannya di halaman FAQ.</p>
                @error('order') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-4 pt-2">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save mr-2"></i> Update FAQ
                </button>
                <a href="{{ route('admin.faqs') }}" class="btn-cancel">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Tambahan style untuk halaman ini (konsisten dengan layout admin) */
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