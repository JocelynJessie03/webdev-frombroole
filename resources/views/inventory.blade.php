@extends('layouts.app')

@section('content')

<div class="space-y-5">

    {{-- HEADER --}}
    <div>

        <h1 class="text-[32px] font-black text-[#7b0000] leading-none mb-2">
            Inventory Central
        </h1>

        <p class="text-gray-600 text-sm max-w-3xl leading-relaxed">
            Manage your stock, track product movements, and optimize your supply chain with our
            real-time steward engine.
        </p>

    </div>



    {{-- TOP CARDS --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">

                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>

                </div>

                <div class="bg-[#f7dede] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    +2.4%
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Items
            </p>

            <h2 class="text-4xl font-black text-[#7b0000]">
                1,284
            </h2>

        </div>



        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#fff3f3] flex items-center justify-center">

                    <i data-lucide="triangle-alert" class="w-5 h-5 text-red-600"></i>

                </div>

                <div class="bg-[#ffdede] text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                    Attention Required
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Low Stock
            </p>

            <h2 class="text-4xl font-black text-black">
                18
            </h2>

        </div>



        {{-- CARD --}}
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">

                    <i data-lucide="trending-up" class="w-5 h-5"></i>

                </div>

                <div class="bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Total Value
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Inventory Value
            </p>

            <h2 class="text-4xl font-black">
                Rp 42.8M
            </h2>

        </div>

    </div>



    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

        {{-- TOP BAR --}}
        <div class="p-5 flex justify-between items-center border-b">

            {{-- FILTER --}}
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">

                <button class="bg-white shadow px-4 py-2 rounded-lg font-bold text-sm text-[#7b0000]">
                    All
                </button>

                <button class="px-4 py-2 rounded-lg font-semibold text-sm text-gray-500">
                    Low Stock
                </button>

                <button class="px-4 py-2 rounded-lg font-semibold text-sm text-gray-500">
                    Out of Stock
                </button>

            </div>



            {{-- ACTIONS --}}
            <div class="flex gap-3">

                <button class="border px-4 py-2 rounded-xl font-bold text-sm flex items-center gap-2">

                    <i data-lucide="filter" class="w-4 h-4"></i>

                    Filters

                </button>

                <button class="border px-4 py-2 rounded-xl font-bold text-sm flex items-center gap-2">

                    <i data-lucide="download" class="w-4 h-4"></i>

                    Export

                </button>

            </div>

        </div>



        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                {{-- HEAD --}}
                <thead>

                    <tr class="text-left border-b">

                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Product
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            SKU
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Category
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Price
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Stock
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Status
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Action
                        </th>

                    </tr>

                </thead>



                {{-- BODY --}}
                <tbody>

                    @php
                        $products = [
                            [
                                'name'=>'Aura Noise-Canceling Headphones',
                                'sku'=>'AUD-NC-992',
                                'category'=>'Electronics',
                                'price'=>'Rp 3.450.000',
                                'stock'=>'42',
                                'status'=>'In Stock',
                                'image'=>'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1200&auto=format&fit=crop'
                            ],
                            [
                                'name'=>'Smart Coffee Brewer',
                                'sku'=>'CF-BR-102',
                                'category'=>'Appliances',
                                'price'=>'Rp 1.850.000',
                                'stock'=>'12',
                                'status'=>'Low Stock',
                                'image'=>'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=1200&auto=format&fit=crop'
                            ],
                            [
                                'name'=>'Minimal Desk Lamp',
                                'sku'=>'LMP-204',
                                'category'=>'Furniture',
                                'price'=>'Rp 720.000',
                                'stock'=>'0',
                                'status'=>'Out of Stock',
                                'image'=>'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1200&auto=format&fit=crop'
                            ],
                        ];
                    @endphp



                    @foreach($products as $product)

                    <tr class="border-b last:border-0 hover:bg-gray-50 transition">

                        {{-- PRODUCT --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <img
                                    src="{{ $product['image'] }}"
                                    class="w-12 h-12 rounded-xl object-cover"
                                >

                                <div>

                                    <h3 class="font-bold text-base leading-tight">
                                        {{ $product['name'] }}
                                    </h3>

                                </div>

                            </div>

                        </td>



                        {{-- SKU --}}
                        <td class="px-4 py-5 text-gray-400 text-sm font-semibold">
                            {{ $product['sku'] }}
                        </td>



                        {{-- CATEGORY --}}
                        <td class="px-4 py-5 text-sm font-medium">
                            {{ $product['category'] }}
                        </td>



                        {{-- PRICE --}}
                        <td class="px-4 py-5">

                            <div class="font-black text-lg leading-tight">
                                {{ $product['price'] }}
                            </div>

                        </td>



                        {{-- STOCK --}}
                        <td class="px-4 py-5 text-lg font-black">
                            {{ $product['stock'] }}
                        </td>



                        {{-- STATUS --}}
                        <td class="px-4 py-5">

                            @if($product['status'] == 'In Stock')

                            <span class="bg-[#f8e9e9] text-[#7b0000] px-3 py-1 rounded-full text-xs font-bold">
                                IN STOCK
                            </span>

                            @elseif($product['status'] == 'Low Stock')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                LOW STOCK
                            </span>

                            @else

                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                                OUT OF STOCK
                            </span>

                            @endif

                        </td>



                        {{-- ACTION --}}
                        <td class="px-4 py-5">

                            <button class="text-gray-400 hover:text-black">

                                <i data-lucide="ellipsis" class="w-5 h-5"></i>

                            </button>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection