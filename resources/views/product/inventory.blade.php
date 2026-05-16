@extends('partials.sidebar')

@section('content')

<div class="space-y-5">

    {{-- HEADER --}}
    <div>

        <h1 class="text-[32px] font-black text-[#7b0000] leading-none mb-2">
            Product Inventory
        </h1>

        <p class="text-gray-600 text-sm max-w-3xl leading-relaxed">
            Manage your Broole products, monitor stock availability, and track inventory performance in real time.
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

                <div class="bg-[#f7dede] text-[#7b0000] text-xs font-bold px-3 py-1 rounded-full">
                    +4.2%
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Products
            </p>

            <h2 class="text-4xl font-black text-[#7b0000]">
                {{ $totalProducts }}
            </h2>
        </div>



        {{-- CARD --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-[#fff3f3] flex items-center justify-center">
                    <i data-lucide="triangle-alert" class="w-5 h-5 text-red-600"></i>
                </div>

                <div class="bg-[#ffdede] text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                    Attention Required
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Low Stock
            </p>

            <h2 class="text-4xl font-black text-black">
                {{ $lowStockCount }}
            </h2>

        </div>



        {{-- CARD --}}
        <div class="bg-[#8b0000] rounded-2xl p-5 shadow-lg text-white">

            <div class="flex justify-between items-start mb-5">

                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>

                <div class="bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Total Value
                </div>

            </div>

            <p class="uppercase tracking-widest text-xs text-white/70 font-bold mb-1">
                Product Value
            </p>

            <h2 class="text-4xl font-black">
                Rp {{ number_format($totalValue, 0, ',', '.') }}
            </h2>

        </div>

    </div>



    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

        {{-- TOP BAR --}}
        <div class="p-5 flex justify-between items-center border-b">

            {{-- FILTER --}}
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1">

                {{-- Tombol ALL --}}
                <a href="{{ route('product.inventory') }}" 
                class="{{ !request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    All
                </a>

                {{-- Tombol LOW STOCK --}}
                <a href="{{ route('product.inventory', ['filter' => 'low_stock']) }}" 
                class="{{ request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Low Stock
                </a>

                {{-- Tombol OUT OF STOCK --}}
                <a href="{{ route('product.inventory', ['filter' => 'out_of_stock']) }}" 
                class="{{ request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out of Stock
                </a>

            </div>



            {{-- ACTIONS --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('products.create') }}"
                   class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">

                    <i data-lucide="plus" class="w-4 h-4"></i>

                    Add Product

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
                            Product
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            SKU
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Category
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Price
                        </th>

                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">
                            Stock
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


                @foreach($products as $product)
<tr class="border-b last:border-0 hover:bg-gray-50 transition">
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <img src="{{ $product->pro_image ? asset('products/' . $product->pro_image) : 'https://placehold.co/100x100' }}" 
                 class="w-12 h-12 rounded-xl object-cover">
            <h3 class="font-bold text-base leading-tight">{{ $product->pro_name }}</h3>
        </div>
    </td>

    <td class="px-4 py-5 text-gray-400 text-sm font-semibold">
        {{ $product->pro_ID }}
    </td>

    {{-- KATEGORI --}}
    <td class="px-4 py-5 text-sm font-medium text-gray-700">
        @if($product->category)
            {{ $product->category->category_name }}
        @else
            <span class="text-gray-400 italic">Uncategorized</span>
        @endif
    </td>
    
    <td class="px-4 py-5 font-black text-lg">
        Rp {{ number_format($product->pro_price, 0, ',', '.') }}
    </td>

    {{-- STOK DINAMIS --}}
    <td class="px-4 py-5 text-lg font-black">
        {{ $product->calculated_stock }}
    </td>

    {{-- STATUS --}}
    <td class="px-4 py-5">
        <span class="{{ $product->status_label == 'IN STOCK' ? 'bg-[#f8e9e9] text-[#7b0000]' : ($product->status_label == 'LOW STOCK' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-500') }} px-3 py-1 rounded-full text-xs font-bold">
            {{ $product->status_label }}
        </span>
    </td>
    
    {{-- ACTION (untuk View BOM) --}}
    <td class="px-4 py-5">
        <div class="relative">
            <button onclick="toggleDropdown(this)" class="text-gray-400 hover:text-black p-2 rounded-lg">
                <i data-lucide="ellipsis" class="w-5 h-5"></i>
            </button>

            <div class="hidden absolute right-0 top-12 w-44 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown">
                {{-- Tombol BOM Dinamis --}}
                <button 
                    onclick="openBomModalFromDropdown(this)"
                    data-title="{{ $product->pro_name }}"
                    {{-- Mengambil data ingredients dari relasi pivot --}}
                    data-ingredients='@json($product->ingredients->map(fn($i) => $i->name . " - " . $i->pivot->amount_needed . " " . $i->unit))'
                    class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3">
                    <i data-lucide="book-open" class="w-4 h-4"></i> View BOM
                </button>
                
                {{-- Link Edit --}}
                <a href="#" class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 border-t">
                    <i data-lucide="square-pen" class="w-4 h-4"></i> Edit Product
                </a>
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



{{-- BOM MODAL --}}
<div id="bomModal"
     onclick="closeBomModal()"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-5">

    <div onclick="event.stopPropagation()"
         class="bg-white w-full max-w-[650px] rounded-[35px] p-8 relative shadow-2xl">

        {{-- CLOSE --}}
        <button onclick="closeBomModal()"
                class="absolute top-5 right-5 text-gray-400 hover:text-black transition">

            <i data-lucide="x" class="w-6 h-6"></i>

        </button>



        {{-- HEADER --}}
        <div class="mb-8">

            <p class="uppercase tracking-[4px] text-xs text-[#7b0000] font-black mb-3">
                Recipe Formula
            </p>

            <h2 id="bomTitle"
                class="text-4xl font-black leading-tight text-black">
                Product Name
            </h2>

        </div>



        {{-- CONTENT --}}
       <div id="bomList" class="space-y-4">
        {{-- Akan diisi otomatis oleh JS --}}
        </div>  
    </div>

</div>



<script>

    function toggleDropdown(button)
    {
        const dropdown = button.parentElement.querySelector('.action-dropdown');

        document.querySelectorAll('.action-dropdown').forEach(menu =>
        {
            if(menu !== dropdown)
            {
                menu.classList.add('hidden');
            }
        });

        dropdown.classList.toggle('hidden');
    }



    function openBomModalFromDropdown(button) {
    closeAllDropdown();

    const modal = document.getElementById('bomModal');
    const title = document.getElementById('bomTitle');
    const container = document.getElementById('bomList'); // Ganti ke ID baru ini

    // Ambil data
    const ingredients = JSON.parse(button.dataset.ingredients);
    title.innerText = button.dataset.title;

    // Kosongkan kontainer lalu isi dengan data baru
    container.innerHTML = '';
    
    if(ingredients.length === 0) {
        container.innerHTML = '<p class="text-gray-400 text-center italic">No recipe found.</p>';
    } else {
        ingredients.forEach(item => {
            container.innerHTML += `
                <div class="bg-[#faf7f7] rounded-[28px] px-7 py-6 border border-[#f1ebeb]">
                    <p class="text-black text-xl font-medium tracking-tight leading-tight">${item}</p>
                </div>
            `;
        });
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    }



    function closeBomModal()
    {
        document.getElementById('bomModal').classList.add('hidden');
        document.getElementById('bomModal').classList.remove('flex');
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



    document.addEventListener('keydown', function(event)
    {
        if(event.key === 'Escape')
        {
            closeBomModal();
            closeAllDropdown();
        }
    });

</script>

@endsection