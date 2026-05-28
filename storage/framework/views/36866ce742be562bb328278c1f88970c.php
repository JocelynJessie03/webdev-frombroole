<?php $__env->startSection('content'); ?>

<div class="space-y-4">

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <div class="bg-[#fff9e9] border border-[#f6e7a8] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-yellow-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-yellow-700 mb-2">
                Gold Members
            </p>
            <h2 class="text-3xl font-black text-yellow-700"><?php echo e($goldCount ?? 0); ?></h2>
        </div>

        
        <div class="bg-[#f5f5f5] border rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-gray-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-gray-600 mb-2">
                Silver Members
            </p>
            <h2 class="text-3xl font-black text-gray-700"><?php echo e($silverCount ?? 0); ?></h2>
        </div>

        
        <div class="bg-[#fff5ec] border border-[#ffd8b5] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-orange-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-orange-600 mb-2">
                Bronze Members
            </p>
            <h2 class="text-3xl font-black text-orange-600"><?php echo e($bronzeCount ?? 0); ?></h2>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

        
        <div class="p-4 flex justify-between items-center border-b gap-4">
            
            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[360px]">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input
                    id="customerSearch"
                    type="text"
                    placeholder="Search customer name or ID..."
                    class="bg-transparent outline-none w-full text-sm"
                >
            </div>

            <div class="flex gap-2">
                
                <button id="btnTopSpender" data-sort="none" class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm hover:bg-gray-50 transition">
                    <i data-lucide="trending-up" class="w-4 h-4 text-gray-500"></i>
                    <span>Sort Spend</span>
                    <span id="sortIndicator" class="text-xs text-gray-400 font-bold">↕</span>
                </button>

                
                <div class="relative flex items-center border px-4 py-2 rounded-xl gap-2 font-medium text-sm bg-white">
                    <i data-lucide="star" class="w-4 h-4 text-gray-500"></i>
                    <select id="tierFilter" class="bg-transparent outline-none cursor-pointer appearance-none pr-4 font-semibold">
                        <option value="all">All Tiers</option>
                        <option value="gold">Gold</option>
                        <option value="silver">Silver</option>
                        <option value="bronze">Bronze</option>
                    </select>
                </div>
            </div>
        </div>

        
        <table class="w-full" id="customerTable">
            <thead class="bg-[#faf7f5]">
                <tr class="text-left text-gray-400 uppercase tracking-widest text-[10px]">
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Contact</th>
                    <th class="px-6 py-4">Total Spend</th>
                    <th class="px-6 py-4">Visits</th>
                    <th class="px-6 py-4">Loyalty Points</th>
                    <th class="px-6 py-4">Tier</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>

            <tbody id="customerTableBody">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <tr class="customer-row border-t hover:bg-gray-50 transition" 
                    data-name="<?php echo e(strtolower($customer->customer_name)); ?> <?php echo e(strtolower($customer->customer_ID)); ?>" 
                    data-spend="<?php echo e($customer->total_spend); ?>" 
                    data-tier="<?php echo e(strtolower($customer->tier)); ?>">
                    
                    
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($customer->customer_name)); ?>&background=random" 
                                 class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <h3 class="font-bold text-base"><?php echo e($customer->customer_name); ?></h3>
                                <span class="text-[10px] text-gray-400 font-mono"><?php echo e($customer->customer_ID); ?></span>
                            </div>
                        </div>
                    </td>

                    
                    <td class="px-6 py-5">
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i> <?php echo e($customer->email); ?></div>
                            <div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i> <?php echo e($customer->phone); ?></div>
                        </div>
                    </td>

                    
                    <td class="px-6 py-5">
                        <h3 class="font-bold text-lg">Rp <?php echo e(number_format($customer->total_spend, 0, ',', '.')); ?></h3>
                    </td>

                    
                    <td class="px-6 py-5">
                        <div class="font-semibold text-sm">
                            <?php echo e($customer->orders ? $customer->orders->count() : 0); ?> visits
                        </div>
                    </td>

                    
                    <td class="px-6 py-5">
                        <?php
                            $targetPoinMaksimal = 10000; 
                            $calculatedPercentage = min(100, max(0, ($customer->member_points / $targetPoinMaksimal) * 100));
                        ?>

                        <div class="flex items-center gap-3">
                            
                            <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden" title="<?php echo e(round($calculatedPercentage)); ?>% to Target">
                                
                                <div class="bg-[#7f876e] h-full rounded-full transition-all duration-500 ease-in-out" 
                                    style="width: <?php echo e($calculatedPercentage); ?>%">
                                </div>
                            </div>
                            
                            
                            <span class="text-sm font-semibold text-[#7f876e]">
                                <?php echo e(number_format($customer->member_points, 0, ',', '.')); ?> pts
                            </span>
                        </div>
                    </td>

                    
                    <td class="px-6 py-5">
                        <?php
                            $tierStyles = [
                                'Gold' => 'bg-[#fff2c9] text-yellow-700',
                                'Silver' => 'bg-gray-100 text-gray-600',
                                'Bronze' => 'bg-[#ffe7d1] text-orange-700',
                            ];
                            $style = $tierStyles[$customer->tier] ?? 'bg-gray-100 text-gray-600';
                        ?>
                        <div class="<?php echo e($style); ?> px-4 py-1 rounded-full text-xs font-bold inline-block uppercase">
                            <?php echo e($customer->tier); ?>

                        </div>
                    </td>

                    
                    <td class="px-9 py-5">
                        <div class="flex gap-3 text-[#7b0000]">
                            
                            <button onclick="openHistory(this)" 
                                    data-name="<?php echo e($customer->customer_name); ?>"
                                    data-history="<?php echo e(json_encode($customer->orders ?? [])); ?>"
                                    class="hover:scale-110 transition flex items-center gap-1.5"
                                    title="View Transaction History">
                                <i data-lucide="history" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>


