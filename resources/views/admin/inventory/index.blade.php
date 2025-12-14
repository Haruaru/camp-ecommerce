@extends('layouts.admin')

@section('title', 'Inventory Management')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Inventory</h1>
    <a href="{{ route('admin.inventory.create') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 flex items-center gap-2">
        <i class="fas fa-plus"></i>
        <span>Tambah Produk</span>
    </a>
</div>

<!-- Search Bar -->
<div class="mb-6">
    <form action="{{ route('admin.inventory.index') }}" method="GET">
        <div class="relative">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" class="w-full px-4 py-3 pl-12 border rounded-lg focus:ring-2 focus:ring-orange-500">
            <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
        </div>
    </form>
</div>

<!-- Inventory Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($peralatans as $alat)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative h-48 bg-gray-200">
            <img src="{{ asset('storage/' . ($alat->gambar_alat ?? 'placeholder.jpg')) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover">
            <span class="absolute top-2 left-2 px-3 py-1 rounded text-xs text-white {{ $alat->stok_alat > 0 ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $alat->stok_alat > 0 ? 'Available' : 'Out of Stock' }}
            </span>
        </div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-bold text-lg">{{ $alat->nama_alat }}</h3>
                <a href="{{ route('admin.inventory.edit', $alat->id_alat) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            <p class="text-sm text-gray-600 mb-2">{{ $alat->kategori->label_kategori }}</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Stok: {{ $alat->stok_alat }}</span>
                <span class="text-orange-500 font-bold">Rp {{ number_format($alat->harga_alat, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('admin.inventory.destroy', $alat->id_alat) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-8">
    {{ $peralatans->links() }}
</div>
@endsection


