@extends('partials.sidebar')

@section('content')

<div class="flex gap-6">

    {{-- LEFT CONTENT --}}
    <div class="flex-1">

        {{-- CATEGORY --}}
        <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
            {{-- Button All Products --}}
            <a href="{{ route('pos') }}" 
            class="{{ !request('category') ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200' }} px-7 py-3 rounded-full text-sm font-bold whitespace-nowrap transition">
                All Products
            </a>

            {{-- Looping Kategori dari Database --}}
            @foreach($categories as $category)
            <a href="{{ route('pos', ['category' => $category->id]) }}" 
            class="{{ request('category') == $category->id ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200' }} px-7 py-3 rounded-full text-sm whitespace-nowrap transition hover:border-[#7b0000]">
                {{ $category->category_name }}
            </a>
            @endforeach
        </div>



        {{-- PRODUCT GRID --}}
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">

            {{-- PRODUCT CARD --}}
           @foreach($products as $product)
            <div class="bg-white rounded-[30px] overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                
                {{-- IMAGE --}}
                <div class="relative group overflow-hidden h-[170px] bg-gray-100">
                    @if($product->pro_image)
                        <img src="{{ asset('storage/' . $product->pro_image) }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <i data-lucide="image" class="w-10 h-10"></i>
                        </div>
                    @endif

                    <div class="absolute top-3 right-3 bg-[#eaf8ef] text-green-700 text-[11px] font-bold px-4 py-2 rounded-full z-10">
                        Available
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="p-5">
                    <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold mb-3">
                        {{ $product->category->category_name ?? 'Uncategorized' }}
                    </p>

                    <h3 class="text-[16px] leading-tight font-black mb-6 min-h-[50px]">
                        {{ $product->pro_name }}
                    </h3>

                    <div class="flex justify-between items-end">
                        <p class="text-[#7b0000] text-[14px] font-black">
                            Rp {{ number_format($product->pro_price, 0, ',', '.') }}
                        </p>

                        <div class="text-right">
                            <p class="text-[10px] text-gray-400 uppercase font-bold">ID:</p>
                            <p class="text-[11px] text-gray-400 font-bold">{{ $product->pro_ID }}</p>
                        </div>
                    </div>

                    <button class="w-full mt-4 bg-[#f7f5f3] hover:bg-[#7b0000] hover:text-white py-3 rounded-2xl text-[11px] font-black transition-all">
                        ADD TO ORDER
                    </button>
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



        {{-- CUSTOMER FORM --}}
        <div class="mt-8 space-y-4">

            {{-- NAME --}}
            <div>

                <label class="text-xs uppercase tracking-[3px] text-gray-400 font-bold mb-3 block">
                    Customer Name
                </label>

                <input
                    type="text"
                    placeholder="Enter customer name"
                    class="w-full bg-[#f7f5f3] border border-transparent focus:border-[#7b0000] focus:ring-0 rounded-2xl px-5 py-4 text-sm font-medium outline-none transition"
                >

            </div>



            {{-- PHONE --}}
            <div>

                <label class="text-xs uppercase tracking-[3px] text-gray-400 font-bold mb-3 block">
                    Phone Number
                </label>

                <input
                    type="text"
                    placeholder="Enter phone number"
                    class="w-full bg-[#f7f5f3] border border-transparent focus:border-[#7b0000] focus:ring-0 rounded-2xl px-5 py-4 text-sm font-medium outline-none transition"
                >

            </div>

        </div>



        {{-- CHECKOUT --}}
        <button class="bg-[#7b0000] hover:bg-[#650000] text-white w-full py-4 rounded-2xl font-black text-lg mt-8 transition">

            Checkout

        </button>

    </div>

</div>

@endsection