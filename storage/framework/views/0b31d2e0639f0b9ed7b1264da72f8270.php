

<?php $__env->startSection('title', 'Katalog Paket - X Adventure'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Katalog Paket</h1>
    <p class="text-gray-600 mb-8">Jumlah: <?php echo e($pakets->count()); ?> Produk</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php $__currentLoopData = $pakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <div class="relative h-48 bg-gray-300">
                <img src="<?php echo e(asset('storage/' . ($paket->gambar_paket ?? 'placeholder.jpg'))); ?>" alt="<?php echo e($paket->nama_paket); ?>" class="w-full h-full object-cover">
                <?php
                    $status = $paket->status->first();
                ?>
                <span class="absolute top-2 left-2 px-3 py-1 rounded text-xs text-white <?php echo e($status && $status->status_ketersediaan == 'Available' ? 'bg-green-500' : 'bg-gray-500'); ?>">
                    <?php echo e($status ? $status->status_ketersediaan : 'Unknown'); ?>

                </span>
            </div>
            <div class="p-4">
                <div class="bg-gray-800 text-white text-center py-2 mb-3 font-bold">
                    <?php echo e(strtoupper($paket->nama_paket)); ?>

                </div>
                <div class="text-sm text-gray-600 mb-2">
                    <?php $__currentLoopData = $paket->peralatan->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        • <?php echo e($alat->nama_alat); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="text-orange-500 font-bold text-xl mb-4">
                    Rp <?php echo e(number_format($paket->harga_paket, 0, ',', '.')); ?>

                </div>
                <div class="flex gap-2">
                    <a href="<?php echo e(route('paket.detail', $paket->id_paket)); ?>" class="flex-1 border border-orange-500 text-orange-500 py-2 rounded text-center hover:bg-orange-50">
                        Detail
                    </a>
                    <button class="flex-1 bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                        Sewa
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\camp-ecommerce\rental_camping2\resources\views/user/katalog-paket.blade.php ENDPATH**/ ?>