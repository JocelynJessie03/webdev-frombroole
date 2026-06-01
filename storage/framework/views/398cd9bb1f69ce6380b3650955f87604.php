<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">

    
    <div class="mb-10 flex items-center gap-5">
        
        <a href="<?php echo e(route('products.create')); ?>" 
           class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-[#7b0000] hover:border-[#7b0000] hover:shadow-sm transition-all group">
            <i data-lucide="arrow-left" class="w-6 h-6 transition-transform group-hover:-translate-x-1"></i>
        </a>

        <div>
            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                New Category
            </h1>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl border shadow-sm p-10">
        <form action="<?php echo e(route('categories.store')); ?>" method="POST" class="space-y-8">
            <?php echo csrf_field(); ?>
            
            <div>
                <label class="block text-xl mb-3 font-bold text-gray-700">
                    Category Name
                </label>
                <input
                    type="text"
                    name="category_name"
                    required
                    placeholder="e.g. Broole Series"
                    class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                >
            </div>

            <div class="pt-4 flex gap-4">
                <button
                    type="submit"
                    class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2"
                >
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Save Category
                </button>
            </div>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/categories/create.blade.php ENDPATH**/ ?>