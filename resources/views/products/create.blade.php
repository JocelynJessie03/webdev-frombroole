@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">

        <h1 class="text-5xl font-black text-[#7b0000]">
            Insert New Product
        </h1>

    </div>



    {{-- FORM CARD --}}
    <div class="bg-white rounded-3xl border shadow-sm p-10">

        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">

            @csrf



            {{-- ROW 1 --}}
            <div class="grid grid-cols-2 gap-6">

                {{-- PRODUCT NAME --}}
                <div>

                    <label class="block text-xl mb-3">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="pro_name"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none"
                    >

                </div>



                {{-- PRICE --}}
                <div>

                    <label class="block text-xl mb-3">
                        Price
                    </label>

                    <input
                        type="number"
                        name="pro_price"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none"
                    >

                </div>

            </div>



            {{-- DESCRIPTION --}}
            <div>

                <label class="block text-xl mb-3">
                    Product Details
                </label>

                <textarea
                    name="pro_description"
                    placeholder="Input product details here..."
                    rows="3"
                    class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none"
                ></textarea>

            </div>



            {{-- STOCK --}}
            <div>

                <label class="block text-xl mb-3">
                    Initial Stock
                </label>

                <input
                    type="number"
                    name="pro_currstock"
                    class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none"
                >

            </div>



            {{-- PRODUCT IMAGE --}}
            <div>

                <label class="block text-xl mb-3">
                    Product Image
                </label>

                <input
                    type="file"
                    name="pro_image"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-xl p-4"
                >

            </div>



            {{-- BUTTON --}}
            <button
                type="submit"
                class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition"
            >

                Add Product

            </button>

        </form>

    </div>

</div>

@endsection