<div id="historyModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl flex flex-col max-h-[85vh]">
        <div class="p-6 border-b flex justify-between items-center bg-[#faf7f5]">
            <div>
                <h2 class="text-xl font-bold">Transaction History</h2>
                <p class="text-sm text-gray-500" id="modalCustomerName"></p>
            </div>
            <button onclick="closeHistory()" class="text-gray-400 hover:text-black">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        
        <div class="p-6 overflow-y-auto flex-1 space-y-4" id="historyModalBody">
            
        </div>

        <div class="p-6 border-t bg-gray-50 flex justify-end">
            <button onclick="closeHistory()" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-xl font-bold text-sm hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("customerSearch");
    const tierFilter = document.getElementById("tierFilter");
    const btnTopSpender = document.getElementById("btnTopSpender");
    const sortIndicator = document.getElementById("sortIndicator");
    const tableBody = document.getElementById("customerTableBody");
    
    // Fungsi Filtrasi Kombinasi (Search & Tier)
    function applyFilters() {
        const searchValue = searchInput.value.toLowerCase().trim();
        const selectedTier = tierFilter.value.toLowerCase();
        const rows = document.querySelectorAll(".customer-row");

        rows.forEach(row => {
            const nameAndId = row.getAttribute("data-name");
            const currentTier = row.getAttribute("data-tier");

            const matchSearch = nameAndId.includes(searchValue);
            const matchTier = (selectedTier === "all" || currentTier === selectedTier);

            if (matchSearch && matchTier) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // ========================================================
    // LOGIKA FILTER OTOMATIS DARI GLOBAL SEARCH (SIDEBAR)
    // ========================================================
    const itemToHighlight = new URLSearchParams(window.location.search).get('highlight');
    if (itemToHighlight && searchInput) {
        const targetWord = itemToHighlight.toLowerCase().trim();
        
        // 1. Ketik otomatis kata pencarian di input lokal
        searchInput.value = itemToHighlight;
        
        // 2. Jalankan fungsi filter bawaan Anda
        applyFilters();

        // 3. Beri efek kilasan kuning & scroll halus ke target customer yang dicari
        document.querySelectorAll(".customer-row").forEach(row => {
            const nameAndId = row.getAttribute("data-name");
            if (nameAndId && nameAndId.includes(targetWord)) {
                row.style.backgroundColor = '#fef08a';
                row.style.transition = 'background-color 1s ease';
                row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Kembalikan ke warna semula setelah 1.5 detik
                setTimeout(() => { row.style.backgroundColor = ''; }, 1500);
            }
        });
    }

    // Fungsi Pengurutan Top Spender
    function sortTopSpenders() {
        const rows = Array.from(document.querySelectorAll(".customer-row"));
        const currentSortMode = btnTopSpender.getAttribute("data-sort");
        let newSortMode = "desc";

        if (currentSortMode === "desc") {
            newSortMode = "asc";
            sortIndicator.innerText = "▲";
        } else {
            newSortMode = "desc";
            sortIndicator.innerText = "▼";
        }
        
        btnTopSpender.setAttribute("data-sort", newSortMode);

        rows.sort((rowA, rowB) => {
            const spendA = parseInt(rowA.getAttribute("data-spend")) || 0;
            const spendB = parseInt(rowB.getAttribute("data-spend")) || 0;
            return newSortMode === "desc" ? (spendB - spendA) : (spendA - spendB);
        });

        rows.forEach(row => tableBody.appendChild(row));
    }

    if (searchInput) searchInput.addEventListener("keyup", applyFilters);
    if (tierFilter) tierFilter.addEventListener("change", applyFilters);
    if (btnTopSpender) btnTopSpender.addEventListener("click", sortTopSpenders);
});

// FUNGSI MODAL HISTORY CUSTOMER (DENGAN ACCORDION NYATA)
function openHistory(button) {
    const modal = document.getElementById('historyModal');
    const nameEl = document.getElementById('modalCustomerName');
    const bodyEl = document.getElementById('historyModalBody');

    const customerName = button.getAttribute('data-name');
    let historyData = [];
    
    try {
        historyData = JSON.parse(button.getAttribute('data-history') || '[]');
    } catch (e) {
        console.error("Gagal parse data riwayat", e);
    }

    nameEl.innerText = "Viewing transactions for " + customerName;
    bodyEl.innerHTML = ''; // Reset isi body

    if (historyData.length === 0) {
        bodyEl.innerHTML = `
            <div class="flex flex-col items-center justify-center py-10 opacity-50">
                <i data-lucide="receipt" class="w-12 h-12 mb-3"></i>
                <p class="text-gray-500 font-medium">No transaction history found.</p>
            </div>
        `;
    } else {
        historyData.reverse();

        historyData.forEach((trx, index) => {
            let itemsList = '';
            if (trx.items && trx.items.length > 0) {
                itemsList = trx.items.map(item => {
                    let productName = 'Unknown Product';
                    if (item.product) {
                        productName = item.pro_name || item.product.pro_name || 'Unnamed Product';
                    }

                    return `
                    <li class="flex justify-between items-center text-sm py-2 border-b last:border-0 border-gray-100">
                        <span class="text-gray-700 font-medium">${productName}</span>
                        <span class="text-gray-400 text-xs">x${item.quantity || 1}</span>
                    </li>
                    `;
                }).join('');
            } else {
                itemsList = '<p class="text-xs text-gray-400 italic">No details available.</p>';
            }

            let orderId = trx.order_id || `TRX-${Math.floor(Math.random() * 10000)}`;
            let orderDate = trx.order_date || trx.created_at || '-';
            let totalItems = trx.total_items || (trx.items ? trx.items.length : 0);
            
            let totalPrice = trx.total_price ? parseInt(trx.total_price) : 0;
            let formattedPrice = 'Rp ' + totalPrice.toLocaleString('id-ID');

            let displayDate = orderDate;
            if (orderDate !== '-') {
                try {
                    let dateObj = new Date(orderDate);
                    if (!isNaN(dateObj.getTime())) {
                        let tgl = String(dateObj.getDate()).padStart(2, '0');
                        let bln = dateObj.toLocaleString('id-ID', { month: 'short' });
                        let thn = dateObj.getFullYear();
                        let jam = String(dateObj.getHours()).padStart(2, '0');
                        let menit = String(dateObj.getMinutes()).padStart(2, '0');
                        displayDate = `${tgl} ${bln} ${thn} - ${jam}:${menit}`;
                    }
                } catch (e) {
                    console.error("Gagal memformat tanggal", e);
                }
            }

            bodyEl.innerHTML += `
                <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm">
                    <div class="flex items-center justify-between p-4 bg-white hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#f7ebeb] flex items-center justify-center text-[#7b0000]">
                                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="font-black text-[#1b1b1b]">${orderId}</p>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">${displayDate}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="font-black text-sm text-[#1b1b1b]">${formattedPrice}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">${totalItems} items</p>
                            </div>
                            <button onclick="toggleOrderDetails('details-${index}')" class="text-gray-400 hover:text-[#7b0000] p-2 rounded-xl border hover:bg-white transition bg-gray-50" title="View Items">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div id="details-${index}" class="order-detail-container hidden bg-[#faf7f5] p-4 border-t">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Items Ordered</p>
                        <ul class="space-y-1">
                            ${itemsList}
                        </ul>
                    </div>
                </div>
            `;
        });
    }

    modal.classList.remove('hidden');
    
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeHistory() {
    document.getElementById('historyModal').classList.add('hidden');
}

function toggleOrderDetails(id) {
    const el = document.getElementById(id);
    const isCurrentlyHidden = el.classList.contains('hidden');
    const allDetailContainers = document.querySelectorAll('.order-detail-container');

    allDetailContainers.forEach(container => {
        container.classList.add('hidden');
    });

    if (isCurrentlyHidden) {
        el.classList.remove('hidden');
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('historyModal');
    if (event.target == modal) {
        closeHistory();
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/customers.blade.php ENDPATH**/ ?>