<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - X Adventure</title>
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
            <h2 class="text-3xl font-bold text-gray-800">Registrasi</h2>
            <p class="text-gray-600 mt-2">Registrasi Dulu, yaa!</p>
        </div>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Register Form -->
        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                    Nama Lengkap
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="<?php echo e(old('name')); ?>"
                    required 
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                    placeholder="Masukkan nama lengkap"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                    Email
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="<?php echo e(old('email')); ?>"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                    placeholder="Masukkan email Anda"
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
                <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">
                    Konfirmasi Password
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                    placeholder="Ulangi password"
                >
            </div>

            <!-- Register Button -->
            <button 
                type="submit" 
                class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition duration-200 shadow-lg hover:shadow-xl"
            >
                Registrasi
            </button>

            <!-- Login Link -->
            <div class="text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline font-semibold">
                    Login disini
                </a>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-600 hover:text-orange-500">
                    ← Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\camp-ecommerce\rental_camping2\resources\views/auth/register.blade.php ENDPATH**/ ?>