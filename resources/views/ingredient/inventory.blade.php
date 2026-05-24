@extends('partials.sidebar')

@section('content')

<div class="space-y-5">

    {{-- HEADER --}}
    <div>

        <h1 class="text-[32px] font-black text-[#7b0000] leading-none mb-2">
            Ingredient Inventory
        </h1>

        <p class="text-gray-600 text-sm max-w-3xl leading-relaxed">
            Manage your ingredient stock, monitor raw material availability, and track kitchen inventory in real time.
        </p>

    </div>



    {{-- TOP CARDS --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>
                </div>
            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Ingredients
            </p>

            <h2 class="text-4xl font-black text-[#7b0000]">
                {{ $totalIngredients }}
            </h2>

        </div>



        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

    
                {{-- Icon Alert: Warnanya berubah jadi abu-abu kalau stock aman (0) --}}
                <div class="w-12 h-12 rounded-xl {{ $lowStockCount > 0 ? 'bg-[#fff3f3]' : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                    <i data-lucide="triangle-alert" class="w-5 h-5 {{ $lowStockCount > 0 ? 'text-red-600' : 'text-gray-400' }}"></i>
                </div>
                
                {{-- Logic Blade: Badge HANYA muncul kalau ada barang Low Stock --}}
                @if($lowStockCount > 0)
                    <div class="bg-[#ffdede] text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                        Attention Required
                    </div>
                @endif
            
            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Low Stock
            </p>

            <h2 class="text-4xl font-black text-black">
                {{ $lowStockCount }}
            </h2>

        </div>



        {{-- CARD --}}
        {{-- CARD 3: USED TODAY --}}
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i data-lucide="activity" class="w-5 h-5 text-white"></i>
                </div>
                
                @if($usedTodayCount > 0)
                    <div class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full border border-white/30">
                        Active Kitchen
                    </div>
                @else
                    <div class="bg-white/10 text-white/50 text-xs font-bold px-3 py-1 rounded-full">
                        No Activity
                    </div>
                @endif
            </div>
            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Used Today
            </p>
            <h2 class="text-4xl font-black">
                {{ $usedTodayCount }} <span class="text-lg font-normal text-white/70">Items</span>
            </h2>
        </div>
    </div>



        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

            {{-- TOP BAR --}}
            <div class="p-5 flex justify-between items-center border-b">

                {{-- FILTER --}}
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">

            {{-- Button All --}}
            <a href="{{ route('ingredient.inventory') }}" 
            class="{{ !request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                All
            </a>

            {{-- Button Low Stock --}}
            <a href="{{ route('ingredient.inventory', ['filter' => 'low_stock']) }}" 
            class="{{ request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                Low Stock
            </a>

            {{-- Button Packaging--}}
            <a href="{{ route('ingredient.inventory', ['filter' => 'out_of_stock']) }}" 
            class="{{ request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                Out Of Stock
            </a>
            
    </div>
   {{-- INPUT SEARCH BAR --}}
            <div class="bg-[#f6f3f1] rounded-xl px-4 py-2.5 flex items-center gap-3 w-[280px] focus-within:ring-2 focus-within:ring-[#7b0000]/20 transition">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search product..." 
                       class="bg-transparent outline-none w-full text-sm font-plain text-gray-700 placeholder-gray-400">
            </div>


            {{-- ACTIONS --}}
            <div class="flex items-center gap-3">
    <a href="{{ route('ingredient.create') }}"
       class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Add Ingredient
    </a>
</div>

        </div>



        {{-- TABLE CONTENT --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                {{-- HEAD --}}
                <thead>

                    <tr class="text-left border-b">

                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Ingredient
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Stock
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Unit
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Status
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Action
                        </th>

                    </tr>

                </thead>



        {{-- BODY --}}
        <tbody>

        @foreach($ingredients as $ingredient)
            <tr class="border-b last:border-0 hover:bg-gray-50 transition">

                {{-- INGREDIENT NAME --}}
                <td class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-[#f8e9e9] flex items-center justify-center">
                            <i data-lucide="package-2" class="w-5 h-5 text-[#7b0000]"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base leading-tight">
                                {{ $ingredient->name }}
                            </h3>
                        </div>
                    </div>
                </td>

                {{-- STOCK --}}
                <td class="px-4 py-5 text-lg font-black">
                    {{ number_format($ingredient->stock) }}
                </td>

                {{-- UNIT --}}
                <td class="px-4 py-5 text-sm font-semibold text-gray-500 uppercase">
                    {{ $ingredient->unit }}
                </td>

                {{-- STATUS --}}
                <td class="px-4 py-5">

                    @if($ingredient->is_low_stock)

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">

                            LOW STOCK

                        </span>

                    @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">

                            IN STOCK

                        </span>

                    @endif

                </td>


                {{-- ACTION --}}
                <td class="px-4 py-5">
                    <div class="relative">

                {{-- BUTTON --}}
                <button
                    onclick="toggleDropdown(this)"
                    class="text-gray-400 hover:text-black p-2 rounded-lg hover:bg-gray-100 transition">
                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                    </button>
                        {{-- DROPDOWN --}}
                        <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                            {{-- EDIT --}}
                                    {{-- EDIT (Ubah menjadi tag <a>) --}}
                                    <a href="{{ route('ingredient.edit', $ingredient->id) }}"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        Edit Ingredient
                                    </a>



                                    {{-- DELETE --}}
                                    
                                        <form action="{{ route('ingredient.destroy', $ingredient->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $ingredient->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            Delete Ingredient
                                        </button>
                                    </form>
                                    </form>

                                </div>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>



<script>

    function toggleDropdown(button) {
        const dropdown = button.parentElement.querySelector('.action-dropdown');
        
        // 1. Tutup semua dropdown lain yang sedang terbuka
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            if(menu !== dropdown) {
                menu.classList.add('hidden');
            }
        });
        
        // 2. Toggle status hidden dropdown aktif
        dropdown.classList.toggle('hidden');
        
        // 3. Atur posisi secara dinamis jika dropdown terbuka
        if (!dropdown.classList.contains('hidden')) {
            const rect = button.getBoundingClientRect();
            const spaceBelow = window.innerHeight - rect.bottom;
            
            // Jika sisa ruang di bawah kurang dari 180px (kira-kira tinggi dropdown)
            if (spaceBelow < 160) {
                // Buka ke atas
                dropdown.classList.remove('top-12');
                dropdown.classList.add('bottom-full', 'mb-2');
            } else {
                // Buka ke bawah (normal)
                dropdown.classList.remove('bottom-full', 'mb-2');
                dropdown.classList.add('top-12');
            }
        }
    }



    function closeAllDropdown()
    {
        document.querySelectorAll('.action-dropdown').forEach(menu =>
        {
            menu.classList.add('hidden');
        });
    }



    document.addEventListener('click', function(e)
    {
        if(!e.target.closest('.relative'))
        {
            closeAllDropdown();
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                let filter = searchInput.value.toLowerCase();
                // Ambil semua baris di dalam tbody
                let rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    // Ambil text dari kolom Nama Produk (kolom ke-1) 
                    let productName = row.cells[0]?.textContent.toLowerCase() || "";

                    if (productName.includes(filter) ) {
                        row.style.display = ""; // Tampilkan baris
                    } else {
                        row.style.display = "none"; // Sembunyikan baris
                    }
                });
            });
        }
    });
</script>
@endsection