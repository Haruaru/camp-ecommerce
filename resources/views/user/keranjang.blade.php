@extends('layouts.user')

@section('title', 'Keranjang - X Adventure')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Keranjang Saya</h1>
        <a href="{{ route('home') }}" class="text-orange-500 hover:underline">Kembali</a>
    </div>

    @if($items->count() > 0)
    <div class="space-y-4 mb-8">
        @foreach($items as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="flex">
                <div class="w-24 h-24 bg-gray-800 text-white flex items-center justify-center">
                    <span class="text-xs font-bold">{{ $item->paket ? 'PAKET' : 'ALAT' }}</span>
                </div>
                <div class="flex-1 p-4">
                    <h3 class="font-bold text-lg">{{ $item->paket ? $item->paket->nama_paket : $item->alat->nama_alat }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->mulai_peminjaman->format('d/m/Y') }} - {{ $item->selesai_peminjaman->format('d/m/Y') }}</p>
                    <p class="text-orange-500 font-bold text-xl">
                        Rp {{ number_format($item->paket ? $item->paket->harga_paket : $item->alat->harga_alat, 0, ',', '.') }}
                    </p>
                </div>
                <form action="{{ route('keranjang.hapus', $item->id_keranjang_belanja) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 h-full hover:bg-red-600">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Checkout Form -->
    <form action="{{ route('keranjang.checkout') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-bold mb-2">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_kembali" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
            </div>
        </div>

        <div class="border-t pt-4">
            <div class="flex justify-between items-center mb-6">
                <span class="text-xl font-bold">Total</span>
                <span class="text-2xl font-bold text-orange-500">
                    Rp {{ number_format($items->sum(function($item) { 
                        return $item->paket ? $item->paket->harga_paket : $item->alat->harga_alat; 
                    }), 0, ',', '.') }}
                </span>
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600">
                Bayar Sekarang
            </button>
        </div>
    </form>
    @else
    <div class="text-center py-12">
        <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
        <p class="text-xl text-gray-600 mb-4">Keranjang Anda kosong</p>
        <a href="{{ route('home') }}" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600">
            Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection