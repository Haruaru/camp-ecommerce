<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - X Adventure</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" 
      style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1200')">
    
    <div class="bg-white/95 backdrop-blur-sm p-8 rounded-lg shadow-2xl w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 text-orange-500 mb-4">
                <span class="text-4xl font-bold">X</span>
                <span class="text-xl">ADVENTURE</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-gray-600 mt-2">Masukkan email dan password</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                    Email
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                    placeholder="admin@xadventure.com"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                    Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                    placeholder="Masukkan password"
                >
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
                    >
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">
                    Registrasi
                </a>
            </div>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition duration-200 shadow-lg hover:shadow-xl"
            >
                Login
            </button>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-orange-500">
                    ← Kembali ke Beranda
                </a>
            </div>
        </form>

      
    </div>
</body>
</html>