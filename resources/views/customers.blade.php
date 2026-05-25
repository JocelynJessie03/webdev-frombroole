@extends('partials.sidebar')

@section('content')

<div class="space-y-4">

    {{-- MEMBERSHIP STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- GOLD --}}
        <div class="bg-[#fff9e9] border border-[#f6e7a8] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-yellow-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-yellow-700 mb-2">
                Gold Members
            </p>
            <h2 class="text-3xl font-black text-yellow-700">{{ $goldCount ?? 0 }}</h2>
        </div>

        {{-- SILVER --}}
        <div class="bg-[#f5f5f5] border rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-gray-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-gray-600 mb-2">
                Silver Members
            </p>
            <h2 class="text-3xl font-black text-gray-700">{{ $silverCount ?? 0 }}</h2>
        </div>

        {{-- BRONZE --}}
        <div class="bg-[#fff5ec] border border-[#ffd8b5] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
            <i data-lucide="star" class="w-5 h-5 text-orange-600 mb-3"></i>
            <p class="uppercase tracking-widest text-[10px] font-bold text-orange-600 mb-2">
                Bronze Members
            </p>
            <h2 class="text-3xl font-black text-orange-600">{{ $bronzeCount ?? 0 }}</h2>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

        {{-- SEARCH & FILTERS --}}
        <div class="p-4 flex justify-between items-center border-b gap-4">
            {{-- INPUT SEARCH NAMA --}}
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
                {{-- TOMBOL SORT TOP SPENDER --}}
                <button id="btnTopSpender" data-sort="none" class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm hover:bg-gray-50 transition">
                    <i data-lucide="trending-up" class="w-4 h-4 text-gray-500"></i>
                    <span>Sort Spend</span>
                    <span id="sortIndicator" class="text-xs text-gray-400 font-bold">↕</span>
                </button>

                {{-- DROPDOWN SELECT TIER FILTER --}}
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

        {{-- TABLE REAL --}}
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
                @foreach($customers as $customer)
                {{-- KITA SEMATKAN ATRIBUT DATA UNTUK FILTRASI JAVASCRIPT --}}
                <tr class="customer-row border-t hover:bg-gray-50 transition" 
                    data-name="{{ strtolower($customer->customer_name) }} {{ strtolower($customer->customer_ID) }}" 
                    data-spend="{{ $customer->total_spend }}" 
                    data-tier="{{ strtolower($customer->tier) }}">
                    
                    {{-- CUSTOMER --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->customer_name) }}&background=random" 
                                 class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <h3 class="font-bold text-base">{{ $customer->customer_name }}</h3>
                                <span class="text-[10px] text-gray-400 font-mono">{{ $customer->customer_ID }}</span>
                            </div>
                        </div>
                    </td>

                    {{-- CONTACT --}}
                    <td class="px-6 py-5">
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i> {{ $customer->email }}</div>
                            <div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i> {{ $customer->phone }}</div>
                        </div>
                    </td>

                    {{-- TOTAL SPEND --}}
                    <td class="px-6 py-5">
                        <h3 class="font-bold text-lg">Rp {{ number_format($customer->total_spend, 0, ',', '.') }}</h3>
                    </td>

                    {{-- VISITS --}}
                    <td class="px-6 py-5">
                        <div class="font-semibold text-sm">
                            {{ $customer->orders ? $customer->orders->count() : 0 }} visits
                        </div>
                    </td>

                    {{-- LOYALTY POINTS --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="bg-[#7f876e] h-full rounded-full" style="width: {{ min(($customer->member_points / 5000) * 100, 100) }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-[#7f876e]">
                                {{ $customer->member_points }} pts
                            </span>
                        </div>
                    </td>

                    {{-- TIER --}}
                    <td class="px-6 py-5">
                        @php
                            $tierStyles = [
                                'Gold' => 'bg-[#fff2c9] text-yellow-700',
                                'Silver' => 'bg-gray-100 text-gray-600',
                                'Bronze' => 'bg-[#ffe7d1] text-orange-700',
                            ];
                            $style = $tierStyles[$customer->tier] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <div class="{{ $style }} px-4 py-1 rounded-full text-xs font-bold inline-block uppercase">
                            {{ $customer->tier }}
                        </div>
                    </td>

                    {{-- ACTION --}}
                    <td class="px-9 py-5">
                        <div class="flex gap-3 text-[#7b0000]">
                            {{-- TOMBOL HISTORY --}}
                            <button onclick="openHistory(this)" 
                                    data-name="{{ $customer->customer_name }}"
                                    data-history="{{ json_encode($customer->orders ?? []) }}"
                                    class="hover:scale-110 transition flex items-center gap-1.5"
                                    title="View Transaction History">
                                <i data-lucide="history" class="w-4 h-4"></i>
                            </button>
                            {{-- TOMBOL TITIK TIGA DI SINI SUDAH DIHAPUS --}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL HISTORY --}}
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

        {{-- AREA SCROLL UNTUK ACCORDION TRANSAKSI --}}
        <div class="p-6 overflow-y-auto flex-1 space-y-4" id="historyModalBody">
            {{-- Data akan di inject otomatis via JS --}}
        </div>

        <div class="p-6 border-t bg-gray-50 flex justify-end">
            <button onclick="closeHistory()" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-xl font-bold text-sm hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

{{-- INTEGRASI JAVASCRIPT ENGINE --}}
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

// FUNGSI MODAL HISTORY CUSTOMER (DENGAN ACCORDION)
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
        historyData.forEach((trx, index) => {
            // Render detail list item dari transaksi
            let itemsList = '';
            if (trx.items && trx.items.length > 0) {
                itemsList = trx.items.map(item => {
                    let productName = 'Unknown Product';
                    if (item.product) {
                        productName = item.pro_name || item.product.pro_name || item.product.pro_name || 'Unnamed Product';
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

            // Fallback variable data transaksi dasar
            let orderId = trx.order_id || `TRX-${Math.floor(Math.random() * 10000)}`;
            let orderDate = trx.order_date || trx.created_at || '-';
            let totalItems = trx.total_items || (trx.items ? trx.items.length : 0);
            
            // Mengambil dan memformat total_price ke mata uang Rupiah
            let totalPrice = trx.total_price ? parseInt(trx.total_price) : 0;
            let formattedPrice = 'Rp ' + totalPrice.toLocaleString('id-ID');

            // Format Tanggal dan Jam agar rapi (Contoh: 21 May 2026 - 11:35)
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

                    <div id="details-${index}" class="hidden bg-[#faf7f5] p-4 border-t">
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
    
    // Refresh SVG Lucide yang baru saja di-inject
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeHistory() {
    document.getElementById('historyModal').classList.add('hidden');
}

// FUNGSI UNTUK MEMUNCULKAN DROPDOWN DETAIL MENU (MATA)
function toggleOrderDetails(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
}

window.onclick = function(event) {
    const modal = document.getElementById('historyModal');
    if (event.target == modal) {
        closeHistory();
    }
}
</script>

@endsection