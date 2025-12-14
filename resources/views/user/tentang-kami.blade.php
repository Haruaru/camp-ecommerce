@extends('layouts.user')

@section('title', 'Tentang Kami - X Adventure')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="relative h-64 bg-cover bg-center rounded-lg mb-8" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=1200')">
        <div class="absolute inset-0 flex items-center justify-center text-white">
            <h1 class="text-5xl font-bold">Tentang Kami</h1>
        </div>
    </div>

    <!-- Siapa Kami -->
    <section class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold mb-4">Siapa Kami</h2>
        <p class="text-gray-700 leading-relaxed">
            X Adventure adalah penyedia layanan penyewaan peralatan outdoor terlengkap dan terpercaya di Indonesia. 
            Kami memahami bahwa setiap petualangan membutuhkan persiapan yang matang dan peralatan yang tepat. 
            Dengan pengalaman lebih dari 5 tahun melayani para petualang, kami berkomitmen untuk menyediakan 
            peralatan berkualitas tinggi dengan harga yang terjangkau.
        </p>
    </section>

    <!-- Visi -->
    <section class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold mb-4">Visi</h2>
        <p class="text-gray-700 leading-relaxed">
            Menjadi perusahaan penyewaan peralatan outdoor nomor satu di Indonesia yang dipercaya oleh 
            para petualang untuk mendukung setiap perjalanan mereka dengan peralatan berkualitas dan 
            layanan terbaik.
        </p>
    </section>

    <!-- Misi -->
    <section class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold mb-4">Misi</h2>
        <ul class="space-y-3 text-gray-700">
            <li class="flex items-start">
                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                <span>Menyediakan peralatan outdoor berkualitas tinggi dengan harga yang kompetitif</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                <span>Memberikan pelayanan terbaik kepada setiap pelanggan</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                <span>Mendukung gaya hidup sehat dan cinta alam</span>
            </li>
        </ul>
    </section>

    
</div>
@endsection