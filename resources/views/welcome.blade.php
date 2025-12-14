<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Adventure - Rental Peralatan Camping</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-orange-500 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-xadventure-white.png') }}" alt="X Adventure" class="h-10">
            </div>
            
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="hover:text-orange-200 transition">Beranda</a>
                <a href="{{ route('katalog.paket') }}" class="hover:text-orange-200 transition">Katalog Paket</a>
                <a href="{{ route('katalog.peralatan') }}" class="hover:text-orange-200 transition">Katalog Peralatan</a>
                <a href="{{ route('tentang-kami') }}" class="hover:text-orange-200 transition">Tentang Kami</a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-white text-orange-500 px-4 py-2 rounded-lg font-semibold hover:bg-orange-100 transition">
                        Dashboard Admin
                    </a>
                @else
                @endauth
            </nav>

            <button class="md:hidden">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1920')">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-6xl md:text-8xl font-bold mb-6">
                    X ADVENTURE
                </h1>
                <p class="text-2xl md:text-3xl mb-8">
                    Rental Peralatan Camping & Outdoor Terlengkap
                </p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ route('katalog.paket') }}" class="bg-orange-500 text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-orange-600 transition shadow-lg">
                        Lihat Paket
                    </a>
                    <a href="{{ route('katalog.peralatan') }}" class="bg-white text-orange-500 px-8 py-4 rounded-lg text-lg font-bold hover:bg-gray-100 transition shadow-lg">
                        Lihat Peralatan
                    </a>
                    @guest
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-bold text-center mb-12">Kenapa Pilih Kami?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md text-center hover:shadow-xl transition">
                <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-orange-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Peralatan Berkualitas</h3>
                <p class="text-gray-600">Semua peralatan dijamin berkualitas tinggi dan terawat dengan baik</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md text-center hover:shadow-xl transition">
                <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tag text-orange-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Harga Terjangkau</h3>
                <p class="text-gray-600">Harga sewa yang kompetitif dengan berbagai pilihan paket hemat</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md text-center hover:shadow-xl transition">
                <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-orange-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Pelayanan 24/7</h3>
                <p class="text-gray-600">Customer service siap membantu Anda kapan saja</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-orange-500 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Siap untuk Petualangan Anda?</h2>
            <p class="text-xl mb-8">Sewa peralatan camping terbaik sekarang juga!</p>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('katalog.paket') }}" class="bg-white text-orange-500 px-8 py-4 rounded-lg text-lg font-bold hover:bg-gray-100 transition">
                    Mulai Sewa
                </a>    
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">X ADVENTURE</h3>
                    <p class="text-gray-400">Penyedia peralatan outdoor terlengkap untuk petualangan Anda</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Hubungi Kami</h4>
                    <p class="text-gray-400"><i class="fas fa-phone mr-2"></i> 0896-0000-0000</p>
                    <p class="text-gray-400"><i class="fas fa-envelope mr-2"></i> xadventure@gmail.com</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500">Beranda</a></li>
                        <li><a href="{{ route('katalog.paket') }}" class="hover:text-orange-500">Katalog Paket</a></li>
                        <li><a href="{{ route('tentang-kami') }}" class="hover:text-orange-500">Tentang Kami</a></li>
                        @guest
                        <li><a href="{{ route('login') }}" class="hover:text-orange-500">Login Admin</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                Copyright © {{ date('Y') }} X Adventure. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
