@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Produk -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Produk</p>
                    <h3 class="text-4xl font-bold text-gray-800">{{ $totalProduk ?? 0 }}</h3>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-box text-blue-500 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pesanan</p>
                    <h3 class="text-4xl font-bold text-gray-800">{{ $totalPesanan ?? 0 }}</h3>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <i class="fas fa-shopping-cart text-green-500 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pendapatan</p>
                    <h3 class="text-4xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-orange-100 p-4 rounded-full">
                    <i class="fas fa-dollar-sign text-orange-500 text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="mt-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-md p-8 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, Admin! 👋</h2>
        <p class="text-orange-100">Kelola sistem X Adventure dengan mudah dari dashboard ini.</p>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.inventory.create') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition text-center">
            <i class="fas fa-plus-circle text-4xl text-blue-500 mb-3"></i>
            <p class="font-semibold text-gray-800">Tambah Peralatan</p>
        </a>
        <a href="{{ route('admin.paket.create') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition text-center">
            <i class="fas fa-box-open text-4xl text-green-500 mb-3"></i>
            <p class="font-semibold text-gray-800">Tambah Paket</p>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition text-center">
            <i class="fas fa-shopping-cart text-4xl text-purple-500 mb-3"></i>
            <p class="font-semibold text-gray-800">Lihat Pesanan</p>
        </a>
        <a href="{{ route('admin.reporting') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition text-center">
            <i class="fas fa-chart-bar text-4xl text-orange-500 mb-3"></i>
            <p class="font-semibold text-gray-800">Laporan</p>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Aktivitas Terbaru</h2>
        <div class="space-y-4">
            <div class="flex items-center justify-between py-3 border-b">
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i class="fas fa-shopping-bag text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Pesanan baru masuk</p>
                        <p class="text-sm text-gray-500">5 menit yang lalu</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">Baru</span>
            </div>
            <div class="flex items-center justify-between py-3 border-b">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-box text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Stok peralatan diperbarui</p>
                        <p class="text-sm text-gray-500">30 menit yang lalu</p>
                    </div>
                </div>
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">Update</span>
            </div>
            <div class="flex items-center justify-between py-3">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-100 p-2 rounded-full">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">User baru mendaftar</p>
                        <p class="text-sm text-gray-500">1 jam yang lalu</p>
                    </div>
                </div>
                <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-semibold">Info</span>
            </div>
        </div>
    </div>
</div>
@endsection