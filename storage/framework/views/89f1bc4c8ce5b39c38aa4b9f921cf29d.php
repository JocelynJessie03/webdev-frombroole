<?php $__env->startSection('content'); ?>

<div class="space-y-4">

    
    <div class="flex justify-between items-start">

        <div>

            <h1 class="text-3xl font-black text-[#1b1b1b] mb-1">
                Order History
            </h1>

            <p class="text-gray-500 text-sm">
                Track and manage all transactions from your POS terminals.
            </p>

        </div>

        <button class="bg-[#7b0000] hover:bg-[#650000] text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow">

            <i data-lucide="download" class="w-4 h-4"></i>

            <span class="font-semibold text-sm">
                Export CSV
            </span>

        </button>

    </div>



    
    <div class="grid grid-cols-3 gap-3">

        
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#f7ebeb] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="receipt" class="w-4 h-4 text-[#7b0000]"></i>
            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
            Total Orders
            </p>

            <h2 class="text-3xl font-black">
                <?php echo e(number_format($stats['total'])); ?>

            </h2>

        </div>


        
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#eaf8ef] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-green-600"></i>
            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
            Completed
            </p>

            <h2 class="text-3xl font-black">
                <?php echo e(number_format($stats['completed'])); ?>

            </h2>

        </div>


        
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#fff6e8] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="clock-3" class="w-4 h-4 text-yellow-600"></i>
            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                Pending
            </p>

            <h2 class="text-3xl font-black">
                <?php echo e(number_format($stats['pending'])); ?>

            </h2>

        </div>

    </div>



    
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

         
        <div class="p-4 flex justify-between items-center border-b">

            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[340px]">

                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>

                <input
                id="searchInput"
                type="text"
                placeholder="Search order or customer..."
                class="bg-transparent outline-none w-full text-sm"
                >

            </div>

            <div class="flex gap-2">
                <div class="relative flex items-center border px-4 py-2 rounded-xl gap-2 font-medium text-sm">
                    <i data-lucide="filter" class="w-4 h-4 text-gray-500"></i>
                        <select id="statusFilter" class="bg-transparent outline-none cursor-pointer appearance-none pr-4">
                            <option value="all">All Status</option>
                            <option value="completed">Completed</option> 
                            <option value="pending">Pending</option>
                        </select>
                </div>
                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">
                    <i data-lucide="clock-3" class="w-4 h-4"></i>
                    Date
                </button>
            </div>
        </div>




        
        <table class="w-full">

            <thead class="bg-[#faf7f5]">

                <tr class="text-left text-gray-400 uppercase tracking-widest text-[10px]">

                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Items</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Action</th>

                </tr>

            </thead>

            <tbody>

<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="border-t hover:bg-gray-50 transition">
        <td class="px-6 py-5 font-bold text-[#7b0000] text-lg">
            <?php echo e($order->order_id); ?>

        </td>

        <td class="px-6 py-5">
            <h3 class="font-bold text-base">
                <?php echo e($order->customer->customer_name ?? 'Guest'); ?>

            </h3>
            <p class="text-gray-400 uppercase text-[10px] mt-1">
                
                OFFLINE ORDER
            </p>
        </td>

        <td class="px-6 py-5 text-sm text-gray-600">
            <?php echo e($order->order_date->format('M d, H:i')); ?>

        </td>

        <td class="px-6 py-5 text-sm font-semibold">
            <?php echo e($order->total_items); ?> items
        </td>

        <td class="px-6 py-5 text-base font-bold">
            Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

        </td>

        <td class="px-6 py-5">
            <?php
                $statusClasses = [
                    'Complete' => 'bg-[#dff7e5] text-green-700',
                    'Pending'   => 'bg-[#fff6e8] text-yellow-700',
                ];
                $class = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700';
            ?>

            <div class="<?php echo e($class); ?> px-3 py-1 rounded-full inline-flex items-center gap-2 font-bold uppercase text-[10px]">

                 <?php if($order->status == 'Complete'): ?>
                    <i data-lucide="check-circle-2" class="w-3 h-3"></i>

                <?php else: ?>
                    <i data-lucide="clock-3" class="w-3 h-3"></i>

                <?php endif; ?>

                <span class="status-text"><?php echo e($order->status); ?></span>
            </div>
        </td>

        <td class="px-6 py-5">
            <div class="flex gap-3 text-[#7b0000]">
                <button title="View Detail">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </button>
                <button>
                    <i data-lucide="ellipsis" class="w-4 h-4"></i>
                </button>
            </div>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const rows = document.querySelectorAll("tbody tr");

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase().trim();
        const statusValue = statusFilter.value.toLowerCase().trim();

        rows.forEach(row => {
            // 1. Ambil semua teks dalam baris untuk pencarian nama/ID
            const rowText = row.innerText.toLowerCase();

            // 2. Ambil teks status dari span yang sudah kita beri class tadi
            const statusCell = row.querySelector(".status-text");
            let rowStatus = statusCell ? statusCell.innerText.toLowerCase().trim() : "";
            
            // Normalisasi kata 'complete' agar cocok dengan value option 'completed'
            if (rowStatus === 'complete') {
                rowStatus = 'completed';
            }

            // 3. Logika Evaluasi Filter
            const matchSearch = rowText.includes(searchValue);
            const matchStatus = (statusValue === "all" || rowStatus === statusValue);

            // 4. Tampilkan atau Sembunyikan Baris
            if (matchSearch && matchStatus) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Jalankan filter saat mengetik atau mengganti opsi status
    if (searchInput) searchInput.addEventListener("keyup", filterTable);
    if (statusFilter) statusFilter.addEventListener("change", filterTable);

});
</script>

<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/order_history.blade.php ENDPATH**/ ?>