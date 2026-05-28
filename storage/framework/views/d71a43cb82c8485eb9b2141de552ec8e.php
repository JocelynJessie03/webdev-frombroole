<?php $__env->startSection('content'); ?>

<div class="space-y-5">

    
    <div>

        <h1 class="text-[32px] font-black text-[#7b0000] leading-none mb-2">
            Ingredient Inventory
        </h1>

        <p class="text-gray-600 text-sm max-w-3xl leading-relaxed">
            Manage your ingredient stock, monitor raw material availability, and track kitchen inventory in real time.
        </p>

    </div>



    
    <div class="grid grid-cols-3 gap-4">

        
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>
                </div>

                <div class="bg-[#f7dede] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    +2.1%
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Ingredients
            </p>

            <h2 class="text-4xl font-black text-[#7b0000]">
                <?php echo e($totalIngredients); ?>

            </h2>

        </div>



        
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#fff3f3] flex items-center justify-center">
                    <i data-lucide="triangle-alert" class="w-5 h-5 text-red-600"></i>
                </div>

                <div class="bg-[#ffdede] text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                    Attention Required
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Low Stock
            </p>

            <h2 class="text-4xl font-black text-black">
                <?php echo e($lowStockCount); ?>

            </h2>

        </div>



        
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i data-lucide="warehouse" class="w-5 h-5"></i>
                </div>

                <div class="bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Storage
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Inventory Status
            </p>

            <h2 class="text-4xl font-black">
                Stable
            </h2>

        </div>

    </div>



        
        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

            
            <div class="p-5 flex justify-between items-center border-b">

                
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">

            
            <a href="<?php echo e(route('ingredient.inventory')); ?>" 
            class="<?php echo e(!request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                All
            </a>

            
            <a href="<?php echo e(route('ingredient.inventory', ['filter' => 'low_stock'])); ?>" 
            class="<?php echo e(request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                Low Stock
            </a>

            
            <a href="<?php echo e(route('ingredient.inventory', ['filter' => 'packaging'])); ?>" 
            class="<?php echo e(request('filter') == 'packaging' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                Packaging
            </a>

    </div>



            
            <div class="flex items-center gap-3">
    <a href="<?php echo e(route('ingredient.create')); ?>"
       class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Add Ingredient
    </a>
</div>

        </div>



        
        <div class="overflow-x-auto">

            <table class="w-full">

                
                <thead>

                    <tr class="text-left border-b">

                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Ingredient
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Stock
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Unit
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Status
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Action
                        </th>

                    </tr>

                </thead>



        
        <tbody>

        <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b last:border-0 hover:bg-gray-50 transition">

                
                <td class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-[#f8e9e9] flex items-center justify-center">
                            <i data-lucide="package-2" class="w-5 h-5 text-[#7b0000]"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base leading-tight">
                                <?php echo e($ingredient->name); ?>

                            </h3>
                        </div>
                    </div>
                </td>

                
                <td class="px-4 py-5 text-lg font-black">
                    <?php echo e(number_format($ingredient->stock)); ?>

                </td>

                
                <td class="px-4 py-5 text-sm font-semibold text-gray-500 uppercase">
                    <?php echo e($ingredient->unit); ?>

                </td>

                
                <td class="px-4 py-5">
                    <?php if($ingredient->is_low_stock): ?>
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                            LOW STOCK
                        </span>
                    <?php else: ?>
                        <span class="bg-[#f8e9e9] text-[#7b0000] px-3 py-1 rounded-full text-xs font-bold">
                            IN STOCK
                        </span>
                    <?php endif; ?>
                </td>


                
                <td class="px-4 py-5">
                    <div class="relative">

                
                <button
                    onclick="toggleDropdown(this)"
                    class="text-gray-400 hover:text-black p-2 rounded-lg hover:bg-gray-100 transition">
                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                    </button>
                        
                        <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                            
                                    
                                    <a href="<?php echo e(route('ingredient.edit', $ingredient->id)); ?>"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        Edit Ingredient
                                    </a>



                                    
                                    
                                        <button type="submit"
                                        class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        Delete Ingredient
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>

        </div>

    </div>

</div>



<script>

    function toggleDropdown(button)
    {
        const dropdown = button.parentElement.querySelector('.action-dropdown');

        document.querySelectorAll('.action-dropdown').forEach(menu =>
        {
            if(menu !== dropdown)
            {
                menu.classList.add('hidden');
            }
        });

        dropdown.classList.toggle('hidden');
    }



    function closeAllDropdown()
    {
        document.querySelectorAll('.action-dropdown').forEach(menu =>
        {
            menu.classList.add('hidden');
        });
    }



    document.addEventListener('click', function(e)
    {
        if(!e.target.closest('.relative'))
        {
            closeAllDropdown();
        }
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/ingredient/inventory.blade.php ENDPATH**/ ?>