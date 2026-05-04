@extends('layouts.admin')

@section('title', 'Kelola Paket - CleanPro Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-extrabold text-forest-dk">Kelola Paket Pembersihan</h1>
        <a href="{{ route('admin.package.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus mr-2"></i> Tambah Paket
        </a>
    </div>

    @if($packages->isEmpty())
        <div class="empty-state-admin">
            <i class="fas fa-box-open text-5xl text-sage/40 mb-4"></i>
            <p class="text-gray-500">Belum ada paket. Silakan tambahkan paket baru.</p>
        </div>
    @else
        <div class="data-table overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Luas Maks.</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                    <tr>
                        <td>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $package->name }}</p>
                                <p class="text-gray-500 text-xs">{{ Str::limit($package->description, 50) }}</p>
                            </div>
                        </td>
                        <td class="font-semibold text-forest">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                        <td>{{ $package->duration }}</td>
                        <td>{{ $package->max_area ? $package->max_area . ' m²' : '-' }}</td>
                        <td class="space-x-2">
                            <a href="{{ route('admin.package.edit', $package->id) }}" class="text-forest hover:text-forest-dk font-semibold text-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.package.destroy', $package->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
/* Style konsisten dengan admin lainnya */
.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--forest);
    color: white;
    font-weight: 700;
    padding: 0.5rem 1.2rem;
    border-radius: 12px;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
}
.btn-primary-custom:hover {
    background: var(--forest-dk);
    transform: translateY(-1px);
}
.empty-state-admin {
    background: white;
    border: 1px solid var(--linen);
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
}
.data-table {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--linen);
    overflow: hidden;
}
.data-table thead {
    background: var(--cream);
}
.data-table th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 700;
    color: var(--forest-dk);
    font-size: 0.8rem;
    letter-spacing: 0.05em;
}
.data-table td {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--linen);
    font-size: 0.85rem;
    color: #374151;
}
</style>
@endsection