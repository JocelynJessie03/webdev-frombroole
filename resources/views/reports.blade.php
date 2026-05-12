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



        {{-- FILTER --}}
        <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 h-fit">

            <button class="px-4 py-2 rounded-lg text-sm font-bold text-gray-500">
                Daily
            </button>

            <button class="bg-white shadow-sm px-4 py-2 rounded-lg text-sm font-bold text-[#7b0000]">
                Weekly
            </button>

            <button class="px-4 py-2 rounded-lg text-sm font-bold text-gray-500">
                Monthly
            </button>

        </div>

    </div>



    {{-- TOP STATS --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- CARD --}}
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
                Rp 42.850.000
            </h2>

        </div>



        {{-- CARD --}}
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
                1,284
            </h2>

        </div>



        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-4 shadow-sm">

            <div class="flex justify-between items-start mb-4">

                <div class="w-10 h-10 rounded-xl bg-[#f8f7f4] flex items-center justify-center">

                    <i data-lucide="clock-3" class="w-5 h-5 text-[#b99a5d]"></i>

                </div>

                <div class="bg-[#ffe5e5] text-red-500 text-xs font-bold px-3 py-1 rounded-full">
                    ↘ -2.1%
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-2">
                Average Ticket
            </p>

            <h2 class="text-[28px] font-black text-[#7b0000] leading-none">
                Rp 33.372
            </h2>

        </div>

    </div>



    {{-- CHART SECTION --}}
    <div class="grid grid-cols-4 gap-4">

        {{-- CHART --}}
        <div class="col-span-3 bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-[18px] font-black">
                    Revenue Performance
                </h2>

                <button class="text-[#7b0000] text-sm font-bold flex items-center gap-2">

                    View Details

                    <i data-lucide="arrow-right" class="w-4 h-4"></i>

                </button>

            </div>



            {{-- GRAPH --}}
            <div class="flex items-end justify-between h-[220px] gap-3">

                @php
                    $bars = [
                        ['day'=>'Mon','height'=>'h-[40%]','active'=>false],
                        ['day'=>'Tue','height'=>'h-[65%]','active'=>false],
                        ['day'=>'Wed','height'=>'h-[55%]','active'=>false],
                        ['day'=>'Thu','height'=>'h-[75%]','active'=>false],
                        ['day'=>'Fri','height'=>'h-[82%]','active'=>false],
                        ['day'=>'Sat','height'=>'h-[95%]','active'=>true],
                        ['day'=>'Sun','height'=>'h-[62%]','active'=>false],
                    ];
                @endphp

                @foreach($bars as $bar)

                <div class="flex flex-col items-center gap-2 flex-1">

                    <div class="w-full rounded-t-xl {{ $bar['height'] }}
                        {{ $bar['active'] ? 'bg-[#8b0000]' : 'bg-[#e7d1d1]' }}">
                    </div>

                    <span class="text-gray-500 text-xs font-medium">
                        {{ $bar['day'] }}
                    </span>

                </div>

                @endforeach

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

                        Beverage sales are up 14% on weekends.
                        Consider a

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

        {{-- TOP --}}
        <div class="flex justify-between items-center mb-6">

            <h2 class="text-[18px] font-black">
                Recent Reports
            </h2>

            <button class="flex items-center gap-2 text-gray-500 text-sm font-bold">

                <i data-lucide="filter" class="w-4 h-4"></i>

                Filter By Category

            </button>

        </div>



        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                {{-- HEAD --}}
                <thead>

                    <tr class="border-b">

                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">
                            Report ID
                        </th>

                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">
                            Category
                        </th>

                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">
                            Generated Date
                        </th>

                        <th class="text-left py-4 uppercase text-[10px] tracking-widest text-gray-400">
                            Status
                        </th>

                        <th class="text-right py-4 uppercase text-[10px] tracking-widest text-gray-400">
                            Action
                        </th>

                    </tr>

                </thead>



                {{-- BODY --}}
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

                        {{-- ID --}}
                        <td class="py-4 font-black text-sm">
                            {{ $report['id'] }}
                        </td>

                        {{-- CATEGORY --}}
                        <td class="py-4 text-sm text-gray-700">
                            {{ $report['category'] }}
                        </td>

                        {{-- DATE --}}
                        <td class="py-4 text-sm text-gray-700">
                            {{ $report['date'] }}
                        </td>

                        {{-- STATUS --}}
                        <td class="py-4">

                            @if($report['status'] == 'Completed')

                            <span class="bg-[#f7ecec] text-[#7b0000] px-3 py-1 rounded-full text-xs font-black">
                                COMPLETED
                            </span>

                            @else

                            <span class="bg-[#eef2e3] text-[#7f8b67] px-3 py-1 rounded-full text-xs font-black">
                                PENDING
                            </span>

                            @endif

                        </td>

                        {{-- ACTION --}}
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



        {{-- FOOTER --}}
        <div class="text-center mt-6">

            <button class="text-gray-400 font-black text-sm hover:text-[#7b0000] transition">
                View All Archived Reports
            </button>

        </div>

    </div>

</div>

@endsection