@extends('partials.sidebar')

@section('content')

@php

    $subtotal = 0;

    foreach($cart as $item)
    {
        $subtotal += $item['price'] * $item['qty'];
    }

    $tax = $subtotal * 0.10;

    $total = $subtotal + $tax;

@endphp

<div class="max-w-6xl mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">

                <h1 class="text-4xl font-black text-[#7b0000] mb-8">
                    Checkout Preview
                </h1>



                {{-- ITEMS --}}
                <div class="space-y-6">

                    @foreach($cart as $item)

                        <div class="flex justify-between items-center border-b pb-5">

                            <div>

                                <h2 class="font-black text-xl mb-2">
                                    {{ $item['name'] }}
                                </h2>

                                <p class="text-gray-400">
                                    Qty : {{ $item['qty'] }}
                                </p>

                            </div>

                            <div class="text-right">

                                <p class="font-black text-[#7b0000] text-lg">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>



        {{-- RIGHT --}}
        <div>

            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 sticky top-5">

                <h2 class="text-2xl font-black mb-8">
                    Payment Summary
                </h2>



                {{-- TOTAL --}}
                <div class="space-y-5 mb-10">

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Subtotal
                        </span>

                        <span class="font-bold">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Tax
                        </span>

                        <span class="font-bold">
                            Rp {{ number_format($tax, 0, ',', '.') }}
                        </span>

                    </div>

                    <div class="flex justify-between items-center border-t pt-5">

                        <span class="text-2xl font-black">
                            Total
                        </span>

                        <span class="text-3xl font-black text-[#7b0000]">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>



                {{-- CUSTOMER --}}
                <div class="space-y-5 mb-10">

                    <div>

                        <label class="block text-sm font-bold mb-3">
                            Customer Name
                        </label>

                        <input
                            type="text"
                            placeholder="Input customer name"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#7b0000]"
                        >

                    </div>

                    <div>

                        <label class="block text-sm font-bold mb-3">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            placeholder="Input phone number"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#7b0000]"
                        >

                    </div>

                </div>



                {{-- PAYMENT METHOD --}}
                <div class="mb-10">

                    <h3 class="font-black mb-5">
                        Payment Method
                    </h3>

                    <div class="space-y-4">

                        <div class="border rounded-2xl p-4 flex items-center gap-4">

                            <input type="radio" checked>

                            <div>

                                <p class="font-bold">
                                    Midtrans Payment Gateway
                                </p>

                                <p class="text-sm text-gray-400">
                                    QRIS, Gopay, Dana, Bank Transfer
                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- PAYMENT BUTTON --}}
                <form action="{{ route('payment.process') }}" method="POST">

                    @csrf

                    <input
                        type="hidden"
                        name="cart"
                        value="{{ json_encode($cart) }}"
                    >

                    <button
                        type="submit"
                        class="w-full bg-[#7b0000] hover:bg-[#650000] text-white py-5 rounded-2xl font-black text-lg transition">

                        Process To Payment

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection