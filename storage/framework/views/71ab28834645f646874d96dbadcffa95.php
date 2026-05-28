<?php $__env->startSection('content'); ?>


<div class="grid grid-cols-3 gap-8 items-start">

    
    
    
    <div class="col-span-2 space-y-8">

        
        <div class="bg-gradient-to-br from-[#7b0000] to-[#930000] rounded-[40px] p-10 text-white relative">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <p class="uppercase tracking-widest text-sm opacity-70">Sales Summary</p>
                    <p class="text-xs opacity-60 font-medium mt-0.5"><?php echo e($labelPeriode ?? 'Live Data'); ?></p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-1 flex gap-1 border border-white/10">
                    <a href="<?php echo e(url()->current()); ?>?view=daily" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all <?php echo e(($view ?? 'daily') === 'daily' ? 'bg-white text-[#7b0000] shadow-sm' : 'text-white opacity-60 hover:opacity-100'); ?>">Daily</a>
                    <a href="<?php echo e(url()->current()); ?>?view=monthly" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all <?php echo e(($view ?? 'daily') === 'monthly' ? 'bg-white text-[#7b0000] shadow-sm' : 'text-white opacity-60 hover:opacity-100'); ?>">Monthly</a>
                </div>
            </div>

            <h1 class="text-6xl font-black mb-8">Rp <?php echo e(number_format($totalSales, 0, ',', '.')); ?></h1>

            <div class="flex gap-5">
                <div class="bg-white/20 px-6 py-3 rounded-full text-base font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    <?php echo e($totalOrders); ?> Orders
                </div>
                <a href="<?php echo e(route('reports')); ?>" class="bg-white text-[#7b0000] px-8 py-3 rounded-2xl text-base font-bold hover:bg-gray-100 transition inline-flex items-center justify-center">View Reports</a>
                <a href="<?php echo e(route('pos')); ?>" class="bg-[#7b0000] border border-white text-white px-8 py-3 rounded-2xl text-base font-bold hover:bg-[#5e0000] transition inline-flex items-center justify-center">Go To POS</a>
            </div>
        </div>

        
        <div class="bg-white rounded-[40px] p-10 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-black">Performing Products</h2>
                    <p class="text-sm text-gray-500 mt-1">Top performing products by category</p>
                </div>
                <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 h-fit border border-gray-200/30">
                    <?php $__currentLoopData = $chartDataGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button onclick="switchCategory('<?php echo e($key); ?>')" 
                                id="btn-cat-<?php echo e($key); ?>" 
                                class="cat-tab px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer 
                                <?php echo e($key === 'all' ? 'bg-white text-[#7b0000] shadow-sm' : 'text-gray-400 hover:text-gray-600'); ?>">
                            <?php echo e($data['category_name']); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="w-full min-h-[280px] relative">
                <canvas id="storePerformanceChart"></canvas>
            </div>
        </div>

        
        <div class="bg-white rounded-[40px] p-10 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black">Ingredients Inventory Status</h2>
                    <p class="text-sm text-gray-500 mt-1">List of ingredients that need immediate attention</p>
                </div>
                <a href="<?php echo e(route('ingredient.inventory')); ?>" class="text-sm font-bold text-[#7b0000] hover:underline">View Inventory →</a>
            </div>

            <div class="h-[290px] overflow-y-auto pr-2 custom-scrollbar">
                <div class="grid grid-cols-3 gap-4">
                    <?php $__empty_1 = true; $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('ingredient.inventory')); ?>" class="border border-gray-100 rounded-2xl p-5 hover:shadow-lg transition block bg-white h-[130px]">
                        <p class="text-sm text-gray-500 mb-2 truncate" title="<?php echo e($ingredient->name); ?>"><?php echo e($ingredient->name); ?></p>
                        <p class="text-2xl font-black text-[#7b0000] mb-3"><?php echo e($ingredient->stock); ?> <span class="text-sm font-normal text-gray-500"><?php echo e($ingredient->unit); ?></span></p>
                        <span class="text-[10px] tracking-wider uppercase font-bold px-3 py-1 rounded-full inline-block <?php if($ingredient->stock <= 5): ?> bg-red-100 text-red-600 <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                            <?php echo e($ingredient->stock <= 5 ? 'CRITICAL' : 'LOW STOCK'); ?>

                        </span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 py-12 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <p class="text-sm font-bold text-gray-400">All ingredients are currently safe! ✨</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-[40px] p-10 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black">Product Inventory Status</h2>
                    <p class="text-sm text-gray-500 mt-1">List of products that are running low based on recipe availability</p>
                </div>
                <a href="<?php echo e(route('product.inventory')); ?>" class="text-sm font-bold text-[#7b0000] hover:underline">View Products →</a>
            </div>

            <div class="h-[290px] overflow-y-auto pr-2 custom-scrollbar">
                <div class="grid grid-cols-3 gap-4">
                    <?php $__empty_1 = true; $__currentLoopData = $lowStocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('product.inventory')); ?>" class="border border-gray-100 rounded-2xl p-5 hover:shadow-lg transition flex items-center gap-5 bg-white h-[130px]">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#f5f5f5] flex items-center justify-center shrink-0 border border-gray-50">
                            <?php if($product->pro_image): ?>
                                <img src="<?php echo e(asset('products/' . $product->pro_image)); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">NO IMG</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <h3 class="font-bold text-base truncate" title="<?php echo e($product->pro_name); ?>"><?php echo e($product->pro_name); ?></h3>
                                    <p class="text-[#7b0000] font-black text-xl mt-1"><?php echo e($product->calculated_stock); ?> <span class="text-xs font-normal text-gray-400">left</span></p>
                                </div>
                                <span class="text-[10px] tracking-wider uppercase font-bold px-4 py-1.5 rounded-full shrink-0 <?php if($product->calculated_stock <= 0): ?> bg-red-100 text-red-600 <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                                    <?php echo e($product->calculated_stock <= 0 ? 'OUT' : 'LOW STOCK'); ?>

                                </span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-12 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <p class="text-sm font-bold text-gray-400">All products are ready to serve! 🎂</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    
    
    
    <div class="col-span-1">
        
        
        <div class="bg-white rounded-[40px] p-8 pb-10 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-black">Recent Orders</h2>
                    <p class="text-xs text-gray-400 mt-1">Showing the last 10 transactions</p>
                </div>
                <a href="<?php echo e(route('order_history')); ?>" class="text-sm font-bold text-[#7b0000] hover:underline shrink-0">View All →</a>
            </div>

            
            <div class="overflow-y-auto pr-2 custom-scrollbar h-[1550px]">
                <div class="space-y-5">
                    <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('order_history')); ?>" class="block border border-gray-100 rounded-3xl p-5 hover:shadow-lg transition bg-white">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">ORDER ID</p>
                                <h3 class="font-black text-lg text-gray-800"><?php echo e($order->order_id); ?></h3>
                            </div>
                            <span class="px-4 py-2 rounded-full text-xs font-bold <?php if($order->status == 'Complete'): ?> bg-green-100 text-green-700 <?php elseif($order->status == 'Pending'): ?> bg-yellow-100 text-yellow-700 <?php else: ?> bg-red-100 text-red-600 <?php endif; ?>">
                                <?php echo e(strtoupper($order->status)); ?>

                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                            <div>
                                <p class="text-sm text-gray-600 font-bold"><?php echo e($order->customer->customer_name ?? 'Guest Customer'); ?></p>
                                <p class="text-xs text-gray-400 mt-0.5"><?php echo e(\Carbon\Carbon::parse($order->order_date)->format('d M Y H:i')); ?></p>
                            </div>
                            <p class="text-xl font-black text-[#7b0000]">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></p>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-12 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <p class="text-sm font-bold text-gray-400">No orders today yet ☕</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>


