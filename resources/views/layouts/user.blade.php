<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'X Adventure')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-orange-500 text-white p-4 sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <button onclick="toggleMenu()" class="text-white">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo-xadventure.png') }}" alt="X Adventure" class="h-10">
            </a>
            <a href="{{ route('keranjang.index') }}" class="text-white relative">
                <i class="fas fa-shopping-cart text-2xl"></i>
            </a>
        </div>
    </header>

    <!-- Sidebar Menu -->
    <div id="sidebar" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white w-64 h-full p-6">
            <button onclick="toggleMenu()" class="mb-6 text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <nav class="space-y-4">
                <a href="{{ route('home') }}" class="block text-gray-800 hover:text-orange-500 font-semibold">Beranda</a>
                <a href="{{ route('katalog.paket') }}" class="block text-gray-800 hover:text-orange-500">Katalog Paket</a>
                <a href="{{ route('katalog.peralatan') }}" class="block text-gray-800 hover:text-orange-500">Katalog Peralatan</a>
                <a href="{{ route('tentang-kami') }}" class="block text-gray-800 hover:text-orange-500">Tentang Kami</a>
                
                <hr class="my-4">
                <p class="text-xs text-gray-500 font-bold uppercase">Informasi</p>
                <a href="{{ route('kebijakan.privasi') }}" class="block text-gray-600 hover:text-orange-500 text-sm">Kebijakan Privasi</a>
                <a href="{{ route('syarat.ketentuan') }}" class="block text-gray-600 hover:text-orange-500 text-sm">Syarat dan Ketentuan</a>
                <a href="{{ route('kebijakan.peminjaman') }}" class="block text-gray-600 hover:text-orange-500 text-sm">Kebijakan Peminjaman</a>
                
                <hr class="my-4">
                <p class="text-xs text-gray-500 font-bold uppercase">Proses</p>
                <a href="{{ route('proses.pembayaran') }}" class="block text-gray-600 hover:text-orange-500 text-sm">Proses Pembayaran</a>
                <a href="{{ route('proses.pengambilan') }}" class="block text-gray-600 hover:text-orange-500 text-sm">Proses Pengambilan</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-orange-500 text-white p-6 mt-12">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo-xadventure-white.png') }}" alt="X Adventure" class="h-12">
                    </div>
                    <p class="text-sm mb-4">Deskripsi brand rangkaian: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et tortor fringilla consequat tempor elit, sed ut ultrices magna augue mauris.</p>
                    <div class="space-y-2">
                        <p class="text-sm flex items-center gap-2">
                            <i class="fas fa-phone"></i> Tel 0896-0897-8986 (Ervina)
                        </p>
                        <p class="text-sm flex items-center gap-2">
                            <i class="fas fa-envelope"></i> instagram.com/@xadventure
                        </p>
                        <p class="text-sm flex items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i> Jln Serma Ny I Gusti Ngurah Rai No 74100, Badung
                        </p>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-bold mb-4">X Adventure</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('tentang-kami') }}" class="hover:underline">Tentang Kami</a></li>
                                <li><a href="{{ route('katalog.paket') }}" class="hover:underline">Alat Alat Kami</a></li>
                                <li><a href="{{ route('kebijakan.peminjaman') }}" class="hover:underline">Layanan Pelanggan (Kebijakan)</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold mb-4">Pusat Bantuan</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('proses.pembayaran') }}" class="hover:underline">Proses Pembayaran</a></li>
                                <li><a href="{{ route('proses.pengambilan') }}" class="hover:underline">Proses Pengambilan Peralatan</a></li>
                                <li><a href="{{ route('kebijakan.privasi') }}" class="hover:underline">Kebijakan Privasi</a></li>
                                <li><a href="{{ route('syarat.ketentuan') }}" class="hover:underline">Syarat dan Ketentuan</a></li>
                                <li><a href="#" class="hover:underline">Beri Kami Masukan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-xs mt-6 pt-6 border-t border-white/20">
                Copyright © {{ date('Y') }}. All rights reserved
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('sidebar').classList.toggle('hidden');
        }
    </script>
</body>
</html>