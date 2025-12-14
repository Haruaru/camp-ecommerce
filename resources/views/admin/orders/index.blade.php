@extends('layouts.admin')

@section('title', 'Order Management')

@section('content')
<h1 class="text-3xl font-bold mb-8">Order Management</h1>

<!-- Filter -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-bold mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
        </div>
    </form>
</div>

<!-- Orders List -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-4 border-b bg-gray-50">
        <h2 class="font-bold text-lg">Daftar Transaksi</h2>
    </div>
    
    <div class="divide-y">
        @forelse($pesanans as $pesanan)
        <div class="p-4 hover:bg-gray-50">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <p class="font-bold text-lg mb-2">Pesanan #{{ $pesanan->id_pesanan }}</p>
                    <div class="text-sm text-gray-600 space-y-1">
                        @foreach($pesanan->keranjangBelanja as $item)
                        <p>• {{ $item->paket ? $item->paket->nama_paket : $item->alat->nama_alat }}</p>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $pesanan->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-xl text-orange-500 mb-2">
                        Rp {{ number_format($pesanan->keranjangBelanja->sum(function($item) {
                            return $item->paket ? $item->paket->harga_paket : $item->alat->harga_alat;
                        }), 0, ',', '.') }}
                    </p>
                    <a href="{{ route('admin.orders.show', $pesanan->id_pesanan) }}" class="text-blue-500 hover:underline text-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500">
            Tidak ada pesanan
        </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $pesanans->links() }}
</div>
@endsection