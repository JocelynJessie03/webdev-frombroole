@extends('partials.sidebar')

@section('content')

<div class="grid grid-cols-3 gap-8">

    {{-- LEFT --}}
    <div class="col-span-2 space-y-8">

        {{-- HERO --}}
        <div class="bg-gradient-to-br from-[#7b0000] to-[#930000] rounded-[40px] p-10 text-white">

            <p class="uppercase tracking-widest text-sm opacity-70 mb-3">
                Sales Summary
            </p>

            <h1 class="text-6xl font-black mb-8">
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </h1>

            <div class="flex gap-5">

                {{-- TOTAL ORDER --}}
                <div class="bg-white/20 px-6 py-3 rounded-full text-base font-semibold flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>

                    </svg>

                    {{ $totalOrders }} Orders

                </div>



                {{-- REPORT BUTTON --}}
                <a
                    href="{{ route('reports') }}"
                    class="bg-white text-[#7b0000] px-8 py-3 rounded-2xl text-base font-bold hover:bg-gray-100 transition inline-flex items-center justify-center"
                >

                    View Reports

                </a>



                {{-- POS BUTTON --}}
                <a
                    href="{{ route('pos') }}"
                    class="bg-[#7b0000] border border-white text-white px-8 py-3 rounded-2xl text-base font-bold hover:bg-[#5e0000] transition inline-flex items-center justify-center"
                >

                    Go To POS

                </a>

            </div>

        </div>



        {{-- STORE PERFORMANCE --}}
        <div class="bg-white rounded-[40px] p-10 shadow-sm">

            <div class="flex justify-between items-start mb-8">

                <div>

                    <h2 class="text-2xl font-black">
                        Store Performance
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Top performing products this week
                    </p>

                </div>

            </div>



            <div class="space-y-8">

                @foreach($bestSellers as $item)

                <div>

                    <p class="text-xs font-bold tracking-widest text-[#7b0000] uppercase mb-1">
                        BEST SELLER
                    </p>

                    <div class="flex justify-between mb-3">

                        <h3 class="text-lg font-bold">
                            {{ $item->product->pro_name }}
                        </h3>

                        <span class="text-base font-bold text-gray-700">
                            {{ $item->total_sold }} units sold
                        </span>

                    </div>

                    <div class="bg-gray-100 h-3 rounded-full overflow-hidden">

                        <div
                            class="bg-[#7b0000] h-full rounded-full"
                            style="width: {{ min($item->total_sold * 10, 100) }}%">
                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>



        {{-- INVENTORY STATUS --}}
        <div class="bg-white rounded-[40px] p-10 shadow-sm">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-2xl font-black">
                    Ingredients Inventory Status
                </h2>

                <a
                    href="{{ route('ingredient.inventory') }}"
                    class="text-sm font-bold text-[#7b0000] hover:underline"
                >

                    View Inventory →

                </a>

            </div>

            <div class="grid grid-cols-3 gap-4">

                @foreach($ingredients as $ingredient)

                <a
                    href="{{ route('ingredient.inventory') }}"
                    class="border border-gray-100 rounded-2xl p-5 hover:shadow-lg transition block"
                >

                    {{-- INGREDIENT NAME --}}
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $ingredient->name }}
                    </p>



                    {{-- STOCK --}}
                    <p class="text-2xl font-black text-[#7b0000] mb-3">

                        {{ $ingredient->stock }} {{ $ingredient->unit }}

                    </p>



                    {{-- STATUS --}}
                    <span class="text-xs font-bold px-3 py-1 rounded-full

                        @if($ingredient->stock <= 5)

                            bg-red-100 text-red-600

                        @elseif($ingredient->stock <= 15)

                            bg-yellow-100 text-yellow-700

                        @else

                            bg-green-100 text-green-700

                        @endif

                    ">

                        @if($ingredient->stock <= 5)

                            CRITICAL

                        @elseif($ingredient->stock <= 15)

                            LOW STOCK

                        @else

                            SAFE

                        @endif

                    </span>

                </a>

                @endforeach

            </div>

        </div>



        {{-- GROWTH --}}
        <div class="bg-[#f0ece8] rounded-[40px] p-10 flex items-center gap-8">

            <div class="w-16 h-16 bg-[#7b0000] rounded-2xl flex items-center justify-center flex-shrink-0">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-white"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>

                </svg>

            </div>

            <div class="flex-1">

                <h3 class="text-xl font-black mb-1">
                    Growth Metric
                </h3>

                <p class="text-sm text-gray-600">
                    Your sales performance is growing consistently based on live transaction data.
                </p>

            </div>

            <div class="bg-white rounded-2xl px-8 py-5 text-center flex-shrink-0">

                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">
                    TOTAL ORDERS
                </p>

                <p class="text-4xl font-black text-[#7b0000]">
                    {{ $totalOrders }}
                </p>

            </div>

        </div>

    </div>



    {{-- RIGHT --}}
    <div class="space-y-8">

        {{-- RECENT ORDERS --}}
        <div class="bg-white rounded-[40px] p-8 shadow-sm">

            <div class="flex items-center justify-between mb-8">

                <h2 class="text-3xl font-black">
                    Recent Orders
                </h2>

                <a
                    href="{{ route('order_history') }}"
                    class="text-sm font-bold text-[#7b0000] hover:underline"
                >

                    View All →

                </a>

            </div>



            <div class="space-y-5">

                @foreach($recentOrders as $order)

                <a
                    href="{{ route('order_history') }}"
                    class="block border border-gray-100 rounded-3xl p-5 hover:shadow-lg transition"
                >

                    <div class="flex items-start justify-between mb-4">

                        <div>

                            <p class="text-xs text-gray-400 mb-1">
                                ORDER ID
                            </p>

                            <h3 class="font-black text-lg">
                                {{ $order->order_id }}
                            </h3>

                        </div>



                        <span class="px-4 py-2 rounded-full text-xs font-bold

                            @if($order->status == 'Complete')

                                bg-green-100 text-green-700

                            @elseif($order->status == 'Pending')

                                bg-yellow-100 text-yellow-700

                            @else

                                bg-red-100 text-red-600

                            @endif

                        ">

                            {{ strtoupper($order->status) }}

                        </span>

                    </div>



                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ $order->customer->customer_name ?? 'Guest Customer' }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}
                            </p>

                        </div>



                        <p class="text-xl font-black text-[#7b0000]">

                            Rp {{ number_format($order->total_price, 0, ',', '.') }}

                        </p>

                    </div>

                </a>

                @endforeach

            </div>

        </div>



        {{-- LOW STOCK ALERT --}}
        <div class="bg-white rounded-[40px] p-8 shadow-sm">

            <div class="flex items-center justify-between mb-8">

                <h2 class="text-3xl font-black">
                    Low Stock Alert
                </h2>

                <a
                    href="{{ route('product.inventory') }}"
                    class="text-sm font-bold text-[#7b0000] hover:underline"
                >

                    View Products →

                </a>

            </div>

            <div class="space-y-5">

                @foreach($lowStocks as $product)

                <a
                    href="{{ route('product.inventory') }}"
                    class="flex items-center gap-5 border border-gray-100 rounded-3xl p-5 hover:shadow-lg transition block"
                >

                    <div class="w-16 h-16 rounded-2xl overflow-hidden bg-[#f5f5f5] flex items-center justify-center shrink-0">

                        @if($product->pro_image)

                            <img
                                src="{{ asset('products/' . $product->pro_image) }}"
                                class="w-full h-full object-cover">

                        @else

                            <span class="text-xs text-gray-400">
                                PRODUCT
                            </span>

                        @endif

                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="font-bold text-lg">
                                    {{ $product->pro_name }}
                                </h3>

                                <p class="text-[#7b0000] font-black text-2xl">

                                    {{ $product->calculated_stock }} left

                                </p>

                            </div>

                            <span class="

                                @if($product->calculated_stock <= 0)

                                    bg-red-100 text-red-600

                                @elseif($product->calculated_stock <= 10)

                                    bg-yellow-100 text-yellow-700

                                @else

                                    bg-green-100 text-green-700

                                @endif

                                text-sm font-bold px-4 py-2 rounded-full

                            ">

                                @if($product->calculated_stock <= 0)

                                    OUT

                                @elseif($product->calculated_stock <= 10)

                                    LOW

                                @else

                                    SAFE

                                @endif

                            </span>

                        </div>

                    </div>

                </a>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection