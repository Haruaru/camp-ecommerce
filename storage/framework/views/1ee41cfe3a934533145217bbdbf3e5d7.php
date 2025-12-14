<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard - X Adventure'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r shadow-sm fixed h-full overflow-y-auto z-10">
            <div class="p-6 border-b bg-gradient-to-r from-orange-500 to-orange-600">
                <img src="<?php echo e(asset('images/logo-xadventure-white.png')); ?>" alt="X Adventure" class="h-10 mb-2">
                <p class="text-sm text-orange-100">Dashboard Admin</p>
            </div>
            <nav class="p-4">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="<?php echo e(route('admin.kategori.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.kategori.*') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-tags w-5"></i>
                    <span>Kategori</span>
                </a>
                
                <a href="<?php echo e(route('admin.inventory.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.inventory.*') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-box w-5"></i>
                    <span>Peralatan</span>
                </a>
                
                <a href="<?php echo e(route('admin.paket.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.paket.*') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-box-open w-5"></i>
                    <span>Paket</span>
                </a>
                
                <!-- HAPUS PROMO -->
                
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span>Order</span>
                </a>
                
                <a href="<?php echo e(route('admin.reporting')); ?>" class="flex items-center gap-3 px-4 py-3 rounded mb-2 <?php echo e(request()->routeIs('admin.reporting') ? 'bg-orange-100 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'); ?>">
                    <i class="fas fa-file-alt w-5"></i>
                    <span>Reporting</span>
                </a>
            </nav>
            <div class="absolute bottom-6 left-6">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center gap-2 text-gray-600 hover:text-red-600 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                <span><i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?></span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                <span><i class="fas fa-exclamation-circle mr-2"></i><?php echo e(session('error')); ?></span>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\camp-ecommerce\rental_camping2\resources\views/layouts/admin.blade.php ENDPATH**/ ?>