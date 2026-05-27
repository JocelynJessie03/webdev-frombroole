@extends('partials.sidebar')

@section('content')

<div class="space-y-5">
    {{-- CHART USAGE 5 DAYS AGO --}}
    <div class="bg-white rounded-2xl border p-6 shadow-sm mb-5">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Ingredient Usage Analytics</h3>
                <p class="text-xs text-gray-400">
                    Showing <span id="chartCount" class="font-bold text-black">0</span> <span id="unitName">all</span> ingredients listed in inventory last 5 days
                </p>
            </div>
            
            {{-- FILTER BUTTONS --}}
            <div id="chartFilterGroup" class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 text-xs font-bold shrink-0">
                <button onclick="filterChart('all')" class="chart-filter-btn bg-white shadow text-[#7b0000] px-4 py-1.5 rounded-lg transition">All</button>
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

    {{-- TOP CARDS --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- CARD 1: TOTAL INGREDIENTS --}}
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
                {{ $totalIngredients }}
            </h2>
        </div>

        {{-- CARD 2: DYNAMIC STOCK STATE (LOW / OUT OF STOCK) --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">
            <div class="flex justify-between items-start mb-5">
                
                @if(request('filter') == 'out_of_stock')
                    {{-- Tampilan Merah saat Filter OUT OF STOCK Aktif --}}
                    <div class="w-12 h-12 rounded-xl {{ $outOfStockCount > 0 ? 'bg-red-50' : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                        <i data-lucide="info" class="w-5 h-5 {{ $outOfStockCount > 0 ? 'text-red-600' : 'text-gray-400' }}"></i>
                    </div>
                    @if($outOfStockCount > 0)
                        <div class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full animate-pulse">
                            Empty Stock
                        </div>
                    @endif
                @else
                    {{-- Tampilan Kuning Standar (Kondisi All atau Low Stock) --}}
                    <div class="w-12 h-12 rounded-xl {{ $lowStockCount > 0 ? 'bg-amber-50' : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                        <i data-lucide="triangle-alert" class="w-5 h-5 {{ $lowStockCount > 0 ? 'text-amber-500' : 'text-gray-400' }}"></i>
                    </div>
                    @if($lowStockCount > 0)
                        <div class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                            Monitor Stock
                        </div>
                    @endif
                @endif
            
            </div>

            {{-- Judul dan Angka Berganti Sesuai Request Filter URL --}}
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                {{ request('filter') == 'out_of_stock' ? 'Out Of Stock' : 'Low Stock' }}
            </p>

            <h2 class="text-4xl font-black text-black">
                {{ request('filter') == 'out_of_stock' ? $outOfStockCount : $lowStockCount }}
            </h2>
        </div>

        {{-- CARD 3: USED TODAY --}}
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i data-lucide="activity" class="w-5 h-5 text-white"></i>
                </div>
                
                @if($usedTodayCount > 0)
                    <div class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full border border-white/30">
                        Active Kitchen
                    </div>
                @else
                    <div class="bg-white/10 text-white/50 text-xs font-bold px-3 py-1 rounded-full">
                        No Activity
                    </div>
                @endif
            </div>
            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Used Today
            </p>
            <h2 class="text-4xl font-black">
                {{ $usedTodayCount }} <span class="text-lg font-normal text-white/70">Items</span>
            </h2>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

        {{-- TOP BAR --}}
        <div class="p-5 flex justify-between items-center border-b">

            {{-- FILTER URL NAVIGATION --}}
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">
                <a href="{{ route('ingredient.inventory') }}" 
                class="{{ !request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    All
                </a>

                <a href="{{ route('ingredient.inventory', ['filter' => 'low_stock']) }}" 
                class="{{ request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Low Stock
                </a>

                <a href="{{ route('ingredient.inventory', ['filter' => 'out_of_stock']) }}" 
                class="{{ request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out Of Stock
                </a>
            </div>

            {{-- INPUT SEARCH BAR --}}
            <div class="bg-[#f6f3f1] rounded-xl px-4 py-2.5 flex items-center gap-3 w-[280px] focus-within:ring-2 focus-within:ring-[#7b0000]/20 transition">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search product..." 
                       class="bg-transparent outline-none w-full text-sm font-plain text-gray-700 placeholder-gray-400">
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('ingredient.create') }}"
                   class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add Ingredient
                </a>
            </div>
        </div>

        {{-- TABLE CONTENT --}}
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
                @foreach($ingredients as $ingredient)
                    <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                        {{-- INGREDIENT NAME --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-[#f8e9e9] flex items-center justify-center">
                                    <i data-lucide="package-2" class="w-5 h-5 text-[#7b0000]"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-base leading-tight">
                                        {{ $ingredient->name }}
                                    </h3>
                                </div>
                            </div>
                        </td>

                        {{-- STOCK --}}
                        <td class="px-4 py-5 text-lg font-black">
                            {{ number_format($ingredient->stock) }}
                        </td>

                        {{-- UNIT --}}
                        <td class="px-4 py-5 text-sm font-semibold text-gray-500 uppercase">
                            {{ $ingredient->unit }}
                        </td>

                        {{-- STATUS BADGE (SINKRONISASI KONDISI WARNA) --}}
                        <td class="px-4 py-5">
                            @if($ingredient->stock <= 0)
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    OUT OF STOCK
                                </span>
                            @elseif($ingredient->is_low_stock)
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    LOW STOCK
                                </span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap">
                                    IN STOCK
                                </span>
                            @endif
                        </td>

                        {{-- ACTION DROPDOWN --}}
                        <td class="px-4 py-5">
                            <div class="relative">
                                <button onclick="toggleDropdown(this)" class="text-gray-400 hover:text-black p-2 rounded-lg hover:bg-gray-100 transition">
                                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                                </button>
                                
                                <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                                    <a href="{{ route('ingredient.edit', $ingredient->id) }}" class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>Edit Ingredient
                                    </a>

                                    <form action="{{ route('ingredient.destroy', $ingredient->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $ingredient->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>Delete Ingredient
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Manajemen Dropdown Aksion (Tiga Titik)
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
        labels: {!! json_encode($usageData['labels'] ?? []) !!},
        values: {!! json_encode($usageData['values'] ?? []) !!},
        units: {!! json_encode($usageData['units'] ?? []) !!}
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
        } else {
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
        
        // --- A. HIGHLIGHT OTOMATIS DARI SEARCH UTAMA ---
        const itemToHighlight = new URLSearchParams(window.location.search).get('highlight');
        if (itemToHighlight) {
            const targetWord = itemToHighlight.toLowerCase().trim();
            document.querySelectorAll('tbody tr').forEach(row => {
                const nameElement = row.querySelector('h3');
                if (nameElement && nameElement.textContent.trim().toLowerCase().includes(targetWord)) {
                    row.style.backgroundColor = '#fef08a';
                    row.style.transition = 'all 0.5s ease';
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
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

            // Jalankan fungsi filter pertama kali agar counter text terhitung otomatis
            filterChart('all');
        }
    });
</script>
@endsection