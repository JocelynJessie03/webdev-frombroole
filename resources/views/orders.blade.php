@extends('layouts.app')

@section('content')

<div class="space-y-4">

    {{-- HEADER --}}
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



    {{-- STATS --}}
    <div class="grid grid-cols-4 gap-3">

        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#f7ebeb] rounded-xl flex items-center justify-center mb-3">

                <i data-lucide="receipt" class="w-4 h-4 text-[#7b0000]"></i>

            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                Total Orders
            </p>

            <h2 class="text-3xl font-black">
                1,284
            </h2>

        </div>


        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#eaf8ef] rounded-xl flex items-center justify-center mb-3">

                <i data-lucide="check-circle-2" class="w-4 h-4 text-green-600"></i>

            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                Completed
            </p>

            <h2 class="text-3xl font-black">
                1,120
            </h2>

        </div>


        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#fff6e8] rounded-xl flex items-center justify-center mb-3">

                <i data-lucide="clock-3" class="w-4 h-4 text-yellow-600"></i>

            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                Pending
            </p>

            <h2 class="text-3xl font-black">
                45
            </h2>

        </div>


        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">

            <div class="w-9 h-9 bg-[#fff0f0] rounded-xl flex items-center justify-center mb-3">

                <i data-lucide="x-circle" class="w-4 h-4 text-red-600"></i>

            </div>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                Cancelled
            </p>

            <h2 class="text-3xl font-black">
                119
            </h2>

        </div>

    </div>



    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

        {{-- SEARCH --}}
        <div class="p-4 flex justify-between items-center border-b">

            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[340px]">

                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search order..."
                    class="bg-transparent outline-none w-full text-sm"
                >

            </div>


            <div class="flex gap-2">

                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="filter" class="w-4 h-4"></i>

                    Filter

                </button>


                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="clock-3" class="w-4 h-4"></i>

                    Date

                </button>

            </div>

        </div>



        {{-- TABLE --}}
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

                @php
                    $orders = [
                        [
                            'id'=>'#ORD-8291',
                            'customer'=>'Budi Santoso',
                            'payment'=>'CASH',
                            'date'=>'Oct 24, 14:20',
                            'items'=>'3',
                            'total'=>'Rp 102.120',
                            'status'=>'Completed'
                        ],
                        [
                            'id'=>'#ORD-8290',
                            'customer'=>'Maya Putri',
                            'payment'=>'QRIS',
                            'date'=>'Oct 24, 13:45',
                            'items'=>'1',
                            'total'=>'Rp 45.000',
                            'status'=>'Completed'
                        ]
                    ];
                @endphp


                @foreach($orders as $order)

                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="px-6 py-5 font-bold text-[#7b0000] text-lg">
                        {{ $order['id'] }}
                    </td>

                    <td class="px-6 py-5">

                        <h3 class="font-bold text-base">
                            {{ $order['customer'] }}
                        </h3>

                        <p class="text-gray-400 uppercase text-[10px] mt-1">
                            {{ $order['payment'] }}
                        </p>

                    </td>

                    <td class="px-6 py-5 text-sm text-gray-600">
                        {{ $order['date'] }}
                    </td>

                    <td class="px-6 py-5 text-sm font-semibold">
                        {{ $order['items'] }} items
                    </td>

                    <td class="px-6 py-5 text-base font-bold">
                        {{ $order['total'] }}
                    </td>

                    <td class="px-6 py-5">

                        <div class="bg-[#dff7e5] text-green-700 px-3 py-1 rounded-full inline-flex items-center gap-2 font-bold uppercase text-[10px]">

                            <i data-lucide="check-circle-2" class="w-3 h-3"></i>

                            {{ $order['status'] }}

                        </div>

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex gap-3 text-[#7b0000]">

                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <i data-lucide="ellipsis" class="w-4 h-4"></i>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection