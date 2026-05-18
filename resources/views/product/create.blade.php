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
            Insert New Product
        </h1>
    </div>

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
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Product Name
                    </label>
                    <input
                        type="text"
                        name="pro_name"
                        required
                        placeholder="e.g. Premium Matcha Latte"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                    >
                </div>

                {{-- PRICE --}}
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Price (Rp)
                    </label>
                    <input
                        type="number"
                        name="pro_price"
                        required
                        placeholder="e.g. 35000"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                    >
                </div>

            </div>

            {{-- ROW 2: CATEGORY & IMAGE --}}
            <div class="grid grid-cols-2 gap-6">

                {{-- CATEGORY --}}
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Category
                    </label>
                    <select 
                        name="category_id" 
                        required 
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] bg-white transition"
                    >
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- PRODUCT IMAGE --}}
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Product Image
                    </label>
                    <input
                        type="file"
                        name="pro_image"
                        accept="image/*"
                        class="w-full border border-gray-300 rounded-xl p-3 file:mr-4 file:py-1 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#f7ecec] file:text-[#7b0000] hover:file:bg-[#edd8d8]"
                    >
                </div>

            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-xl mb-3 font-bold text-gray-700">
                    Product Details
                </label>
                <textarea
                    name="pro_description"
                    placeholder="Input product details here..."
                    rows="3"
                    class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none focus:border-[#7b0000] transition"
                ></textarea>
            </div>

            <hr class="border-gray-100">

            {{-- DYNAMIC INGREDIENTS (BOM RECIPE) --}}
            <div>
                <div class="mb-2">
                    <label class="block text-xl font-bold text-gray-700">
                        Recipe & Ingredients (BOM)
                    </label>
                    <p class="text-gray-400 text-sm">
                        Select the ingredients from database and set the amount needed to create 1 unit of this product.
                    </p>
                </div>

                {{-- Grid List Ingredient dari Database --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
                    @foreach($ingredients as $ingredient)
                    <div class="border rounded-2xl p-4 flex items-center justify-between bg-gray-50/50 hover:bg-white transition ingredient-card">
                        
                        <div class="flex items-center gap-3">
                            <input 
                                type="checkbox" 
                                id="ing-{{ $ingredient->id }}"
                                class="w-5 h-5 rounded text-[#7b0000] focus:ring-[#7b0000] border-gray-300 ingredient-checkbox"
                                onchange="toggleQuantityInput(this, 'input-ing-{{ $ingredient->id }}')"
                            >
                            <label for="ing-{{ $ingredient->id }}" class="font-bold text-gray-700 select-none cursor-pointer">
                                {{ $ingredient->name }}
                                <span class="block text-xs font-normal text-gray-400">Unit: {{ $ingredient->unit }}</span>
                            </label>
                        </div>

                        {{-- Input Jumlah (Akan aktif jika checkbox di-centang) --}}
                        <div class="w-28">
                            <input 
                                type="number" 
                                id="input-ing-{{ $ingredient->id }}"
                                name="ingredients[{{ $ingredient->id }}]" 
                                value="0" 
                                min="0" 
                                step="0.01"
                                disabled
                                placeholder="Amount"
                                class="w-full h-10 text-center border border-gray-200 bg-gray-100 rounded-xl outline-none focus:border-[#7b0000] focus:bg-white transition text-sm font-bold"
                            >
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2"
                >
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Save Product & Recipe
                </button>
            </div>

        </form>

    </div>

</div>

<script>
    // Fungsi untuk mengaktifkan/menonaktifkan input jumlah berdasarkan checkbox
    function toggleQuantityInput(checkbox, inputId) {
        const inputField = document.getElementById(inputId);
        const card = checkbox.closest('.ingredient-card');
        
        if (checkbox.checked) {
            inputField.removeAttribute('disabled');
            inputField.classList.remove('bg-gray-100', 'border-gray-200');
            inputField.classList.add('bg-white', 'border-gray-400');
            card.classList.add('border-[#7b0000]', 'bg-white');
            if(inputField.value == 0) inputField.value = '';
            inputField.focus();
        } else {
            inputField.setAttribute('disabled', 'disabled');
            inputField.value = '0';
            inputField.classList.remove('bg-white', 'border-gray-400');
            inputField.classList.add('bg-gray-100', 'border-gray-200');
            card.classList.remove('border-[#7b0000]', 'bg-white');
        }
    }
</script>

@endsection