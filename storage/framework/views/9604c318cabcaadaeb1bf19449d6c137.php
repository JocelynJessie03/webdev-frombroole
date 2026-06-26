<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">

    
    <div class="mb-10 flex items-center gap-5">
        
        <a href="<?php echo e(route('product.inventory')); ?>" 
           class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-[#7b0000] hover:border-[#7b0000] hover:shadow-sm transition-all group">
            <i data-lucide="arrow-left" class="w-6 h-6 transition-transform group-hover:-translate-x-1"></i>
        </a>

        <div>
            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                Edit Product
            </h1>
        </div>
    </div>

    
    
        <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl flex items-center gap-3 animate-pulse">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                <svg xmlns="http://www.w3.org/2000/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12" y1="16" y2="16.01"/></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-red-800">Validation Error!</p>
                <p class="text-xs text-red-600"><?php echo e(session('error')); ?></p>
            </div>
        </div>
        <?php endif; ?>
    <div class="bg-white rounded-3xl border shadow-sm p-10">
        <form action="<?php echo e(route('product.update', $product->id)); ?>"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-3 gap-8">
                
                
                <div class="col-span-2 space-y-6">
                    
                    <div>
                        <label class="block text-xl mb-3 font-bold text-gray-700">Product Name</label>
                        <input type="text" name="pro_name" required
                               value="<?php echo e(old('pro_name', $product->pro_name)); ?>"
                               placeholder="e.g. Ice Matcha Latte"
                               class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition">
                    </div>

                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xl mb-3 font-bold text-gray-700">Category</label>
                            <select name="category_id" required 
                                    class="w-full h-14 border border-gray-300 rounded-xl px-5 bg-white outline-none focus:border-[#7b0000] transition">
                                <option value="" disabled>Select Category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->category_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xl mb-3 font-bold text-gray-700">Price (IDR)</label>
                            <input type="number" name="pro_price" required
                                   value="<?php echo e(old('pro_price', $product->pro_price)); ?>"
                                   placeholder="e.g. 25000"
                                   class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition">
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-xl mb-3 font-bold text-gray-700">Description</label>
                        <textarea name="pro_description" rows="4" 
                                  placeholder="Write product description here..."
                                  class="w-full border border-gray-300 rounded-xl p-5 outline-none focus:border-[#7b0000] transition"><?php echo e(old('pro_description', $product->pro_description)); ?></textarea>
                    </div>
                </div>

                
                <div class="col-span-1">
                    <label class="block text-xl mb-3 font-bold text-gray-700">Product Image</label>
                    <div class="border border-dashed border-gray-300 rounded-2xl p-5 text-center bg-gray-50 flex flex-col items-center justify-center min-h-[280px]">
                        
                        <?php if($product->pro_image): ?>
                            <img src="<?php echo e(asset('products/' . $product->pro_image)); ?>" alt="Preview" class="w-32 h-32 object-cover rounded-xl mb-3 shadow-sm">
                        <?php else: ?>
                            <i data-lucide="image" class="w-12 h-12 text-gray-400 mb-3"></i>
                        <?php endif; ?>

                        <input type="file" name="pro_image" class="text-sm text-gray-500 mt-2
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-[#f7ecec] file:text-[#7b0000]
                            hover:file:bg-[#edf2f7] transition cursor-pointer">
                        <p class="text-xs text-gray-400 mt-2">JPG, JPEG, or PNG (Max 2MB)</p>
                    </div>
                </div>

            </div>

            <hr class="border-gray-100">

            
            <div>
                <h3 class="text-2xl font-black text-[#7b0000] mb-2">Recipe Configuration (BOM)</h3>
                <p class="text-sm text-gray-500 mb-6">Specify the amount of ingredients required to make one unit of this product.</p>

                <div class="grid grid-cols-2 gap-4 max-h-[300px] overflow-y-auto pr-2 entries-scroll-container">
                    <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            // Cek apakah ingredient ini sudah terdaftar di resep produk ini sebelumnya
                            $pivotData = $product->ingredients->firstWhere('id', $ingredient->id);
                            $amountNeeded = $pivotData ? $pivotData->pivot->amount_needed : 0;
                        ?>

                        <div class="flex items-center justify-between p-4 bg-gray-50 border rounded-xl hover:border-gray-300 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-white border flex items-center justify-center shadow-sm">
                                    <i data-lucide="package-2" class="w-5 h-5 text-gray-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm leading-tight"><?php echo e($ingredient->name); ?></h4>
                                    <span class="text-xs text-gray-400 uppercase font-semibold">Unit: <?php echo e($ingredient->unit); ?></span>
                                </div>
                            </div>

                            <div class="w-32 flex items-center gap-2 bg-white border rounded-lg px-3 py-1.5 focus-within:border-[#7b0000] transition">
                                <input type="number" 
                                       name="ingredients[<?php echo e($ingredient->id); ?>]" 
                                       min="0" 
                                       step="1"
                                       value="<?php echo e(old('ingredients.'.$ingredient->id, $amountNeeded)); ?>"
                                       placeholder="0"
                                       class="w-full text-right outline-none text-sm font-bold text-gray-800">
                                <span class="text-xs text-gray-400 font-bold uppercase"><?php echo e($ingredient->unit); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                        class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Product & Recipe
                </button>
            </div>

        </form>

    </div>

</div>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const categorySelect = document.querySelector('select[name="category_id"]');
        
        if (categorySelect && categorySelect.selectedIndex > 0) {
            const categoryName = categorySelect.options[categorySelect.selectedIndex].text.toLowerCase();
            
            // Cek jika kategori adalah Drink / Minuman
            if (categoryName.includes('drink') || categoryName.includes('minuman')) {
                let hasSugar = false;
                const inputs = document.querySelectorAll('input[name^="ingredients["]');
                
                inputs.forEach(input => {
                    if (!input.disabled && parseFloat(input.value) > 0) {
                        const card = input.closest('.ingredient-card') || input.closest('div.flex'); 
                        if (card && (card.textContent.toLowerCase().includes('sugar') || card.textContent.toLowerCase().includes('gula'))) {
                            hasSugar = true;
                        }
                    }
                });

                // Jika Sugar tidak di-add / diisi
                if (!hasSugar) {
                    e.preventDefault(); // Batalkan submit form
                    
                    // Beri alert pop-up informatif
                    alert('⚠️ PERINGATAN REVALIASI:\nProduk dengan kategori Minuman (Drinks) WAJIB mencentang dan mengisi takaran untuk bahan baku "Sugar" atau "Gula"!');
                    
                    // Opsional: Arahkan layar otomatis fokus ke select kategori agar user tahu area yang bermasalah
                    categorySelect.focus();
                    categorySelect.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/product/edit.blade.php ENDPATH**/ ?>