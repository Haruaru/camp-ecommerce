@extends('layouts.user')

@section('title', 'Katalog Peralatan - X Adventure')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Katalog Peralatan</h1>
    <p class="text-gray-600 mb-8">Jumlah: {{ $peralatans->total() }} Produk</p>

    <!-- Filter Kategori -->
    <div class="mb-6">
        <form method="GET" action="{{ route('katalog.peralatan') }}">
            <div class="flex gap-2 overflow-x-auto pb-4">
                <a href="{{ route('katalog.peralatan') }}" class="px-4 py-2 {{ !request('kategori') ? 'bg-gray-800 text-white' : 'border border-gray-800 text-gray-800' }} rounded whitespace-nowrap">
                    Semua
                </a>
                @foreach($kategoris as $kategori)
                <a href="{{ route('katalog.peralatan') }}?kategori={{ $kategori->id_kategori }}" 
                   class="px-4 py-2 {{ request('kategori') == $kategori->id_kategori ? 'bg-gray-800 text-white' : 'border border-gray-800 text-gray-800' }} rounded hover:bg-gray-700 hover:text-white whitespace-nowrap transition">
                    {{ $kategori->label_kategori }}
                </a>
                @endforeach
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($peralatans as $alat)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <div class="relative h-48 bg-gray-300">
                @if($alat->gambar_alat)
                    <img src="{{ asset('storage/' . $alat->gambar_alat) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                @endif
                <span class="absolute top-2 left-2 px-3 py-1 rounded text-xs text-white {{ $alat->stok_alat > 0 ? 'bg-green-500' : 'bg-red-500' }}">
                    Stok: {{ $alat->stok_alat }}
                </span>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-lg mb-2">{{ $alat->nama_alat }}</h3>
                <p class="text-sm text-gray-600 mb-3">{{ $alat->kategori->label_kategori }}</p>
                <div class="text-orange-500 font-bold text-xl mb-4">
                    Rp {{ number_format($alat->harga_alat, 0, ',', '.') }}
                </div>
                <div class="flex gap-2">
                    @if($alat->stok_alat > 0)
                    <!-- UBAH DARI "Detail" JADI "Tambah" -->
                    <button onclick="showAddToCartModal({{ $alat->id_alat }}, '{{ $alat->nama_alat }}', {{ $alat->harga_alat }})" class="flex-1 border border-orange-500 text-orange-500 py-2 rounded text-sm hover:bg-orange-50">
                        Tambah
                    </button>
                    <button onclick="showAddToCartModal({{ $alat->id_alat }}, '{{ $alat->nama_alat }}', {{ $alat->harga_alat }})" class="flex-1 bg-orange-500 text-white py-2 rounded text-sm hover:bg-orange-600">
                        Sewa
                    </button>
                    @else
                    <button disabled class="w-full bg-gray-400 text-white py-2 rounded text-sm cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $peralatans->links() }}
    </div>
</div>

<!-- Modal Add to Cart -->
<div id="addToCartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-xl font-bold mb-4">Tambah ke Keranjang</h3>
        <form action="{{ route('keranjang.tambah') }}" method="POST">
            @csrf
            <input type="hidden" name="tipe" value="alat">
            <input type="hidden" name="id" id="modal_alat_id">
            
            <div class="mb-4">
                <p class="text-gray-700 font-semibold" id="modal_alat_nama"></p>
                <p class="text-orange-500 font-bold text-xl" id="modal_alat_harga"></p>
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
                <button type="button" onclick="closeAddToCartModal()" class="flex-1 bg-gray-500 text-white py-2 rounded hover:bg-gray-600">
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
function showAddToCartModal(id, nama, harga) {
    document.getElementById('modal_alat_id').value = id;
    document.getElementById('modal_alat_nama').textContent = nama;
    document.getElementById('modal_alat_harga').textContent = 'Rp ' + harga.toLocaleString('id-ID');
    document.getElementById('addToCartModal').classList.remove('hidden');
}

function closeAddToCartModal() {
    document.getElementById('addToCartModal').classList.add('hidden');
}
</script>
@endsection