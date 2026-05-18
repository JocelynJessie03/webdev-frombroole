@extends('partials.sidebar')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10 flex items-center gap-5">
        {{-- BUTTON BACK --}}
        <a href="{{ route('product.inventory') }}" 
           class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-[#7b0000] hover:border-[#7b0000] hover:shadow-sm transition-all group">
            <i data-lucide="arrow-left" class="w-6 h-6 transition-transform group-hover:-translate-x-1"></i>
        </a>

        <div>
            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                Edit Product
            </h1>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-3xl border shadow-sm p-10">

        <form action="{{ route('product.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-3 gap-8">
                
                {{-- LEFT COLUMN: PRODUCT INFO --}}
                <div class="col-span-2 space-y-6">
                    {{-- PRODUCT NAME --}}
                    <div>
                        <label class="block text-xl mb-3 font-bold text-gray-700">Product Name</label>
                        <input type="text" name="pro_name" required
                               value="{{ old('pro_name', $product->pro_name) }}"
                               placeholder="e.g. Ice Matcha Latte"
                               class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition">
                    </div>

                    {{-- CATEGORY & PRICE --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xl mb-3 font-bold text-gray-700">Category</label>
                            <select name="category_id" required 
                                    class="w-full h-14 border border-gray-300 rounded-xl px-5 bg-white outline-none focus:border-[#7b0000] transition">
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xl mb-3 font-bold text-gray-700">Price (IDR)</label>
                            <input type="number" name="pro_price" required
                                   value="{{ old('pro_price', $product->pro_price) }}"
                                   placeholder="e.g. 25000"
                                   class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition">
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div>
                        <label class="block text-xl mb-3 font-bold text-gray-700">Description</label>
                        <textarea name="pro_description" rows="4" 
                                  placeholder="Write product description here..."
                                  class="w-full border border-gray-300 rounded-xl p-5 outline-none focus:border-[#7b0000] transition">{{ old('pro_description', $product->pro_description) }}</textarea>
                    </div>
                </div>

                {{-- RIGHT COLUMN: IMAGE UPLOAD --}}
                <div class="col-span-1">
                    <label class="block text-xl mb-3 font-bold text-gray-700">Product Image</label>
                    <div class="border border-dashed border-gray-300 rounded-2xl p-5 text-center bg-gray-50 flex flex-col items-center justify-center min-h-[280px]">
                        
                        @if($product->pro_image)
                            <img src="{{ asset('products/' . $product->pro_image) }}" alt="Preview" class="w-32 h-32 object-cover rounded-xl mb-3 shadow-sm">
                        @else
                            <i data-lucide="image" class="w-12 h-12 text-gray-400 mb-3"></i>
                        @endif

                        <input type="file" name="pro_image" class="text-sm text-gray-500 mt-2
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-[#f7ecec] file:text-[#7b0000]
                            hover:file:bg-[#edf2f7] transition cursor-pointer">
                        <p class="text-xs text-gray-400 mt-2">JPG, JPEG, or PNG (Max 2MB)</p>
                    </div>
                </div>

            </div>

            <hr class="border-gray-100">

            {{-- BILL OF MATERIALS (BOM) / RECIPE SECTION --}}
            <div>
                <h3 class="text-2xl font-black text-[#7b0000] mb-2">Recipe Configuration (BOM)</h3>
                <p class="text-sm text-gray-500 mb-6">Specify the amount of ingredients required to make one unit of this product.</p>

                <div class="grid grid-cols-2 gap-4 max-h-[300px] overflow-y-auto pr-2 entries-scroll-container">
                    @foreach($ingredients as $ingredient)
                        @php
                            // Cek apakah ingredient ini sudah terdaftar di resep produk ini sebelumnya
                            $pivotData = $product->ingredients->firstWhere('id', $ingredient->id);
                            $amountNeeded = $pivotData ? $pivotData->pivot->amount_needed : 0;
                        @endphp

                        <div class="flex items-center justify-between p-4 bg-gray-50 border rounded-xl hover:border-gray-300 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-white border flex items-center justify-center shadow-sm">
                                    <i data-lucide="package-2" class="w-5 h-5 text-gray-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $ingredient->name }}</h4>
                                    <span class="text-xs text-gray-400 uppercase font-semibold">Unit: {{ $ingredient->unit }}</span>
                                </div>
                            </div>

                            <div class="w-32 flex items-center gap-2 bg-white border rounded-lg px-3 py-1.5 focus-within:border-[#7b0000] transition">
                                <input type="number" 
                                       name="ingredients[{{ $ingredient->id }}]" 
                                       min="0" 
                                       step="0.01"
                                       value="{{ old('ingredients.'.$ingredient->id, $amountNeeded) }}"
                                       placeholder="0"
                                       class="w-full text-right outline-none text-sm font-bold text-gray-800">
                                <span class="text-xs text-gray-400 font-bold uppercase">{{ $ingredient->unit }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                        class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Product & Recipe
                </button>
            </div>

        </form>

    </div>

</div>

@endsection