<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.02);
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(123, 0, 0, 0.2);
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(123, 0, 0, 0.5);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let storeChartInstance = null;
const globalChartData = <?php echo json_encode($chartDataGroup, 15, 512) ?>;

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('storePerformanceChart');
    if (!ctx) return;

    const initialLabels = globalChartData.all.labels;
    const initialValues = globalChartData.all.values;

    storeChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: initialLabels,
            datasets: [{
                label: 'Units Sold',
                data: initialValues,
                backgroundColor: '#7b0000',
                hoverBackgroundColor: '#930000',
                borderRadius: 12,
                borderSkipped: false,
                barThickness: 26
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0, 0, 0, 0.04)' },
                    ticks: { stepSize: 1, font: { weight: 'bold' } }
                },
                y: {
                    grid: { display: false },
                    ticks: { font: { weight: 'bold', size: 13 }, color: '#1f2937' }
                }
            }
        }
    });
});

function switchCategory(categoryKey) {
    if (!storeChartInstance || !globalChartData[categoryKey]) return;

    // Ambil data labels & values dari key yang dipilih
    const targetData = globalChartData[categoryKey];

    storeChartInstance.data.labels = targetData.labels;
    storeChartInstance.data.datasets[0].data = targetData.values;
    storeChartInstance.update();

    // Reset style semua button
    document.querySelectorAll('.cat-tab').forEach(btn => {
        btn.classList.remove('bg-white', 'text-[#7b0000]', 'shadow-sm');
        btn.classList.add('text-gray-400');
    });

    // Aktifkan style button yang sedang diklik
    const activeBtn = document.getElementById(`btn-cat-${categoryKey}`);
    if (activeBtn) {
        activeBtn.classList.remove('text-gray-400');
        activeBtn.classList.add('bg-white', 'text-[#7b0000]', 'shadow-sm');
    }
}
</script>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/dashboard.blade.php ENDPATH**/ ?>