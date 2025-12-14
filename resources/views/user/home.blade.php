@extends('layouts.user')

@section('title', 'Beranda - X Adventure')

@section('content')
<!-- Hero Banner -->
<div class="relative h-64 bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1200')">
    <div class="absolute inset-0 flex items-center justify-center text-white text-center">
        <div>
            <h1 class="text-5xl font-bold mb-2">DISCOUNT UP TO</h1>
            <p class="text-7xl font-bold">50%</p>
            <p class="text-2xl">ON SELECTED ITEMS</p>
        </div>
    </div>
</div>

<!-- Categories -->
<section class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Produk Kami</h2>
        <a href="{{ route('katalog.peralatan') }}" class="text-orange-500 hover:underline">Selengkapnya</a>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @foreach($kategoris as $kategori)
        <a href="{{ route('katalog.peralatan') }}?kategori={{ $kategori->id_kategori }}" class="bg-gray-800 text-white py-4 px-2 rounded text-center hover:bg-gray-700 transition">
            {{ strtoupper($kategori->label_kategori) }}
        </a>
        @endforeach
    </div>

    <!-- Paket Section -->
    <h2 class="text-2xl font-bold mb-6">PAKET</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($pakets->take(6) as $paket)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <div class="relative h-48 bg-gray-300">
                <img src="{{ asset('storage/' . ($paket->gambar_paket ?? 'placeholder.jpg')) }}" alt="{{ $paket->nama_paket }}" class="w-full h-full object-cover">
                @php
                    $status = $paket->status->first();
                @endphp
                <span class="absolute top-2 left-2 px-3 py-1 rounded text-xs text-white {{ $status && $status->status_ketersediaan == 'Available' ? 'bg-green-500' : 'bg-gray-500' }}">
                    {{ $status ? $status->status_ketersediaan : 'Unknown' }}
                </span>
            </div>
            <div class="p-4">
                <div class="bg-gray-800 text-white text-center py-2 mb-3 font-bold">
                    {{ strtoupper($paket->nama_paket) }}
                </div>
                <div class="text-sm text-gray-600 mb-2">
                    @foreach($paket->peralatan->take(3) as $alat)
                        • {{ $alat->nama_alat }}<br>
                    @endforeach
                </div>
                <div class="text-orange-500 font-bold text-xl mb-4">
                    Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
                </div>
                <div class="flex gap-2">
                    <button onclick="showAddToCartModalPaket({{ $paket->id_paket }}, '{{ $paket->nama_paket }}', {{ $paket->harga_paket }})" class="flex-1 border border-orange-500 text-orange-500 py-2 rounded text-center hover:bg-orange-50">
                        Tambah
                    </button>
                    <button onclick="showAddToCartModalPaket({{ $paket->id_paket }}, '{{ $paket->nama_paket }}', {{ $paket->harga_paket }})" class="flex-1 bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                        Sewa
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Modal Add to Cart untuk Paket -->
<div id="addToCartModalPaket" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-xl font-bold mb-4">Tambah Paket ke Keranjang</h3>
        <form action="{{ route('keranjang.tambah') }}" method="POST">
            @csrf
            <input type="hidden" name="tipe" value="paket">
            <input type="hidden" name="id" id="modal_paket_id">
            
            <div class="mb-4">
                <p class="text-gray-700 font-semibold" id="modal_paket_nama"></p>
                <p class="text-orange-500 font-bold text-xl" id="modal_paket_harga"></p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tanggal Mulai Peminjaman</label>
                <input type="date" name="mulai_peminjaman" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Tanggal Selesai Peminjaman</label>
                <input type="date" name="selesai_peminjaman" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
            </div>
            
            <div class="flex gap-4">
                <button type="button" onclick="closeAddToCartModalPaket()" class="flex-1 bg-gray-500 text-white py-2 rounded hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                    Tambah ke Keranjang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddToCartModalPaket(id, nama, harga) {
    document.getElementById('modal_paket_id').value = id;
    document.getElementById('modal_paket_nama').textContent = nama;
    document.getElementById('modal_paket_harga').textContent = 'Rp ' + harga.toLocaleString('id-ID');
    document.getElementById('addToCartModalPaket').classList.remove('hidden');
}

function closeAddToCartModalPaket() {
    document.getElementById('addToCartModalPaket').classList.add('hidden');
}
</script>
@endsection