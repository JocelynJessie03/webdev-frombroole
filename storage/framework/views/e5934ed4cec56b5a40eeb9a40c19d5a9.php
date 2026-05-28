<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">

    
    <div class="mb-10 flex items-center gap-5">

        
        <a href="<?php echo e(route('ingredient.inventory')); ?>" 
           class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-[#7b0000] hover:border-[#7b0000] hover:shadow-sm transition-all group">
            <i data-lucide="arrow-left" class="w-6 h-6 transition-transform group-hover:-translate-x-1"></i>
        </a>

        <div>
            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                Edit Ingredient
            </h1>
        </div>

    </div>

    
    <div class="bg-white rounded-3xl border shadow-sm p-10">

        <form action="<?php echo e(route('ingredient.update', $ingredient->id)); ?>"
              method="POST"
              class="space-y-8">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div>
                <label class="block text-xl mb-3 font-bold text-gray-700">
                    Ingredient Name
                </label>
                <input
                    type="text"
                    name="name"
                    required
                    value="<?php echo e(old('name', $ingredient->name)); ?>"
                    placeholder="e.g. Fresh Milk, Matcha Powder"
                    class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                >
            </div>

            
            <div class="grid grid-cols-2 gap-6">

                
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Current Stock
                    </label>
                    <input
                        type="number"
                        name="stock"
                        required
                        min="0"
                        step="0.01"
                        value="<?php echo e(old('stock', $ingredient->stock)); ?>"
                        placeholder="e.g. 5000"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                    >
                </div>

                
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Measurement Unit
                    </label>
                    <select 
                        name="unit" 
                        required 
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] bg-white transition"
                    >
                        <option value="" disabled>Select Unit</option>
                        <option value="gr" <?php echo e(old('unit', $ingredient->unit) == 'gr' ? 'selected' : ''); ?>>Gram (gr)</option>
                        <option value="ml" <?php echo e(old('unit', $ingredient->unit) == 'ml' ? 'selected' : ''); ?>>Mililiter (ml)</option>
                        <option value="pcs" <?php echo e(old('unit', $ingredient->unit) == 'pcs' ? 'selected' : ''); ?>>Pieces (pcs)</option>
                    </select>
                </div>

            </div>

            
            <div class="pt-4">
                <button
                    type="submit"
                    class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2"
                >
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Ingredient
                </button>
            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/ingredient/edit.blade.php ENDPATH**/ ?>