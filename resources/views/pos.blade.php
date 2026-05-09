@extends('layouts.app')

@section('content')

<div class="flex gap-4 items-start">

    {{-- LEFT SIDE --}}
    <div class="flex-1 space-y-4">

        {{-- CATEGORY --}}
        <div class="flex gap-3 overflow-x-auto pb-1">

            <button class="bg-[#7b0000] text-white px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap">
                All Products
            </button>

            <button class="bg-white border px-5 py-2 rounded-full text-sm whitespace-nowrap">
                Coffee & Espresso
            </button>

            <button class="bg-white border px-5 py-2 rounded-full text-sm whitespace-nowrap">
                Tea & Matcha
            </button>

            <button class="bg-white border px-5 py-2 rounded-full text-sm whitespace-nowrap">
                Bakery & Pastry
            </button>

            <button class="bg-white border px-5 py-2 rounded-full text-sm whitespace-nowrap">
                Merchandise
            </button>

        </div>



        {{-- PRODUCTS --}}
        <div class="grid grid-cols-3 xl:grid-cols-4 gap-4 items-start">

            {{-- MANUAL ENTRY --}}
            <div class="border-2 border-dashed border-[#e5cfcf] rounded-3xl p-5 flex flex-col items-center justify-center text-center h-[300px] bg-white">

                <div class="w-16 h-16 bg-[#f5e6e6] rounded-full flex items-center justify-center mb-5">

                    <i data-lucide="plus" class="w-7 h-7 text-[#7b0000]"></i>

                </div>

                <h3 class="font-bold text-2xl text-[#7b0000] mb-3">
                    Manual Entry
                </h3>

                <p class="text-gray-500 text-sm">
                    Add custom item not in catalog
                </p>

            </div>



            @php
                $products = [
                    [
                        'name'=>'Signature Caffe Latte',
                        'category'=>'Coffee & Espresso',
                        'price'=>'Rp 32.000',
                        'sku'=>'CF-01',
                        'img'=>'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1200&auto=format&fit=crop'
                    ],
                    [
                        'name'=>'Arabica Gayo Special',
                        'category'=>'Beans (Retail)',
                        'price'=>'Rp 145.000',
                        'sku'=>'BN-04',
                        'img'=>'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop'
                    ],
                    [
                        'name'=>'Double Shot Flat White',
                        'category'=>'Coffee & Espresso',
                        'price'=>'Rp 35.000',
                        'sku'=>'CF-02',
                        'img'=>'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=1200&auto=format&fit=crop'
                    ],
                    [
                        'name'=>'Butter Croissant',
                        'category'=>'Bakery',
                        'price'=>'Rp 22.000',
                        'sku'=>'BK-01',
                        'img'=>'https://images.unsplash.com/photo-1555507036-ab794f4afe5a?q=80&w=1200&auto=format&fit=crop'
                    ],
                    [
                        'name'=>'Matcha Latte',
                        'category'=>'Tea & Matcha',
                        'price'=>'Rp 30.000',
                        'sku'=>'MT-02',
                        'img'=>'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?q=80&w=1200&auto=format&fit=crop'
                    ],
                    [
                        'name'=>'Espresso',
                        'category'=>'Coffee',
                        'price'=>'Rp 20.000',
                        'sku'=>'CF-09',
                        'img'=>'https://images.unsplash.com/photo-1497636577773-f1231844b336?q=80&w=1200&auto=format&fit=crop'
                    ],
                ];
            @endphp



            @foreach($products as $product)

            {{-- PRODUCT CARD --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border hover:shadow-md transition flex flex-col">

                {{-- IMAGE --}}
                <div class="relative">

                    <img
                        src="{{ $product['img'] }}"
                        class="w-full h-[160px] object-cover"
                    >

                    <div class="absolute top-3 right-3 bg-[#f5d9d9] text-[#7b0000] text-[10px] font-bold px-3 py-1 rounded-full">
                        In Stock
                    </div>

                </div>



                {{-- CONTENT --}}
                <div class="p-4 flex flex-col flex-1 justify-between">

                    <div>

                        {{-- CATEGORY --}}
                        <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">
                            {{ $product['category'] }}
                        </p>


                        {{-- TITLE --}}
                        <h3 class="font-bold text-[16px] leading-tight min-h-[60px]">

                            {{ $product['name'] }}

                        </h3>

                    </div>



                    {{-- PRICE --}}
                    <div class="flex justify-between items-end pt-4">

                        {{-- LEFT --}}
                        <p class="text-[#7b0000] text-[18px] font-black leading-none">
                            {{ $product['price'] }}
                        </p>


                        {{-- RIGHT --}}
                        <div class="text-right leading-tight">

                            <p class="text-[10px] text-gray-400 font-semibold uppercase">
                                SKU:
                            </p>

                            <p class="text-[11px] text-gray-400 font-bold">
                                {{ $product['sku'] }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>



    {{-- RIGHT SIDE --}}
    <div class="w-[320px] bg-white rounded-3xl border shadow-sm p-5 sticky top-5">

        <div class="mb-6">

            <h2 class="text-3xl font-black text-[#7b0000] mb-2">
                Current Order
            </h2>

            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold">
                Order #POS-8291 • Dine In
            </p>

        </div>



        {{-- ORDER ITEMS --}}
        <div class="space-y-5">

            {{-- ITEM --}}
            <div class="flex gap-3">

                <img
                    src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1200&auto=format&fit=crop"
                    class="w-16 h-16 rounded-2xl object-cover"
                >

                <div class="flex-1">

                    <h3 class="font-bold text-base">
                        Signature Caffe Latte
                    </h3>

                    <p class="text-xs text-gray-400 mb-3">
                        + Oat Milk, + Extra Shot
                    </p>

                    <div class="flex items-center gap-3 bg-[#f7f5f3] rounded-xl px-3 py-2 w-fit">

                        <button class="font-bold">-</button>

                        <span class="font-bold">
                            2
                        </span>

                        <button class="font-bold">+</button>

                    </div>

                </div>

            </div>



            {{-- ITEM --}}
            <div class="flex gap-3">

                <img
                    src="https://images.unsplash.com/photo-1555507036-ab794f4afe5a?q=80&w=1200&auto=format&fit=crop"
                    class="w-16 h-16 rounded-2xl object-cover"
                >

                <div class="flex-1">

                    <h3 class="font-bold text-base">
                        Pain au Chocolate
                    </h3>

                    <p class="text-xs text-gray-400 mb-3">
                        Freshly baked
                    </p>

                    <div class="flex items-center gap-3 bg-[#f7f5f3] rounded-xl px-3 py-2 w-fit">

                        <button class="font-bold">-</button>

                        <span class="font-bold">
                            1
                        </span>

                        <button class="font-bold">+</button>

                    </div>

                </div>

            </div>

        </div>



        {{-- TOTAL --}}
        <div class="border-t mt-6 pt-5 space-y-3">

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Subtotal
                </span>

                <span class="font-semibold">
                    Rp 99.000
                </span>

            </div>

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Tax
                </span>

                <span class="font-semibold">
                    Rp 9.900
                </span>

            </div>

            <div class="flex justify-between text-lg font-black">

                <span>
                    Total
                </span>

                <span class="text-[#7b0000]">
                    Rp 108.900
                </span>

            </div>

        </div>



        {{-- CHECKOUT --}}
        <button class="bg-[#7b0000] hover:bg-[#650000] text-white w-full py-3 rounded-2xl font-bold mt-6">

            Checkout

        </button>

    </div>

</div>

@endsection