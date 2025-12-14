@extends('layouts.admin')

@section('title', 'Tambah Paket Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.paket.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-2xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Paket Baru</h1>
    </div>

    <form action="{{ route('admin.paket.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8">
        @csrf

        <!-- Nama Paket -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Nama Paket <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="nama_paket" 
                required 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('nama_paket') border-red-500 @enderror" 
                value="{{ old('nama_paket') }}"
                placeholder="Contoh: ICIKIWIR, Paket Camping Keluarga"
            >
            @error('nama_paket')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Paket -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Harga Paket <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-3 text-gray-700 font-semibold">Rp</span>
                <input 
                    type="number" 
                    name="harga_paket" 
                    required 
                    min="0"
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('harga_paket') border-red-500 @enderror" 
                    value="{{ old('harga_paket') }}"
                    placeholder="60000"
                >
            </div>
            @error('harga_paket')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Harga per hari</p>
        </div>

        <!-- Pilih Peralatan -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Pilih Peralatan <span class="text-red-500">*</span>
            </label>
            <div class="border border-gray-300 rounded-lg p-4 max-h-72 overflow-y-auto bg-gray-50">
                @forelse($peralatans as $alat)
                <label class="flex items-center justify-between p-3 mb-2 hover:bg-white rounded cursor-pointer transition border border-transparent hover:border-orange-200">
                    <div class="flex items-center flex-1">
                        <input 
                            type="checkbox" 
                            name="peralatan_ids[]" 
                            value="{{ $alat->id_alat }}"
                            class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-500 cursor-pointer"
                            {{ in_array($alat->id_alat, old('peralatan_ids', [])) ? 'checked' : '' }}
                        >
                        <div class="ml-3">
                            <span class="font-semibold text-gray-800">{{ $alat->nama_alat }}</span>
                            <span class="text-sm text-gray-500 ml-2">({{ $alat->kategori->label_kategori }})</span>
                        </div>
                    </div>
                    <span class="text-orange-600 font-bold">Rp {{ number_format($alat->harga_alat, 0, ',', '.') }}</span>
                </label>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Belum ada peralatan.</p>
                    <a href="{{ route('admin.inventory.create') }}" class="text-orange-500 hover:underline font-semibold mt-2 inline-block">
                        Tambah Peralatan
                    </a>
                </div>
                @endforelse
            </div>
            @error('peralatan_ids')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-2">Pilih minimal 1 peralatan untuk paket ini</p>
        </div>

        <!-- Status Ketersediaan -->
        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Status Ketersediaan <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-2 gap-4">
                @foreach($statuses as $status)
                <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:border-orange-500 {{ $status->status_ketersediaan == 'Available' ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
                    <input 
                        type="radio" 
                        name="status_id" 
                        value="{{ $status->id_status }}"
                        required
                        class="w-5 h-5 text-orange-500 focus:ring-orange-500"
                        {{ old('status_id') == $status->id_status ? 'checked' : ($loop->first ? 'checked' : '') }}
                    >
                    <div class="ml-3">
                        <span class="font-bold text-gray-800">{{ $status->status_ketersediaan }}</span>
                        @if($status->status_ketersediaan == 'Available')
                        <p class="text-xs text-gray-600">Paket tersedia untuk disewa</p>
                        @else
                        <p class="text-xs text-gray-600">Paket tidak tersedia</p>
                        @endif
                    </div>
                </label>
                @endforeach
            </div>
            @error('status_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Action -->
        <div class="flex gap-4">
            <a href="{{ route('admin.paket.index') }}" class="flex-1 bg-gray-500 text-white py-4 rounded-lg text-center hover:bg-gray-600 transition font-bold text-lg">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-green-500 text-white py-4 rounded-lg hover:bg-green-600 transition font-bold text-lg shadow-lg hover:shadow-xl">
                <i class="fas fa-save mr-2"></i>Simpan Paket
            </button>
        </div>
    </form>
</div>
@endsection