@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">Edit Produk</h1>

    <form action="{{ route('admin.inventory.update', $alat->id_alat) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Nama Produk</label>
            <input type="text" name="nama_alat" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500" value="{{ old('nama_alat', $alat->nama_alat) }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Kategori</label>
            <select name="kode_kategori" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}" {{ $alat->kode_kategori == $kategori->id_kategori ? 'selected' : '' }}>
                    {{ $kategori->label_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Gambar Produk</label>
            @if($alat->gambar_alat)
            <img src="{{ asset('storage/' . $alat->gambar_alat) }}" alt="{{ $alat->nama_alat }}" class="w-32 h-32 object-cover mb-2 rounded">
            @endif
            <input type="file" name="gambar_alat" accept="image/*" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi_alat" rows="4" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">{{ old('deskripsi_alat', $alat->deskripsi_alat) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-bold mb-2">Stok</label>
                <input type="number" name="stok_alat" required min="0" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500" value="{{ old('stok_alat', $alat->stok_alat) }}">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="harga_alat" required min="0" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500" value="{{ old('harga_alat', $alat->harga_alat) }}">
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.inventory.index') }}" class="flex-1 bg-gray-500 text-white py-3 rounded-lg text-center hover:bg-gray-600">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600">
                Update
            </button>
        </div>
    </form>
</div>
@endsection