@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 flex items-center gap-2 shadow-lg transition">
        <i class="fas fa-plus"></i>
        <span>Tambah Kategori</span>
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gradient-to-r from-orange-500 to-orange-600 text-white">
                <th class="px-6 py-4 text-left text-sm font-bold uppercase">ID</th>
                <th class="px-6 py-4 text-left text-sm font-bold uppercase">Gambar</th>
                <th class="px-6 py-4 text-left text-sm font-bold uppercase">Nama Kategori</th>
                <th class="px-6 py-4 text-left text-sm font-bold uppercase">Jumlah Produk</th>
                <th class="px-6 py-4 text-left text-sm font-bold uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($kategoris as $kategori)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-semibold text-gray-700">{{ $kategori->id_kategori }}</td>
                <td class="px-6 py-4">
                    @if($kategori->gambar_kategori)
                        <img src="{{ asset('storage/' . $kategori->gambar_kategori) }}" alt="{{ $kategori->label_kategori }}" class="w-16 h-16 object-cover rounded-lg shadow">
                    @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-xl"></i>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $kategori->label_kategori }}</td>
                <td class="px-6 py-4">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $kategori->peralatan_count }} produk
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-5xl mb-4 text-gray-300"></i>
                    <p class="text-lg">Belum ada kategori</p>
                    <a href="{{ route('admin.kategori.create') }}" class="inline-block mt-4 bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                        Tambah Kategori Pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $kategoris->links() }}
</div>
@endsection