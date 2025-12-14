

<?php $__env->startSection('title', 'Order Management'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-bold mb-8">Order Management</h1>

<!-- Filter -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form action="<?php echo e(route('admin.orders.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-bold mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="<?php echo e(request('tanggal')); ?>" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-orange-500">
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
        </div>
    </form>
</div>

<!-- Orders List -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-4 border-b bg-gray-50">
        <h2 class="font-bold text-lg">Daftar Transaksi</h2>
    </div>
    
    <div class="divide-y">
        <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="p-4 hover:bg-gray-50">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <p class="font-bold text-lg mb-2">Pesanan #<?php echo e($pesanan->id_pesanan); ?></p>
                    <div class="text-sm text-gray-600 space-y-1">
                        <?php $__currentLoopData = $pesanan->keranjangBelanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p>• <?php echo e($item->paket ? $item->paket->nama_paket : $item->alat->nama_alat); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        <?php echo e($pesanan->created_at->format('d/m/Y H:i')); ?>

                    </p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-xl text-orange-500 mb-2">
                        Rp <?php echo e(number_format($pesanan->keranjangBelanja->sum(function($item) {
                            return $item->paket ? $item->paket->harga_paket : $item->alat->harga_alat;
                        }), 0, ',', '.')); ?>

                    </p>
                    <a href="<?php echo e(route('admin.orders.show', $pesanan->id_pesanan)); ?>" class="text-blue-500 hover:underline text-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="p-8 text-center text-gray-500">
            Tidak ada pesanan
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    <?php echo e($pesanans->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\camp-ecommerce\rental_camping2\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>