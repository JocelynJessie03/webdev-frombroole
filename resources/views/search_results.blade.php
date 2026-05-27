@extends('partials.sidebar')

@section('content')

<div class="space-y-10">

    <div>

        <h1 class="text-5xl font-black text-[#7b0000] mb-3">
            Search Results
        </h1>

        <p class="text-gray-500">
            Result for:
            <span class="font-bold">{{ $search }}</span>
        </p>

    </div>



    {{-- PRODUCTS --}}
    <div class="bg-white rounded-[40px] p-10 shadow-sm">

        <h2 class="text-3xl font-black mb-6">
            Products
        </h2>

        <div class="space-y-4">

            @forelse($products as $product)

            <div class="border rounded-2xl p-5 flex justify-between items-center">

                <div>

                    <h3 class="font-black text-xl">
                        {{ $product->pro_name }}
                    </h3>

                    <p class="text-gray-500">
                        Product
                    </p>

                </div>

                <a
                    href="{{ route('product.inventory') }}"
                    class="text-[#7b0000] font-bold"
                >

                    View →

                </a>

            </div>

            @empty

            <p class="text-gray-400">
                No product found.
            </p>

            @endforelse

        </div>

    </div>



    {{-- CUSTOMERS --}}
    <div class="bg-white rounded-[40px] p-10 shadow-sm">

        <h2 class="text-3xl font-black mb-6">
            Customers
        </h2>

        <div class="space-y-4">

            @forelse($customers as $customer)

            <div class="border rounded-2xl p-5 flex justify-between items-center">

                <div>

                    <h3 class="font-black text-xl">
                        {{ $customer->customer_name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ $customer->phone_number }}
                    </p>

                </div>

                <a
                    href="{{ route('customers') }}"
                    class="text-[#7b0000] font-bold"
                >

                    View →

                </a>

            </div>

            @empty

            <p class="text-gray-400">
                No customer found.
            </p>

            @endforelse

        </div>

    </div>



    {{-- ORDERS --}}
    <div class="bg-white rounded-[40px] p-10 shadow-sm">

        <h2 class="text-3xl font-black mb-6">
            Orders
        </h2>

        <div class="space-y-4">

            @forelse($orders as $order)

            <div class="border rounded-2xl p-5 flex justify-between items-center">

                <div>

                    <h3 class="font-black text-xl">
                        {{ $order->order_id }}
                    </h3>

                    <p class="text-gray-500">
                        Rp {{ number_format($order->total_price,0,',','.') }}
                    </p>

                </div>

                <a
                    href="{{ route('order_history') }}"
                    class="text-[#7b0000] font-bold"
                >

                    View →

                </a>

            </div>

            @empty

            <p class="text-gray-400">
                No order found.
            </p>

            @endforelse

        </div>

    </div>

</div>

@endsection

