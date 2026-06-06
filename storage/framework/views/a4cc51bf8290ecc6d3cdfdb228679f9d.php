<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    /* Sedikit custom warna biar matching sama tema merah maroon kamu */
    .flatpickr-day.selected, .flatpickr-day.selected:hover {
        background: #7b0000 !important;
        border-color: #7b0000 !important;
    }
</style>

<?php $__env->startSection('content'); ?>

<div class="space-y-4">

    
    <div class="flex justify-between items-start">
        <div>
            
            
            
            <button onclick="exportReportToCSV()" class="bg-[#7b0000] hover:bg-[#650000] text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow transition cursor-pointer">
                <i data-lucide="download" class="w-4 h-4"></i>
                <span class="font-semibold text-sm">
                    Export CSV
                </span>
            </button>
        </div>

        
        <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 h-fit">
            <a href="<?php echo e(url()->current()); ?>?view=daily" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold <?php echo e($view === 'daily' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500'); ?>">
                Daily
            </a>
            <a href="<?php echo e(url()->current()); ?>?view=weekly" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold <?php echo e($view === 'weekly' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500'); ?>">
                Weekly
            </a>
            <a href="<?php echo e(url()->current()); ?>?view=monthly" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold <?php echo e($view === 'monthly' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500'); ?>">
                Monthly
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl border p-4 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="wallet" class="w-5 h-5 text-[#7b0000]"></i>
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-2">Total Revenue</p>
            <h2 class="text-[28px] font-black text-[#7b0000] leading-none">
                Rp <?php echo e(number_format($totalRevenue ?? 0,0,',','.')); ?>

            </h2>
        </div>

        <div class="bg-white rounded-2xl border p-4 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#eef2e3] flex items-center justify-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-[#7f8b67]"></i>
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-2">Total Orders</p>
            <h2 class="text-[28px] font-black leading-none">
                <?php echo e(number_format($totalOrders ?? 0)); ?>

            </h2>
        </div>
    </div>

    
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3 bg-white rounded-2xl border p-5 shadow-sm relative flex flex-col justify-between">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-[18px] font-black">Revenue Performance</h2>
                    <span class="text-xs bg-red-50 text-[#7b0000] px-2 py-1 rounded-md font-semibold mt-1 inline-block">
                        <?php if($view === 'daily'): ?>
                            📅 Operational Date :  <?php echo e($startDate); ?>

                        <?php elseif($view === 'monthly'): ?>
                            📅 Month Data :  <?php echo e(date('F Y', strtotime($startDate . '-01'))); ?>

                        <?php else: ?>
                            📅 Range (the last 7 days): <?php echo e(date('d M Y', strtotime($startDate))); ?> s/d <?php echo e(date('d M Y', strtotime($endDate))); ?>

                        <?php endif; ?>
                    </span>
                </div>
                <button id="btnViewDetails" class="text-[#7b0000] text-sm font-bold flex items-center gap-2 hover:opacity-80 transition-all">
                    Time Filter <i data-lucide="calendar" class="w-4 h-4"></i>
                </button>
            </div>

            
            <div id="filterDateContainer" class="hidden absolute top-[70px] left-5 right-5 z-10 bg-white p-4 rounded-xl border border-gray-200 shadow-xl transition-all">
                <form id="filterForm" action="<?php echo e(url()->current()); ?>" method="GET" class="flex flex-col gap-3">
                    <input type="hidden" name="view" id="activeTabInput" value="<?php echo e($view); ?>">
                    <div id="dateInputGrid" class="grid grid-cols-2 gap-4">
                        <div id="startInputWrapper">
                            <label id="labelStart" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Start Date</label>
                            <input type="text" name="start_date" id="startDateInput" value="<?php echo e($startDate); ?>" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:border-[#7b0000]">
                        </div>
                        <div id="endInputWrapper">
                            <label id="labelEnd" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">End Date (Auto Lock 7 Days)</label>
                            <input type="text" name="end_date" id="endDateInput" value="<?php echo e($endDate); ?>" class="w-full border rounded-lg p-2 text-sm bg-gray-50 readonly pointer-events-none">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="submit" class="bg-[#7b0000] text-white text-xs font-bold px-4 py-2 rounded-lg hover:opacity-90">Apply Filter</button>
                    </div>
                </form>
            </div>

            <div class="flex-1 min-h-[250px] mt-2">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        
        <div class="space-y-4 flex flex-col justify-between">
            
            
            <div class="bg-white rounded-2xl border p-4 shadow-sm flex flex-col h-[220px]">
                <div class="mb-2">
                    <h2 class="text-[16px] font-black leading-tight">Products Sold</h2>
                    <p class="text-[11px] text-gray-400 font-medium">Based on selected time filter</p>
                </div>
                
                <div class="space-y-3 flex-1 max-h-[120px] overflow-y-auto pr-1" style="scrollbar-width: thin; scrollbar-color: #7b0000 #f1eded;">
                    <?php if($productsSold->count() > 0): ?>
                        <?php $__currentLoopData = $productsSold; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $percentage = ($product->total_sold / $maxSold) * 100;
                            ?>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-bold text-xs leading-tight text-gray-800 truncate max-w-[150px]"><?php echo e($product->product_name); ?></h3>
                                    <span class="font-bold text-gray-600 text-[11px]"><?php echo e(number_format($product->total_sold)); ?> sold</span>
                                </div>
                                <div class="bg-[#f1eded] h-1.5 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full bg-[#8b0000]" style="width: <?php echo e($percentage); ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="text-center py-4 text-gray-400 text-xs">
                            <i data-lucide="shopping-bag" class="w-5 h-5 mx-auto mb-1 opacity-40"></i>
                            <p class="font-medium text-gray-500">No products sold</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border p-4 shadow-sm flex flex-col h-[220px]">
                <div class="mb-2">
                    <h2 class="text-[16px] font-black leading-tight">Top Categories</h2>
                    <p class="text-[11px] text-gray-400 font-medium">Most popular categories</p>
                </div>

                <div class="space-y-3 flex-1 max-h-[120px] overflow-y-auto pr-1" style="scrollbar-width: thin; scrollbar-color: #7b0000 #f1eded;">
                    <?php if(isset($topCategories) && $topCategories->count() > 0): ?>
                        <?php 
                            $maxCategorySold = $topCategories->first()->total_qty ?? 1; 
                        ?>
                        <?php $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $catPercentage = ($category->total_qty / $maxCategorySold) * 100;
                            ?>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-bold text-xs leading-tight text-gray-800 truncate max-w-[150px]"><?php echo e($category->category_name); ?></h3>
                                    <span class="font-bold text-gray-500 text-[11px]"><?php echo e(number_format($category->total_qty)); ?> items</span>
                                </div>
                                <div class="bg-[#f1eded] h-1.5 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full bg-[#7f8b67]" style="width: <?php echo e($catPercentage); ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="text-center py-4 text-gray-400 text-xs">
                            <i data-lucide="tag" class="w-5 h-5 mx-auto mb-1 opacity-40"></i>
                            <p class="font-medium text-gray-500">No category data</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('revenueChart');
    if(!ctx) return;

    const dailyData = { labels: <?php echo json_encode($dailyLabelsJson, 15, 512) ?>, values: <?php echo json_encode($dailyTotalsJson, 15, 512) ?> };
    const weeklyData = { labels: <?php echo json_encode($weeklyLabelsJson, 15, 512) ?>, values: <?php echo json_encode($weeklyTotalsJson, 15, 512) ?> };
    const monthlyData = { labels: <?php echo json_encode($monthlyLabelsJson, 15, 512) ?>, values: <?php echo json_encode($monthlyTotalsJson, 15, 512) ?> };

    const btnViewDetails = document.getElementById('btnViewDetails');
    const filterContainer = document.getElementById('filterDateContainer');
    const activeTabInput = document.getElementById('activeTabInput');
    const startDateInput = document.getElementById('startDateInput');
    const endDateInput = document.getElementById('endDateInput');
    const filterForm = document.getElementById('filterForm');
    
    const currentView = "<?php echo e($view); ?>";

    let initialLabels = weeklyData.labels;
    let initialValues = weeklyData.values;
    let chartType = 'line'; 

    if (currentView === 'daily') {
        initialLabels = dailyData.labels; 
        initialValues = dailyData.values; 
        chartType = 'line';
    } else if (currentView === 'monthly') {
        initialLabels = monthlyData.labels; 
        initialValues = monthlyData.values; 
        chartType = 'line';
    }

    let pickerConfig = {
        allowInput: true,
        dateFormat: "Y-m-d",
    };

    if (currentView === 'monthly') {
        pickerConfig = {
            allowInput: true,
            dateFormat: "Y-m",
            altInput: true,
            altFormat: "m-Y",
            plugins: [
                new monthSelectPlugin({
                    shorthand: true, 
                    dateFormat: "Y-m", 
                    altFormat: "m-Y"
                })
            ]
        };
    }

    let startPicker = flatpickr(startDateInput, pickerConfig);
    
    if (currentView === 'weekly') {
        flatpickr(endDateInput, { dateFormat: "Y-m-d" });

        startDateInput.addEventListener('change', function() {
            if (this.value) {
                let start = new Date(this.value);
                start.setDate(start.getDate() + 6); 
                
                let yyyy = start.getFullYear();
                let mm = String(start.getMonth() + 1).padStart(2, '0');
                let dd = String(start.getDate()).padStart(2, '0');
                endDateInput.value = `${yyyy}-${mm}-${dd}`;
            }
        });
    }

    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            if (activeTabInput.value === 'monthly') {
                let val = startDateInput.value.trim();
                if (val.includes('-')) {
                    let parts = val.split('-');
                    if (parts[0].length <= 2 && parts[1].length === 4) {
                        let month = parts[0].padStart(2, '0');
                        let year = parts[1];
                        startDateInput.value = `${year}-${month}`;
                    }
                }
            }
        });
    }

    // DRAW CHART JS
    window.currentChartData = { labels: initialLabels, values: initialValues }; // Simpan ke global scope untuk export
    let revenueChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: initialLabels,
            datasets: [{
                label: 'Revenue',
                data: initialValues,
                borderColor: '#8b0000',
                backgroundColor: 'rgba(139, 0, 0, 0.1)', 
                fill: true, 
                tension: 0.4, 
                pointBackgroundColor: '#8b0000',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: currentView === 'daily' ? 2 : (currentView === 'weekly' ? 5 : 3),
                borderWidth: 3 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    grid: { color: 'rgba(0, 0, 0, 0.04)' },
                    ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } }
                },
                x: { grid: { display: false } }
            }
        }
    });

    const labelStart = document.getElementById('labelStart');
    const endWrapper = document.getElementById('endInputWrapper');
    const gridContainer = document.getElementById('dateInputGrid');

    if (currentView === 'daily') {
        if(labelStart) labelStart.innerText = 'PILIH TANGGAL KAS';
        if(endWrapper) endWrapper.classList.add('hidden');
        if(gridContainer) gridContainer.classList.replace('grid-cols-2', 'grid-cols-1');
    } else if (currentView === 'monthly') {
        if(labelStart) labelStart.innerText = 'KETIK / PILIH BULAN (MM-YYYY)';
        if(endWrapper) endWrapper.classList.add('hidden');
        if(gridContainer) gridContainer.classList.replace('grid-cols-2', 'grid-cols-1');
    } else {
        if(labelStart) labelStart.innerText = 'START DATE';
        if(endWrapper) endWrapper.classList.remove('hidden');
        if(gridContainer) gridContainer.classList.replace('grid-cols-1', 'grid-cols-2');
    }

    if(btnViewDetails && filterContainer) {
        btnViewDetails.addEventListener('click', function (e) { e.preventDefault(); filterContainer.classList.toggle('hidden'); });
    }
});

