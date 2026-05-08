@extends('layouts.app')

@section('content')

<div class="grid grid-cols-3 gap-8">

    {{-- LEFT --}}
    <div class="col-span-2 space-y-8">

        {{-- HERO --}}
        <div class="bg-gradient-to-br from-[#7b0000] to-[#930000] rounded-[40px] p-10 text-white">

            <p class="uppercase tracking-widest text-sm opacity-70 mb-3">
                Daily Sales Summary
            </p>

            <h1 class="text-6xl font-black mb-8">
                Rp 4.250.000
            </h1>

            <div class="flex gap-5">

                <div class="bg-white/20 px-6 py-3 rounded-full text-base font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                    +12.5% vs yesterday
                </div>

                <button class="bg-white text-[#7b0000] px-8 py-3 rounded-2xl text-base font-bold hover:bg-gray-100 transition">
                    View Details
                </button>

                <button class="border border-white/30 px-8 py-3 rounded-2xl text-base font-bold flex items-center gap-2 hover:bg-white/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    PDF
                </button>

            </div>

        </div>


        {{-- STORE PERFORMANCE --}}
        <div class="bg-white rounded-[40px] p-10 shadow-sm">

            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-2xl font-black">Store Performance</h2>
                    <p class="text-sm text-gray-500 mt-1">Top performing products this week</p>
                </div>
                <button class="text-[#7b0000] text-sm font-bold hover:underline">View All</button>
            </div>

            <div class="space-y-8">

                @php
                    $products = [
                        ['label' => 'BEST SELLER', 'title' => 'Arabica Beans - Signature Blend', 'sold' => '142 units sold', 'progress' => 85],
                        ['label' => 'POPULAR',     'title' => 'Single Origin - Gayo',            'sold' => '98 units sold',  'progress' => 55],
                        ['label' => 'TRENDING',    'title' => 'Espresso Roast #04',              'sold' => '72 units sold',  'progress' => 42],
                    ];
                @endphp

                @foreach($products as $item)
                <div>
                    <p class="text-xs font-bold tracking-widest text-[#7b0000] uppercase mb-1">
                        {{ $item['label'] }}
                    </p>
                    <div class="flex justify-between mb-3">
                        <h3 class="text-lg font-bold">{{ $item['title'] }}</h3>
                        <span class="text-base font-bold text-gray-700">{{ $item['sold'] }}</span>
                    </div>
                    <div class="bg-gray-100 h-3 rounded-full overflow-hidden">
                        <div
                            class="bg-[#7b0000] h-full rounded-full"
                            style="width: {{ $item['progress'] }}%">
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>


        {{-- INVENTORY STATUS --}}
        <div class="bg-white rounded-[40px] p-10 shadow-sm">

            <h2 class="text-2xl font-black mb-6">Inventory Status</h2>

            <div class="grid grid-cols-4 gap-4">

                @php
                    $inventory = [
                        ['name' => 'Paper Cups',    'qty' => '12 left',  'badge' => 'LOW STOCK',     'badge_color' => 'bg-red-100 text-red-600'],
                        ['name' => 'Whole Milk',    'qty' => '5 units',  'badge' => 'CRITICAL',      'badge_color' => 'bg-red-100 text-red-600'],
                        ['name' => 'Oat Milk',      'qty' => '42 units', 'badge' => 'IN STOCK',      'badge_color' => 'bg-green-100 text-green-700'],
                        ['name' => 'Syrup Vanilla', 'qty' => '18 left',  'badge' => 'REPLENISH SOON','badge_color' => 'bg-yellow-100 text-yellow-700'],
                    ];
                @endphp

                @foreach($inventory as $inv)
                <div class="border border-gray-100 rounded-2xl p-5">
                    <p class="text-sm text-gray-500 mb-2">{{ $inv['name'] }}</p>
                    <p class="text-2xl font-black text-[#7b0000] mb-3">{{ $inv['qty'] }}</p>
                    <span class="text-xs font-bold px-3 py-1 rounded-full {{ $inv['badge_color'] }}">
                        {{ $inv['badge'] }}
                    </span>
                </div>
                @endforeach

            </div>

        </div>


        {{-- GROWTH METRIC --}}
        <div class="bg-[#f0ece8] rounded-[40px] p-10 flex items-center gap-8">

            <div class="w-16 h-16 bg-[#7b0000] rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>
                </svg>
            </div>

            <div class="flex-1">
                <h3 class="text-xl font-black mb-1">Growth Metric</h3>
                <p class="text-sm text-gray-600">
                    Your coffee bean efficiency is 18% higher than last month.
                    This saved approximately Rp 450k in operational costs.
                </p>
            </div>

            <div class="bg-white rounded-2xl px-8 py-5 text-center flex-shrink-0">
                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Efficiency Index</p>
                <p class="text-4xl font-black text-[#7b0000]">94.2</p>
            </div>

        </div>

    </div>


    {{-- RIGHT --}}
    <div class="space-y-8">

        {{-- NEW TRANSACTION --}}
        <div class="bg-white rounded-[40px] p-10 text-center shadow-sm">

            <div class="w-20 h-20 bg-[#f5ebeb] mx-auto rounded-2xl flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#7b0000]" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>

            <h2 class="text-xl font-black mb-2">New Transaction</h2>
            <p class="text-sm text-gray-500">Quickly open the POS to register a new sale</p>

        </div>


        {{-- RECENT ACTIVITY --}}
        <div class="bg-white rounded-[40px] p-8 shadow-sm">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-black">Recent Activity</h2>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="5" r="1.5"></circle>
                        <circle cx="12" cy="12" r="1.5"></circle>
                        <circle cx="12" cy="19" r="1.5"></circle>
                    </svg>
                </button>
            </div>

            <div class="space-y-5">

                {{-- Sale #9402 --}}
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-[#7b0000] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">New Sale: #TRX-9402</h3>
                        <p class="text-xs text-gray-500">2x Signature Blend, 1x Latte</p>
                        <p class="text-xs text-gray-400 mt-1">2 MINS AGO · TERMINAL 01</p>
                    </div>
                </div>

                {{-- Stock Warning --}}
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-[#f5ebeb] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#7b0000]" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Stock Warning</h3>
                        <p class="text-xs text-gray-500">Paper Cups reached threshold (12)</p>
                        <p class="text-xs text-gray-400 mt-1">45 MINS AGO · SYSTEM</p>
                    </div>
                </div>

                {{-- Maya Putri clocked in --}}
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-gray-200">
                        <img src="https://ui-avatars.com/api/?name=Maya+Putri&background=7b0000&color=fff" alt="Maya Putri" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Maya Putri clocked in</h3>
                        <p class="text-xs text-gray-500">Morning shift started</p>
                        <p class="text-xs text-gray-400 mt-1">07:00 AM · STAFF PORTAL</p>
                    </div>
                </div>

                {{-- Sale #9401 --}}
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-[#7b0000] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">New Sale: #TRX-9401</h3>
                        <p class="text-xs text-gray-500">1x Single Origin Gayo</p>
                        <p class="text-xs text-gray-400 mt-1">YESTERDAY · TERMINAL 01</p>
                    </div>
                </div>

            </div>

            <button class="w-full mt-8 bg-[#7b0000] text-white rounded-2xl py-4 text-sm font-bold hover:bg-[#930000] transition">
                Show All Activity
            </button>

        </div>

    </div>

</div>

@endsection