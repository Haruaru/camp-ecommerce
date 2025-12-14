

<?php $__env->startSection('title', 'Edit Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo e(route('admin.kategori.index')); ?>" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Kategori</h1>
    </div>

    <form action="<?php echo e(route('admin.kategori.update', $kategori->id_kategori)); ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="label_kategori" 
                required 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                value="<?php echo e(old('label_kategori', $kategori->label_kategori)); ?>"
            >
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Gambar Kategori
            </label>
            
            <?php if($kategori->gambar_kategori): ?>
            <div class="mb-4">
                <img src="<?php echo e(asset('storage/' . $kategori->gambar_kategori)); ?>" alt="<?php echo e($kategori->label_kategori); ?>" class="w-32 h-32 object-cover rounded-lg">
                <p class="text-xs text-gray-500 mt-2">Gambar saat ini</p>
            </div>
            <?php endif; ?>
            
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-orange-500 transition">
                <input 
                    type="file" 
                    name="gambar_kategori" 
                    accept="image/*"
                    class="hidden"
                    id="gambar_kategori"
                    onchange="previewImage(event)"
                >
                <label for="gambar_kategori" class="cursor-pointer">
                    <div id="preview-container" class="hidden mb-4">
                        <img id="preview" class="w-32 h-32 object-cover rounded-lg mx-auto">
                    </div>
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Klik untuk upload gambar baru</p>
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </label>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="<?php echo e(route('admin.kategori.index')); ?>" class="flex-1 bg-gray-500 text-white py-3 rounded-lg text-center hover:bg-gray-600 transition font-semibold">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition font-semibold">
                <i class="fas fa-save mr-2"></i>Update Kategori
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('preview-container');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\camp-ecommerce\rental_camping2\resources\views/admin/kategori/edit.blade.php ENDPATH**/ ?>