@extends('layouts.admin')

@section('title', 'Paket Management')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Paket </h1>
    <a href="{{ route('admin.paket.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 flex items-center gap-2 shadow-lg transition">
        <i class="fas fa-plus"></i>
        <span>Tambah Paket</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($pakets as $paket)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $paket->nama_paket }}</h3>
                    @php
                        $status = $paket->status->first();
                    @endphp
                    <span class="px-3 py-1 rounded text-xs text-white {{ $status && $status->status_ketersediaan == 'Available' ? 'bg-green-500' : 'bg-gray-500' }}">
                        {{ $status ? $status->status_ketersediaan : 'Unknown' }}
                    </span>
                </div>
            </div>

            <div class="mb-4 border-t pt-4">
                <p class="text-sm text-gray-600 font-semibold mb-2">Isi Paket:</p>
                <ul class="text-sm text-gray-600 space-y-1 max-h-32 overflow-y-auto">
                    @foreach($paket->peralatan as $alat)
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>{{ $alat->nama_alat }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="text-orange-500 font-bold text-2xl mb-4 border-t pt-4">
                Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.paket.edit', $paket->id_paket) }}" class="flex-1 bg-blue-500 text-white py-2 rounded text-center hover:bg-blue-600 transition font-semibold">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form action="{{ route('admin.paket.destroy', $paket->id_paket) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 transition font-semibold">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
        <p class="text-xl text-gray-500">Belum ada paket</p>
        <a href="{{ route('admin.paket.create') }}" class="inline-block mt-4 bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
            Tambah Paket Pertama
        </a>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $pakets->links() }}
</div>
@endsection