// ==========================================
// FUNGSI CLIENT-SIDE EXPORT CSV UNTUK REPORT
// ==========================================
function exportReportToCSV() {
    let csv = [];
    
    // 1. Tambahkan Metadata Summary Block
    csv.push('"--- SUMMARY REPORT ---"');
    csv.push('"Filter Periode","' + "<?php echo e(strtoupper($view)); ?>" + '"');
    csv.push('"Total Revenue","' + "<?php echo e($totalRevenue ?? 0); ?>" + '"');
    csv.push('"Total Orders","' + "<?php echo e($totalOrders ?? 0); ?>" + '"');
    csv.push(""); // Baris Kosong

    // 2. Tambahkan Data Grafik Performa Keuangan
    csv.push('"--- REVENUE PERFORMANCE TREND ---"');
    csv.push('"Waktu / Tanggal","Revenue (Rp)"');
    if (window.currentChartData && window.currentChartData.labels) {
        for (let i = 0; i < window.currentChartData.labels.length; i++) {
            csv.push('"' + window.currentChartData.labels[i] + '","' + window.currentChartData.values[i] + '"');
        }
    }
    csv.push(""); 

    // 3. Tambahkan Data Produk Terjual (Diambil dari Object JSON Backend)
    csv.push('"--- PRODUCTS SOLD RANKING ---"');
    csv.push('"Product Name","Quantity Sold"');
    const productsData = <?php echo json_encode($productsSold, 15, 512) ?>;
    if(productsData && productsData.length > 0) {
        productsData.forEach(p => {
            csv.push('"' + p.product_name + '","' + p.total_sold + '"');
        });
    } else {
        csv.push('"No data available","0"');
    }
    csv.push("");

    // 4. Tambahkan Data Kategori Terpopuler
    csv.push('"--- TOP CATEGORIES ---"');
    csv.push('"Category Name","Items Sold"');
    const categoriesData = <?php echo json_encode($topCategories ?? [], 15, 512) ?>;
    if(categoriesData && categoriesData.length > 0) {
        categoriesData.forEach(c => {
            csv.push('"' + c.category_name + '","' + c.total_qty + '"');
        });
    } else {
        csv.push('"No data available","0"');
    }

    // Proses download berkas CSV langsung di browser
    let csvFile = new Blob([csv.join("\n")], { type: "text/csv;charset=utf-8;" });
    let downloadLink = document.createElement("a");
    let viewName = "<?php echo e($view); ?>";
    downloadLink.download = "Business_Report_" + viewName.toUpperCase() + "_" + "<?php echo e($startDate); ?>" + ".csv";
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/reports.blade.php ENDPATH**/ ?>