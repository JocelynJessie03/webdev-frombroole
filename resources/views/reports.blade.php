@extends('partials.sidebar')

@section('content')

<div class="space-y-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-[26px] font-black text-[#7b0000] leading-none mb-2">
                Reports & Analytics
            </h1>
            <p class="text-gray-600 text-sm">
                Review your business performance and insights.
            </p>
        </div>

        {{-- FILTER TABS --}}
        <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 h-fit">
            <a href="{{ url()->current() }}?view=daily" id="btnDaily" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold {{ request('view', 'weekly') === 'daily' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500' }}">
                Daily
            </a>
            <a href="{{ url()->current() }}?view=weekly" id="btnWeekly" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold {{ request('view', 'weekly') === 'weekly' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500' }}">
                Weekly
            </a>
            <a href="{{ url()->current() }}?view=monthly" id="btnMonthly" class="tab-btn px-4 py-2 rounded-lg text-sm font-bold {{ request('view', 'weekly') === 'monthly' ? 'bg-white shadow-sm text-[#7b0000]' : 'text-gray-500' }}">
                Monthly
            </a>
        </div>
    </div>

    {{-- TOP STATS --}}
    <div class="grid grid-cols-2 gap-4">
        {{-- CARD REVENUE --}}
        <div class="bg-white rounded-2xl border p-4 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="wallet" class="w-5 h-5 text-[#7b0000]"></i>
                </div>
                <div class="bg-[#f9eded] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    ↗ +12.5%
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-2">
                Total Revenue
            </p>
            <h2 class="text-[28px] font-black text-[#7b0000] leading-none">
                Rp {{ number_format($totalRevenue ?? 0,0,',','.') }}
            </h2>
        </div>

        {{-- CARD ORDERS --}}
        <div class="bg-white rounded-2xl border p-4 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#eef2e3] flex items-center justify-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-[#7f8b67]"></i>
                </div>
                <div class="bg-[#f9eded] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    ↗ +8.2%
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-2">
                Total Orders
            </p>
            <h2 class="text-[28px] font-black leading-none">
                {{ number_format($totalOrders ?? 0) }}
            </h2>
        </div>
    </div>

    {{-- CHART SECTION --}}
    <div class="grid grid-cols-4 gap-4">

        {{-- CHART MAIN --}}
        <div class="col-span-3 bg-white rounded-2xl border p-5 shadow-sm relative flex flex-col justify-between">
            
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-[18px] font-black">
                        Revenue Performance
                    </h2>
                    @if(request('start_date') && request('end_date') && request('view', 'weekly') !== 'weekly')
                        <span class="text-xs bg-red-50 text-[#7b0000] px-2 py-1 rounded-md font-semibold mt-1 inline-block">
                            📅 Range: {{ request('start_date') }} - {{ request('end_date') }}
                        </span>
                    @endif
                </div>

                {{-- Sembunyikan tombol View Details total jika sedang di tab weekly --}}
                @if(request('view', 'weekly') !== 'weekly')
                    <button id="btnViewDetails" class="text-[#7b0000] text-sm font-bold flex items-center gap-2 hover:opacity-80 transition-all">
                        View Details
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                @else
                    <span class="text-xs text-gray-400 italic flex items-center gap-1">
                        📊 Tren mingguan otomatis sepanjang tahun ini
                    </span>
                @endif
            </div>

            {{-- FILTER TANGGAL MELAYANG --}}
            <div id="filterDateContainer" class="hidden absolute top-[70px] left-5 right-5 z-10 bg-white p-4 rounded-xl border border-gray-200 shadow-xl transition-all">
                <form id="filterForm" action="{{ url()->current() }}" method="GET" class="flex flex-col gap-3">
                    <input type="hidden" name="view" id="activeTabInput" value="{{ request('view', 'weekly') }}">
    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label id="labelStart" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Start Date</label>
                            <input type="date" name="start_date" id="startDateInput" value="{{ request('start_date') }}" class="w-full border rounded-lg p-2 text-sm">
                        </div>
                        <div>
                            <label id="labelEnd" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">End Date</label>
                            <input type="date" name="end_date" id="endDateInput" value="{{ request('end_date') }}" class="w-full border rounded-lg p-2 text-sm">
                        </div>
                    </div>
    
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="submit" class="bg-[#7b0000] text-white text-xs font-bold px-4 py-2 rounded-lg hover:opacity-90">Apply Filter</button>
                    </div>
                </form>
            </div>

            {{-- Grafik menempati sisa ruang container secara penuh --}}
            <div class="flex-1 min-h-[250px] mt-2">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-4">
            {{-- TOP PRODUCTS --}}
            <div class="bg-white rounded-2xl border p-5 shadow-sm">
                <h2 class="text-[18px] font-black mb-6">
                    Top Products
                </h2>

                @php
                    $products = [
                        ['name'=>'Kopi Susu Gula Aren','sold'=>'420 sold','width'=>'w-full'],
                        ['name'=>'Signature Croissant','sold'=>'315 sold','width'=>'w-[75%]'],
                        ['name'=>'Earl Grey Tea','sold'=>'284 sold','width'=>'w-[60%]'],
                        ['name'=>'Almond Milk Latte','sold'=>'190 sold','width'=>'w-[45%]'],
                    ];
                @endphp

                <div class="space-y-5">
                    @foreach($products as $product)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-sm leading-tight">
                                {{ $product['name'] }}
                            </h3>
                            <span class="font-bold text-gray-600 text-xs">
                                {{ $product['sold'] }}
                            </span>
                        </div>
                        <div class="bg-[#f1eded] h-2 rounded-full overflow-hidden">
                            <div class="h-full rounded-full bg-[#8b0000] {{ $product['width'] }}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- INSIGHT --}}
            <div class="bg-white rounded-2xl border p-5 shadow-sm">
                <div class="bg-[#f7f1ef] rounded-xl p-4 border border-[#eedfda]">
                    <p class="uppercase tracking-widest text-[10px] text-[#7b0000] font-black mb-3">
                        Insight Of The Week
                    </p>
                    <p class="text-sm leading-relaxed text-gray-700">
                        Beverage sales are up 14% on weekends. Consider a
                        <span class="font-black text-[#7b0000]">
                            "Weekend Brunch Bundle".
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- RECENT REPORTS --}}
    <div class="bg-white rounded-2xl border p-5 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-[18px] font-black">
                Recent Reports
            </h2>
            <button class="flex items-center gap-2 text-gray-500 text-sm font-bold">
                <i data-lucide="filter" class="w-4 h-4"></i>
                Filter By Category
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">Report ID</th>
                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">Category</th>
                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">Generated Date</th>
                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">Status</th>
                        <th class="text-right py-4 uppercase text-[10px] tracking-widest text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $reports = [
                            ['id'=>'#REP-2023-081','category'=>'Financial Summary','date'=>'Oct 24, 2023','status'=>'Completed'],
                            ['id'=>'#REP-2023-080','category'=>'Inventory Audit','date'=>'Oct 22, 2023','status'=>'Completed'],
                            ['id'=>'#REP-2023-079','category'=>'Employee Performance','date'=>'Oct 21, 2023','status'=>'Pending'],
                            ['id'=>'#REP-2023-078','category'=>'Customer Loyalty Analytics','date'=>'Oct 19, 2023','status'=>'Completed'],
                        ];
                    @endphp

                    @foreach($reports as $report)
                    <tr class="border-b last:border-0">
                        <td class="py-4 font-black text-sm">{{ $report['id'] }}</td>
                        <td class="py-4 text-sm text-gray-700">{{ $report['category'] }}</td>
                        <td class="py-4 text-sm text-gray-700">{{ $report['date'] }}</td>
                        <td class="py-4">
                            @if($report['status'] == 'Completed' || $report['status'] == 'Complete')
                            <span class="bg-[#f7ecec] text-[#7b0000] px-3 py-1 rounded-full text-xs font-black">
                                COMPLETED
                            </span>
                            @else
                            <span class="bg-[#eef2e3] text-[#7f8b67] px-3 py-1 rounded-full text-xs font-black">
                                PENDING
                            </span>
                            @endif
                        </td>
                        <td class="py-4 text-right">
                            <button class="text-[#7b0000] text-sm font-black flex items-center gap-2 ml-auto">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                DOWNLOAD CSV
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-6">
            <button class="text-gray-400 font-black text-sm hover:text-[#7b0000] transition">
                View All Archived Reports
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT DATA PLUCKING --}}
@php
    $dailyLabels = isset($dailyRevenue) ? $dailyRevenue->pluck('day')->toArray() : [];
    $dailyTotals = isset($dailyRevenue) ? $dailyRevenue->pluck('total')->toArray() : [];

    // Ambil string 'Week X' utuh dari controller baru kita, jangan di-map manual lagi
    $weeklyLabels = isset($weeklyRevenue) ? $weeklyRevenue->pluck('week_num')->toArray() : [];
    $weeklyTotals = isset($weeklyRevenue) ? $weeklyRevenue->pluck('total')->toArray() : [];

    $monthlyLabels = isset($monthlyRevenue) ? $monthlyRevenue->pluck('month')->toArray() : [];
    $monthlyTotals = isset($monthlyRevenue) ? $monthlyRevenue->pluck('total')->toArray() : [];
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('revenueChart');
    if(!ctx) return;

    const dailyData = { labels: @json($dailyLabels), values: @json($dailyTotals) };
    const weeklyData = { labels: @json($weeklyLabels), values: @json($weeklyTotals) };
    const monthlyData = { labels: @json($monthlyLabels), values: @json($monthlyTotals) };

    const btnViewDetails = document.getElementById('btnViewDetails');
    const filterContainer = document.getElementById('filterDateContainer');
    const activeTabInput = document.getElementById('activeTabInput');
    const filterForm = document.getElementById('filterForm');

    const startDateInput = document.getElementById('startDateInput');
    const endDateInput = document.getElementById('endDateInput');
    const labelStart = document.getElementById('labelStart');
    const labelEnd = document.getElementById('labelEnd');
    
    const urlParams = new URLSearchParams(window.location.search);
    const currentView = urlParams.get('view') || 'weekly';
    const isFiltering = urlParams.has('start_date') && urlParams.has('end_date');

    let initialLabels = weeklyData.labels;
    let initialValues = weeklyData.values;

    if (currentView === 'daily') {
        initialLabels = dailyData.labels;
        initialValues = dailyData.values;
    } else if (currentView === 'monthly') {
        initialLabels = monthlyData.labels;
        initialValues = monthlyData.values;
    }

    if (startDateInput && endDateInput) {
        configureInputFields(currentView);
    }

    if (isFiltering && filterContainer && currentView !== 'weekly') {
        filterContainer.classList.remove('hidden');
    }

    // INIT CHART
    let revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: initialLabels.length ? initialLabels : ['No Data'],
            datasets: [{
                label: 'Revenue',
                data: initialValues.length ? initialValues : [0],
                borderColor: '#8b0000',
                backgroundColor: 'rgba(139, 0, 0, 0.08)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#8b0000',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                borderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: true, grid: { display: true } },
                x: { grid: { display: false } }
            }
        }
    });

    function configureInputFields(view) {
        if (!startDateInput || !endDateInput) return;
        if (view === 'monthly') {
            startDateInput.type = 'month';
            endDateInput.type = 'month';
            if(labelStart) labelStart.innerText = 'START MONTH';
            if(labelEnd) labelEnd.innerText = 'END MONTH';
        } else {
            startDateInput.type = 'date';
            endDateInput.type = 'date';
            if(labelStart) labelStart.innerText = 'START DATE';
            if(labelEnd) labelEnd.innerText = 'END DATE';
        }
    }

    if(btnViewDetails && filterContainer) {
        btnViewDetails.addEventListener('click', function (e) {
            e.preventDefault();
            filterContainer.classList.toggle('hidden');
        });
    }

    if(filterForm) {
        filterForm.addEventListener('submit', function (e) {
            const viewMode = activeTabInput.value;
            const startVal = startDateInput.value;
            const endVal = endDateInput.value;

            if(!startVal || !endVal) {
                e.preventDefault();
                alert('Silakan pilih rentang waktu awal dan akhir terlebih dahulu!');
                return;
            }

            if (viewMode === 'daily') {
                const date1 = new Date(startVal);
                const date2 = new Date(endVal);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                if (diffDays !== 7) {
                    e.preventDefault();
                    alert(`⚠️ Error: Untuk filter harian (Daily), Anda WAJIB memilih tepat 7 hari data. Rentang saat ini: ${diffDays} hari.`);
                    return;
                }
            } 
            else if (viewMode === 'monthly') {
                const [year1, month1] = startVal.split('-').map(Number);
                const [year2, month2] = endVal.split('-').map(Number);
                const diffMonths = (year2 - year1) * 12 + (month2 - month1) + 1;

                if (diffMonths !== 5) {
                    e.preventDefault();
                    alert(`⚠️ Error: Untuk filter bulanan (Monthly), Anda WAJIB memilih tepat rentang 5 bulan data. Rentang saat ini: ${diffMonths} bulan.`);
                    return;
                }
            }
        });
    }
});
</script>

@endsection