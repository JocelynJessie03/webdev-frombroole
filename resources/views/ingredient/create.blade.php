@extends('partials.sidebar')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10 flex items-center gap-5">

        {{-- BUTTON BACK --}}
        <a href="{{ route('ingredient.inventory') }}" 
           class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-[#7b0000] hover:border-[#7b0000] hover:shadow-sm transition-all group">
            <i data-lucide="arrow-left" class="w-6 h-6 transition-transform group-hover:-translate-x-1"></i>
        </a>

        <div>
            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                Insert New Ingredient
            </h1>
        </div>

    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-3xl border shadow-sm p-10">

        <form action="{{ route('ingredient.store') }}"
              method="POST"
              class="space-y-8">

            @csrf

            {{-- INGREDIENT NAME --}}
            <div>
                <label class="block text-xl mb-3 font-bold text-gray-700">
                    Ingredient Name
                </label>
                <input
                    type="text"
                    name="name"
                    required
                    placeholder="e.g. Fresh Milk, Matcha Powder, Sugar Syrup"
                    class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                >
            </div>

            {{-- ROW 2: STOCK & UNIT --}}
            <div class="grid grid-cols-2 gap-6">

                {{-- INITIAL STOCK --}}
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Initial Stock
                    </label>
                    <input
                        type="number"
                        name="stock"
                        required
                        min="0"
                        step="1"
                        placeholder="e.g. 5000"
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] transition"
                    >
                </div>

                {{-- UNIT SELECTION --}}
                <div>
                    <label class="block text-xl mb-3 font-bold text-gray-700">
                        Measurement Unit
                    </label>
                    <select 
                        name="unit" 
                        required 
                        class="w-full h-14 border border-gray-300 rounded-xl px-5 outline-none focus:border-[#7b0000] bg-white transition"
                    >
                        <option value="" disabled selected>Select Unit</option>
                        <option value="gr">Gram (gr)</option>
                        <option value="ml">Mililiter (ml)</option>
                        <option value="pcs">Pieces (pcs)</option>
                    </select>
                </div>

            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="bg-[#7b0000] hover:bg-[#650000] text-white px-10 h-14 rounded-2xl font-bold text-lg transition shadow-md flex items-center gap-2"
                >
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Save Ingredient
                </button>
            </div>

        </form>

    </div>

</div>

@endsection