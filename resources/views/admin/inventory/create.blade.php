@extends('layouts.admin')

@section('title', 'Tambah Peralatan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.inventory.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold">Tambah Peralatan Baru</h1>
    </div>

    <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Nama Peralatan <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="nama_alat" 
                required 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('nama_alat') border-red-500 @enderror" 
                value="{{ old('nama_alat') }}"
                placeholder="Contoh: Tenda 4 Orang, Sleeping Bag, dll"
            >
            @error('nama_alat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Kategori <span class="text-red-500">*</span>
            </label>
            <select name="kode_kategori" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('kode_kategori') border-red-500 @enderror">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}" {{ old('kode_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                    {{ $kategori->label_kategori }}
                </option>
                @endforeach
            </select>
            @error('kode_kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Gambar Peralatan
            </label>
            <input 
                type="file" 
                name="gambar_alat" 
                accept="image/*"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('gambar_alat') border-red-500 @enderror"
                onchange="previewImage(event)"
            >
            @error('gambar_alat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB</p>
            
            <!-- Image Preview -->
            <img id="preview" class="mt-4 w-full h-48 object-cover rounded hidden">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Deskripsi Peralatan
            </label>
            <textarea 
                name="deskripsi_alat" 
                rows="4" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('deskripsi_alat') border-red-500 @enderror"
                placeholder="Deskripsikan peralatan ini..."
            >{{ old('deskripsi_alat') }}</textarea>
            @error('deskripsi_alat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">
                    Stok <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    name="stok_alat" 
                    required 
                    min="0"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('stok_alat') border-red-500 @enderror" 
                    value="{{ old('stok_alat', 0) }}"
                    placeholder="10"
                >
                @error('stok_alat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">
                    Harga (Rp) <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    name="harga_alat" 
                    required 
                    min="0"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 @error('harga_alat') border-red-500 @enderror" 
                    value="{{ old('harga_alat', 0) }}"
                    placeholder="35000"
                >
                @error('harga_alat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Harga per hari</p>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.inventory.index') }}" class="flex-1 bg-gray-500 text-white py-3 rounded-lg text-center hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-save mr-2"></i>Simpan Peralatan
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection