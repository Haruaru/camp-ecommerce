@extends('layouts.admin')

@section('title', 'Edit Paket')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.paket.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-2xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Paket</h1>
    </div>

    <form action="{{ route('admin.paket.update', $paket->id_paket) }}" method="POST" class="bg-white rounded-lg shadow-lg p-8">
        @csrf
        @method('PUT')

        <!-- Nama Paket -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Nama Paket <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="nama_paket" 
                required 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                value="{{ old('nama_paket', $paket->nama_paket) }}"
            >
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
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                    value="{{ old('harga_paket', $paket->harga_paket) }}"
                >
            </div>
        </div>

        <!-- Pilih Peralatan -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Pilih Peralatan <span class="text-red-500">*</span>
            </label>
            <div class="border border-gray-300 rounded-lg p-4 max-h-72 overflow-y-auto bg-gray-50">
                @foreach($peralatans as $alat)
                <label class="flex items-center justify-between p-3 mb-2 hover:bg-white rounded cursor-pointer transition border border-transparent hover:border-orange-200">
                    <div class="flex items-center flex-1">
                        <input 
                            type="checkbox" 
                            name="peralatan_ids[]" 
                            value="{{ $alat->id_alat }}"
                            class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-500 cursor-pointer"
                            {{ $paket->peralatan->contains($alat->id_alat) ? 'checked' : '' }}
                        >
                        <div class="ml-3">
                            <span class="font-semibold text-gray-800">{{ $alat->nama_alat }}</span>
                            <span class="text-sm text-gray-500 ml-2">({{ $alat->kategori->label_kategori }})</span>
                        </div>
                    </div>
                    <span class="text-orange-600 font-bold">Rp {{ number_format($alat->harga_alat, 0, ',', '.') }}</span>
                </label>
                @endforeach
            </div>
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
            <button type="submit" class="flex-1 bg-blue-500 text-white py-4 rounded-lg hover:bg-blue-600 transition font-bold text-lg shadow-lg hover:shadow-xl">
                <i class="fas fa-save mr-2"></i>Update Paket
            </button>
        </div>
    </form>
</div>
@endsection