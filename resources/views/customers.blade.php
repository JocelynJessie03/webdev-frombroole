@extends('partials.sidebar')

@section('content')

<div class="space-y-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-start">

        <div>

            <h1 class="text-3xl font-black text-[#1b1b1b] mb-1">
                Customer Directory
            </h1>

            <p class="text-gray-500 text-sm">
                Manage your customer relationships and loyalty programs.
            </p>

        </div>

        <button class="bg-[#7b0000] hover:bg-[#650000] text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow">

            <i data-lucide="user-plus" class="w-4 h-4"></i>

            <span class="font-semibold text-sm">
                Add New Customer
            </span>

        </button>

    </div>



    {{-- MEMBERSHIP STATS --}}
    <div class="grid grid-cols-4 gap-3">

        {{-- PLATINUM --}}
        <div class="bg-[#eef0ff] border border-[#dfe3ff] rounded-2xl p-5 text-center">

            <i data-lucide="star" class="w-5 h-5 mx-auto text-indigo-600 mb-3"></i>

            <p class="uppercase tracking-widest text-[10px] font-bold text-indigo-600 mb-2">
                Platinum Members
            </p>

            <h2 class="text-3xl font-black text-indigo-600">
                12
            </h2>

        </div>


        {{-- GOLD --}}
        <div class="bg-[#fff9e9] border border-[#f6e7a8] rounded-2xl p-5 text-center">

            <i data-lucide="star" class="w-5 h-5 mx-auto text-yellow-600 mb-3"></i>

            <p class="uppercase tracking-widest text-[10px] font-bold text-yellow-700 mb-2">
                Gold Members
            </p>

            <h2 class="text-3xl font-black text-yellow-700">
                48
            </h2>

        </div>


        {{-- SILVER --}}
        <div class="bg-[#f5f5f5] border rounded-2xl p-5 text-center">

            <i data-lucide="star" class="w-5 h-5 mx-auto text-gray-600 mb-3"></i>

            <p class="uppercase tracking-widest text-[10px] font-bold text-gray-600 mb-2">
                Silver Members
            </p>

            <h2 class="text-3xl font-black text-gray-700">
                156
            </h2>

        </div>


        {{-- BRONZE --}}
        <div class="bg-[#fff5ec] border border-[#ffd8b5] rounded-2xl p-5 text-center">

            <i data-lucide="star" class="w-5 h-5 mx-auto text-orange-600 mb-3"></i>

            <p class="uppercase tracking-widest text-[10px] font-bold text-orange-600 mb-2">
                Bronze Members
            </p>

            <h2 class="text-3xl font-black text-orange-600">
                842
            </h2>

        </div>

    </div>



    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

        {{-- SEARCH --}}
        <div class="p-4 flex justify-between items-center border-b">

            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[360px]">

                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search customer..."
                    class="bg-transparent outline-none w-full text-sm"
                >

            </div>


            <div class="flex gap-2">

                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="trending-up" class="w-4 h-4"></i>

                    Top Spenders

                </button>


                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="star" class="w-4 h-4"></i>

                    Tier Filter

                </button>

            </div>

        </div>



        {{-- TABLE --}}
        <table class="w-full">

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


            <tbody>

                @php
                    $customers = [
                        [
                            'name'=>'Budi Santoso',
                            'email'=>'budi.s@gmail.com',
                            'phone'=>'+62 812-3456-7890',
                            'spend'=>'Rp 2.450.000',
                            'visits'=>'12',
                            'points'=>'2450',
                            'tier'=>'Gold',
                            'img'=>'1'
                        ],
                        [
                            'name'=>'Maya Putri',
                            'email'=>'maya.p@outlook.com',
                            'phone'=>'+62 811-9876-5432',
                            'spend'=>'Rp 1.280.000',
                            'visits'=>'8',
                            'points'=>'1280',
                            'tier'=>'Silver',
                            'img'=>'2'
                        ],
                        [
                            'name'=>'Andi Wijaya',
                            'email'=>'andi.w@yahoo.com',
                            'phone'=>'+62 813-1122-3344',
                            'spend'=>'Rp 850.000',
                            'visits'=>'5',
                            'points'=>'850',
                            'tier'=>'Bronze',
                            'img'=>'3'
                        ],
                    ];
                @endphp


                @foreach($customers as $customer)

                <tr class="border-t hover:bg-gray-50 transition">

                    {{-- CUSTOMER --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-3">

                            <img
                                src="https://i.pravatar.cc/60?img={{ $customer['img'] }}"
                                class="w-12 h-12 rounded-xl object-cover"
                            >

                            <div>

                                <h3 class="font-bold text-base">
                                    {{ $customer['name'] }}
                                </h3>

                            </div>

                        </div>

                    </td>


                    {{-- CONTACT --}}
                    <td class="px-6 py-5">

                        <div class="space-y-1 text-sm text-gray-600">

                            <div class="flex items-center gap-2">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                {{ $customer['email'] }}
                            </div>

                            <div class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                {{ $customer['phone'] }}
                            </div>

                        </div>

                    </td>


                    {{-- SPEND --}}
                    <td class="px-6 py-5">

                        <h3 class="font-bold text-lg">
                            {{ $customer['spend'] }}
                        </h3>

                    </td>


                    {{-- VISITS --}}
                    <td class="px-6 py-5">

                        <div class="font-semibold text-sm">
                            {{ $customer['visits'] }} visits
                        </div>

                    </td>


                    {{-- POINTS --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">

                                <div class="bg-[#7f876e] h-full w-[70%] rounded-full"></div>

                            </div>

                            <span class="text-sm font-semibold text-[#7f876e]">
                                {{ $customer['points'] }} pts
                            </span>

                        </div>

                    </td>


                    {{-- TIER --}}
                    <td class="px-6 py-5">

                        @if($customer['tier'] == 'Gold')

                        <div class="bg-[#fff2c9] text-yellow-700 px-4 py-1 rounded-full text-xs font-bold inline-block">
                            GOLD
                        </div>

                        @elseif($customer['tier'] == 'Silver')

                        <div class="bg-gray-100 text-gray-600 px-4 py-1 rounded-full text-xs font-bold inline-block">
                            SILVER
                        </div>

                        @else

                        <div class="bg-[#ffe7d1] text-orange-700 px-4 py-1 rounded-full text-xs font-bold inline-block">
                            BRONZE
                        </div>

                        @endif

                    </td>


                    {{-- ACTION --}}
                    <td class="px-6 py-5">

                        <div class="flex gap-3 text-[#7b0000]">

                            <i data-lucide="history" class="w-4 h-4"></i>
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