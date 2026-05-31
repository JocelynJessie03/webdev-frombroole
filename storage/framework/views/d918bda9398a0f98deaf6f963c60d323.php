<?php $__env->startSection('content'); ?>

<div class="space-y-5">
    <div class="bg-white rounded-2xl border p-6 shadow-sm mb-5">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Ingredient Usage Analytics</h3>
                <p class="text-xs text-gray-400">
                    Showing <span id="chartCount" class="font-bold text-black">0</span> <span id="unitName">all</span> ingredients listed in inventory last 5 days
                </p>
            </div>
            
            
            <div id="chartFilterGroup" class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 text-xs font-bold shrink-0">
                <button onclick="filterChart('gr')" class="chart-filter-btn text-gray-500 hover:text-black px-4 py-1.5 rounded-lg transition">GR</button>
                <button onclick="filterChart('ml')" class="chart-filter-btn text-gray-500 hover:text-black px-4 py-1.5 rounded-lg transition">ML</button>
                <button onclick="filterChart('pcs')" class="chart-filter-btn text-gray-500 hover:text-black px-4 py-1.5 rounded-lg transition">PCS</button>
            </div>
        </div>
        
        <div class="w-full overflow-x-auto no-scrollbar">
            <div class="relative min-w-[700px] h-[260px]">
                <canvas id="usageChart"></canvas>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-3 gap-4">

        
        <div class="bg-white rounded-2xl border p-5 shadow-sm">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>
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
                
                <?php if(request('filter') == 'out_of_stock'): ?>
                    
                    <div class="w-12 h-12 rounded-xl <?php echo e($outOfStockCount > 0 ? 'bg-red-50' : 'bg-gray-50'); ?> flex items-center justify-center transition-colors">
                        <i data-lucide="info" class="w-5 h-5 <?php echo e($outOfStockCount > 0 ? 'text-red-600' : 'text-gray-400'); ?>"></i>
                    </div>
                    <?php if($outOfStockCount > 0): ?>
                        <div class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full animate-pulse">
                            Empty Stock
                        </div>
                    <?php endif; ?>
                
                <?php elseif(request('filter') == 'low_stock'): ?>
                    
                    <div class="w-12 h-12 rounded-xl <?php echo e($lowStockCount > 0 ? 'bg-amber-50' : 'bg-gray-50'); ?> flex items-center justify-center transition-colors">
                        <i data-lucide="triangle-alert" class="w-5 h-5 <?php echo e($lowStockCount > 0 ? 'text-amber-500' : 'text-gray-400'); ?>"></i>
                    </div>
                    <?php if($lowStockCount > 0): ?>
                        <div class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                            Monitor Stock
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <?php
                        $totalWarningCount = $lowStockCount + $outOfStockCount;
                        // Prioritaskan style visual Merah jika minimal ada 1 barang Out of Stock
                        $isCritical = $outOfStockCount > 0;
                    ?>
                    
                    <div class="w-12 h-12 rounded-xl <?php echo e($totalWarningCount > 0 ? ($isCritical ? 'bg-red-50' : 'bg-amber-50') : 'bg-gray-50'); ?> flex items-center justify-center transition-colors">
                        <i data-lucide="<?php echo e($isCritical ? 'info' : 'triangle-alert'); ?>" class="w-5 h-5 <?php echo e($totalWarningCount > 0 ? ($isCritical ? 'text-red-600' : 'text-amber-500') : 'text-gray-400'); ?>"></i>
                    </div>
                    <?php if($totalWarningCount > 0): ?>
                        <div class="<?php echo e($isCritical ? 'bg-red-100 text-red-700 animate-pulse' : 'bg-amber-100 text-amber-700'); ?> text-xs font-bold px-3 py-1 rounded-full">
                            <?php echo e($isCritical ? 'Action Needed' : 'Monitor Stock'); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            
            </div>

            
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                <?php if(request('filter') == 'out_of_stock'): ?>
                    Out Of Stock
                <?php elseif(request('filter') == 'low_stock'): ?>
                    Low Stock
                <?php else: ?>
                    Stock Warnings
                <?php endif; ?>
            </p>

            <h2 class="text-4xl font-black text-black">
                <?php if(request('filter') == 'out_of_stock'): ?>
                    <?php echo e($outOfStockCount); ?>

                <?php elseif(request('filter') == 'low_stock'): ?>
                    <?php echo e($lowStockCount); ?>

                <?php else: ?>
                    <?php echo e($lowStockCount + $outOfStockCount); ?>

                <?php endif; ?>
            </h2>
        </div>

        
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i data-lucide="activity" class="w-5 h-5 text-white"></i>
                </div>
                
                <?php if($usedTodayCount > 0): ?>
                    <div class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full border border-white/30">
                        Active Kitchen
                    </div>
                <?php else: ?>
                    <div class="bg-white/10 text-white/50 text-xs font-bold px-3 py-1 rounded-full">
                        No Activity
                    </div>
                <?php endif; ?>
            </div>
            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Used Today
            </p>
            <h2 class="text-4xl font-black">
                <?php echo e($usedTodayCount); ?> <span class="text-lg font-normal text-white/70">Items</span>
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

                <a href="<?php echo e(route('ingredient.inventory', ['filter' => 'out_of_stock'])); ?>" 
                class="<?php echo e(request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500'); ?> px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out Of Stock
                </a>
            </div>

            
            <div class="bg-[#f6f3f1] rounded-xl px-4 py-2.5 flex items-center gap-3 w-[280px] focus-within:ring-2 focus-within:ring-[#7b0000]/20 transition">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search product..." 
                       class="bg-transparent outline-none w-full text-sm font-plain text-gray-700 placeholder-gray-400">
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
                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">Ingredient</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Stock</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Unit</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Status</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Action</th>
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
                            <?php if($ingredient->stock <= 0): ?>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    OUT OF STOCK
                                </span>
                            <?php elseif($ingredient->is_low_stock): ?>
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    LOW STOCK
                                </span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    IN STOCK
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-4 py-5">
                            <div class="relative">
                                <button onclick="toggleDropdown(this)" class="text-gray-400 hover:text-black p-2 rounded-lg hover:bg-gray-100 transition">
                                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                                </button>
                                
                                <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                                    <a href="<?php echo e(route('ingredient.edit', $ingredient->id)); ?>" class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>Edit Ingredient
                                    </a>

                                    <form action="<?php echo e(route('ingredient.destroy', $ingredient->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete <?php echo e($ingredient->name); ?>?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>Delete Ingredient
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
    function toggleDropdown(button) {
        const dropdown = button.parentElement.querySelector('.action-dropdown');
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            if(menu !== dropdown) menu.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) {
            const spaceBelow = window.innerHeight - button.getBoundingClientRect().bottom;
            if (spaceBelow < 160) {
                dropdown.classList.replace('top-12', 'bottom-full');
                dropdown.classList.add('mb-2');
            } else {
                dropdown.classList.replace('bottom-full', 'top-12');
                dropdown.classList.remove('mb-2');
            }
        }
    }

    document.addEventListener('click', (e) => {
        if(!e.target.closest('.relative')) {
            document.querySelectorAll('.action-dropdown').forEach(m => m.classList.add('hidden'));
        }
    });

    // MASTER STORAGE DATA YANG BERASAL DARI DATABASE INGREDIENTS
    let myChartInstance = null;
    const masterChartData = {
        labels: <?php echo json_encode($usageData['labels'] ?? []); ?>,
        values: <?php echo json_encode($usageData['values'] ?? []); ?>,
        units: <?php echo json_encode($usageData['units'] ?? []); ?>

    };

    // FUNGSI AKTIVITAS FILTER & HITUNG LIVE JUMLAH DATA
    function filterChart(unitFilter) {
        // 1. Ubah visual status tombol filter aktif
        document.querySelectorAll('.chart-filter-btn').forEach(btn => {
            if(btn.getAttribute('onclick').includes(`'${unitFilter}'`)) {
                btn.className = "chart-filter-btn bg-white shadow text-[#7b0000] px-4 py-1.5 rounded-lg transition";
            } else {
                btn.className = "chart-filter-btn text-gray-500 hover:text-black px-4 py-1.5 rounded-lg transition";
            }
        });

        // 2. Filter data array secara akurat per unit masing-masing
        let filteredLabels = [];
        let filteredValues = [];

        if (unitFilter === 'all') {
            filteredLabels = [...masterChartData.labels];
            filteredValues = [...masterChartData.values];
        } 
        else {
            for (let i = 0; i < masterChartData.units.length; i++) {
                if (masterChartData.units[i] === unitFilter) {
                    filteredLabels.push(masterChartData.labels[i]);
                    filteredValues.push(masterChartData.values[i]);
                }
            }
        }

        // 3. Tulis jumlah produk terhitung ke teks sub-judul HTML
        const countElement = document.getElementById('chartCount');
        const unitNameElement = document.getElementById('unitName');
        if (countElement) {
            countElement.innerText = filteredLabels.length;
            unitNameElement.innerText = unitFilter === 'all' ? 'all' : `"${unitFilter.toUpperCase()}"`;
        }

        // Fallback jika data kosong agar chart tidak crash
        if(filteredLabels.length === 0) {
            filteredLabels = ['No Data'];
            filteredValues = [0];
        }

        // 4. Update data Chart secara Real-time ke Canvas
        if (myChartInstance) {
            myChartInstance.data.labels = filteredLabels;
            myChartInstance.data.datasets[0].data = filteredValues;
            myChartInstance.update();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        
        // --- A. FILTER OTOMATIS DARI SEARCH UTAMA ---
        const itemToHighlight = new URLSearchParams(window.location.search).get('highlight');
        if (itemToHighlight) {
            const targetWord = itemToHighlight.toLowerCase().trim();
            
            // 1. Isi otomatis kotak pencarian lokal agar user tahu data sedang difilter
            const localSearchInput = document.getElementById('searchInput');
            if (localSearchInput) {
                localSearchInput.value = itemToHighlight;
            }

            // 2. Loop semua baris tabel: sembunyikan yang tidak cocok
            document.querySelectorAll('tbody tr').forEach(row => {
                const nameElement = row.querySelector('h3');
                if (nameElement && nameElement.textContent.trim().toLowerCase().includes(targetWord)) {
                    row.style.display = ""; // Tampilkan baris
                    
                    // Opsional: Beri efek highlight kuning sejenak, lalu hilangkan
                    row.style.backgroundColor = '#fef08a';
                    row.style.transition = 'background-color 1s ease';
                    setTimeout(() => { row.style.backgroundColor = 'transparent'; }, 1500);
                } else {
                    row.style.display = "none"; // Sembunyikan baris yang tidak cocok
                }
            });
        }

        // --- B. LIVE SEARCH INGREDIENT LOKAL ---
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(row => {
                    const productName = row.cells[0]?.textContent.toLowerCase() || "";
                    row.style.display = productName.includes(filter) ? "" : "none";
                });
            });
        }

        // --- C. INISIALISASI AWAL CHART (LOAD ALL DATA SEBAGAI DEFAULT) ---
        const canvasElement = document.getElementById('usageChart');
        if (canvasElement) {
            const ctx = canvasElement.getContext('2d');
            myChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [...masterChartData.labels],
                    datasets: [{
                        label: 'Total Used (5 Days)',
                        data: [...masterChartData.values],
                        backgroundColor: '#7b0000',
                        hoverBackgroundColor: '#920000',
                        borderRadius: 6,
                        borderSkipped: 'bottom',
                        barThickness: 'flex',
                        maxBarThickness: 32
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 0, 0, 0.04)' },
                            ticks: { font: { size: 11 }, color: '#9ca3af' }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 11, weight: '700' }, color: '#1f2937' }
                        }
                    }
                }
            });
            filterChart('gr');
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/ingredient/inventory.blade.php ENDPATH**/ ?>