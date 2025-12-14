@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.kategori.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Kategori Baru</h1>
    </div>

    <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="label_kategori" 
                required 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('label_kategori') border-red-500 @enderror" 
                value="{{ old('label_kategori') }}"
                placeholder="Contoh: Tenda, Alat Masak, Penerangan"
            >
            @error('label_kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Gambar Kategori
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-orange-500 transition">
                <input 
                    type="file" 
                    name="gambar_kategori" 
                    accept="image/*"
                    class="hidden"
                    id="gambar_kategori"
                    onchange="previewImage(event)"
                >
                <label for="gambar_kategori" class="cursor-pointer">
                    <div id="preview-container" class="hidden mb-4">
                        <img id="preview" class="w-32 h-32 object-cover rounded-lg mx-auto">
                    </div>
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Klik untuk upload gambar</p>
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB</p>
                </label>
            </div>
            @error('gambar_kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.kategori.index') }}" class="flex-1 bg-gray-500 text-white py-3 rounded-lg text-center hover:bg-gray-600 transition font-semibold">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition font-semibold">
                <i class="fas fa-save mr-2"></i>Simpan Kategori
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('preview-container');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection