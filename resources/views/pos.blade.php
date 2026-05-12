@extends('partials.sidebar')

@section('content')

<div class="flex gap-6">

    {{-- LEFT CONTENT --}}
    <div class="flex-1">

        {{-- CATEGORY --}}
        <div class="flex gap-4 mb-8 overflow-x-auto">

            <button class="bg-[#7b0000] text-white px-7 py-3 rounded-full text-sm font-bold whitespace-nowrap">
                All Products
            </button>

            <button class="bg-white border border-gray-200 px-7 py-3 rounded-full text-sm whitespace-nowrap">
                Coffee & Espresso
            </button>

            <button class="bg-white border border-gray-200 px-7 py-3 rounded-full text-sm whitespace-nowrap">
                Tea & Matcha
            </button>

            <button class="bg-white border border-gray-200 px-7 py-3 rounded-full text-sm whitespace-nowrap">
                Bakery & Pastry
            </button>

            <button class="bg-white border border-gray-200 px-7 py-3 rounded-full text-sm whitespace-nowrap">
                Merchandise
            </button>

        </div>



        {{-- PRODUCT GRID --}}
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">

            {{-- MANUAL ENTRY --}}
            <a href="{{ route('products.create') }}"
               class="border-2 border-dashed border-[#edd4d4] rounded-[30px] bg-white h-[280px] flex flex-col items-center justify-center text-center hover:bg-[#fff9f9] transition">

                <div class="w-20 h-20 rounded-full bg-[#f8e9e9] flex items-center justify-center mb-6">

                    <i data-lucide="plus"
                       class="w-10 h-10 text-[#7b0000]">
                    </i>

                </div>

                <h3 class="text-[20px] font-black text-[#7b0000] mb-3">
                    Manual Entry
                </h3>

                <p class="text-gray-400 text-base leading-relaxed px-8">
                    Add custom item not in catalog
                </p>

            </a>



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
                        'name'=>'Matcha Latte',
                        'category'=>'Tea & Matcha',
                        'price'=>'Rp 30.000',
                        'sku'=>'MT-02',
                        'img'=>'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?q=80&w=1200&auto=format&fit=crop'
                    ],
                ];
            @endphp



            {{-- PRODUCT CARD --}}
            @foreach($products as $product)

            <div class="bg-white rounded-[30px] overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">

                {{-- IMAGE --}}
                <div class="relative">

                    <img
                        src="{{ $product['img'] }}"
                        class="w-full h-[170px] object-cover"
                    >

                    <div class="absolute top-3 right-3 bg-[#ffe4e4] text-[#7b0000] text-[11px] font-bold px-4 py-2 rounded-full">
                        In Stock
                    </div>

                </div>



                {{-- CONTENT --}}
                <div class="p-5">

                    {{-- CATEGORY --}}
                    <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold mb-3">
                        {{ $product['category'] }}
                    </p>



                    {{-- PRODUCT NAME --}}
                    <h3 class="text-[16px] leading-tight font-black mb-6 min-h-[50px]">

                        {{ $product['name'] }}

                    </h3>



                    {{-- BOTTOM --}}
                    <div class="flex justify-between items-end">

                        {{-- PRICE --}}
                        <p class="text-[#7b0000] text-[14px] font-black">
                            {{ $product['price'] }}
                        </p>



                        {{-- SKU --}}
                        <div class="text-right">

                            <p class="text-[10px] text-gray-400 uppercase font-bold">
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



    {{-- RIGHT PANEL --}}
    <div class="w-[300px] bg-white rounded-[30px] border border-gray-200 shadow-sm p-6 h-fit sticky top-5">

        {{-- HEADER --}}
        <div class="mb-8">

            <h2 class="text-[28px] leading-none font-black text-[#7b0000] mb-3">
                Current Order
            </h2>

            <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold">
                ORDER #POS-8291 • DINE IN
            </p>

        </div>



        {{-- ORDER ITEM --}}
        <div class="flex gap-4 mb-8">

            <img
                src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1200&auto=format&fit=crop"
                class="w-16 h-16 rounded-2xl object-cover"
            >

            <div class="flex-1">

                <h3 class="font-black text-[16px] leading-tight mb-2">
                    Signature Caffe Latte
                </h3>

                <p class="text-gray-400 text-xs mb-4">
                    + Oat Milk, + Extra Shot
                </p>

                <div class="flex items-center gap-5 bg-[#f7f5f3] rounded-2xl px-4 py-2 w-fit">

                    <button class="font-black text-lg">-</button>

                    <span class="font-black text-lg">
                        2
                    </span>

                    <button class="font-black text-lg">+</button>

                </div>

            </div>

        </div>



        {{-- TOTAL --}}
        <div class="border-t pt-6 space-y-4">

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Subtotal
                </span>

                <span class="font-bold">
                    Rp 99.000
                </span>

            </div>

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Tax
                </span>

                <span class="font-bold">
                    Rp 9.900
                </span>

            </div>

            <div class="flex justify-between items-center">

                <span class="text-[20px] font-black">
                    Total
                </span>

                <span class="text-[#7b0000] text-[20px] font-black">
                    Rp 108.900
                </span>

            </div>

        </div>



        {{-- CHECKOUT --}}
        <button class="bg-[#7b0000] hover:bg-[#650000] text-white w-full py-4 rounded-2xl font-black text-lg mt-8 transition">

            Checkout

        </button>

    </div>

</div>

@endsection