<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - X Adventure</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" 
      style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1200')">
    
    <div class="bg-white/95 backdrop-blur-sm p-8 rounded-lg shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Lupa Password?</h2>
            <p class="text-gray-600 mt-2">Masukkan email Anda untuk reset password</p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="#" class="space-y-6">
            @csrf

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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500"
                    placeholder="Masukkan email Anda"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600"
            >
                Kirim Link Reset Password
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-orange-500">
                    ← Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</body>
</html>