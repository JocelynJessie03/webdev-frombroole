<?php $__env->startSection('content'); ?>

<div class="space-y-5">

    
    <div>
        <h1 class="text-[32px] font-black text-[#7b0000] leading-none mb-2">
            Product Inventory
        </h1>
        <p class="text-gray-600 text-sm max-w-3xl leading-relaxed">
            Manage your Broole products, monitor stock availability, and track inventory performance in real time.
        </p>
    </div>

    
    <div class="grid grid-cols-3 gap-4">
        
        <div class="bg-white rounded-2xl border p-5 shadow-sm">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>
                </div>
                <div class="bg-[#f7dede] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    +4.2%
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Products
            </p>
            <h2 class="text-4xl font-black text-[#7b0000]">
                <?php echo e($totalProducts); ?>

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
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
                <div class="bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Total Value
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Product Value
            </p>
            <h2 class="text-4xl font-black">
                Rp <?php echo e(number_format($totalValue, 0, ',', '.')); ?>

            </h2>
        </div>
    </div>

    
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
        
        <div class="p-5 flex justify-between items-center border-b">
            
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">
                <a href="<?php echo e(route('product.inventory')); ?>" 
                   class="<?php echo e(!request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                    All
                </a>
                <a href="<?php echo e(route('product.inventory', ['filter' => 'low_stock'])); ?>" 
                   class="<?php echo e(request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                    Low Stock
                </a>
                <a href="<?php echo e(route('product.inventory', ['filter' => 'out_of_stock'])); ?>" 
                   class="<?php echo e(request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out of Stock
                </a>
            </div>

            
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('products.create')); ?>"
                   class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add Product
                </a>
            </div>
        </div>

        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">Product</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">SKU</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Category</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Price</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Stock</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Status</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <img src="<?php echo e($product->pro_image ? asset('products/' . $product->pro_image) : 'https://placehold.co/100x100'); ?>" 
                                     class="w-12 h-12 rounded-xl object-cover">
                                <h3 class="font-bold text-base leading-tight"><?php echo e($product->pro_name); ?></h3>
                            </div>
                        </td>

                        <td class="px-4 py-5 text-gray-400 text-sm font-semibold">
                            <?php echo e($product->pro_ID); ?>

                        </td>

                        <td class="px-4 py-5 text-sm font-medium text-gray-700">
                            <?php if($product->category): ?>
                                <?php echo e($product->category->category_name); ?>

                            <?php else: ?>
                                <span class="text-gray-400 italic">Uncategorized</span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="px-4 py-5 font-black text-lg">
                            Rp <?php echo e(number_format($product->pro_price, 0, ',', '.')); ?>

                        </td>

                        <td class="px-4 py-5 text-lg font-black">
                            <?php echo e($product->calculated_stock); ?>

                        </td>

                        <td class="px-4 py-5">
                            <span class="<?php echo e($product->status_label == 'IN STOCK' ? 'bg-[#f8e9e9] text-[#7b0000]' : ($product->status_label == 'LOW STOCK' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-500')); ?> px-3 py-1 rounded-full text-xs font-bold">
                                <?php echo e($product->status_label); ?>

                            </span>
                        </td>
                        
                        <td class="px-4 py-5">
                            <div class="relative">
                                <button onclick="toggleDropdown(this)" class="text-gray-400 hover:text-black p-2 rounded-lg">
                                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                                </button>

                                <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                                    
                                    
                                    <?php
                                        $bomData = $product->ingredients->map(function($ing) {
                                            return $ing->name . ' (' . $ing->pivot->amount_needed . ' ' . $ing->unit . ')';
                                        })->toArray();
                                    ?>
                                    <button type="button"
                                            onclick="openBomModalFromDropdown(this)"
                                            data-title="<?php echo e($product->pro_name); ?>"
                                            data-ingredients="<?php echo e(json_encode($bomData)); ?>"
                                            class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="cooking-pot" class="w-4 h-4"></i>
                                        View BOM
                                    </button>

                                    
                                    <a href="<?php echo e(route('product.edit', $product->id)); ?>"
                                       class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        Edit Product
                                    </a>

                                    
                                        <button type="submit"
                                                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            Delete Product
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


<div id="bomModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="handleOutsideClick(event)">
    
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl border overflow-hidden flex flex-col max-h-[75vh]" onclick="event.stopPropagation()">
        
        
        <div class="p-6 border-b flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Bill of Materials (BOM)</h3>
                <p class="text-xs text-gray-500 mt-1" id="bomProductName">Product Name</p>
            </div>
            <button onclick="closeBomModal()" class="text-gray-400 hover:text-black p-2 rounded-xl hover:bg-gray-200 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        
        <div class="p-6 overflow-y-auto flex-1 space-y-3" id="bomIngredientsList">
            
        </div>

        
        <div class="p-4 bg-gray-50 border-t flex justify-end">
            <button onclick="closeBomModal()" class="bg-[#7b0000] hover:bg-[#650000] text-white px-5 py-2 rounded-xl font-bold text-sm transition">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    function toggleDropdown(button) {
        const dropdown = button.parentElement.querySelector('.action-dropdown');
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            if(menu !== dropdown) {
                menu.classList.add('hidden');
            }
        });
        dropdown.classList.toggle('hidden');
    }

    // Perbaikan Fungsi pemanggil Modal BOM agar sinkron dengan ID elemen terdaftar
    function openBomModalFromDropdown(button) {
        closeAllDropdown();

        const modal = document.getElementById('bomModal');
        const textProductName = document.getElementById('bomProductName');
        const container = document.getElementById('bomIngredientsList');

        // Menguraikan data resep dari tombol data-atribut
        const ingredients = JSON.parse(button.dataset.ingredients);
        textProductName.innerText = button.dataset.title;

        container.innerHTML = '';
        
        if(ingredients.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-center italic py-4">No recipe ingredients found for this product.</p>';
        } else {
            ingredients.forEach(item => {
                container.innerHTML += `
                    <div class="bg-[#faf7f7] rounded-[20px] px-5 py-4 border border-[#f1ebeb] flex items-center justify-between">
                        <p class="text-black text-sm font-bold tracking-tight leading-none">${item}</p>
                    </div>
                `;
            });
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeBomModal() {
        const modal = document.getElementById('bomModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function handleOutsideClick(e) {
        closeBomModal();
    }

    function closeAllDropdown() {
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            menu.classList.add('hidden');
        });
    }

    document.addEventListener('click', function(e) {
        if(!e.target.closest('.relative')) {
            closeAllDropdown();
        }
    });

    document.addEventListener('keydown', function(event) {
        if(event.key === 'Escape') {
            closeBomModal();
            closeAllDropdown();
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/product/inventory.blade.php ENDPATH**/ ?>