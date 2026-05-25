@extends('partials.sidebar')

@section('content')

<div class="space-y-5">


    {{-- TOP CARDS --}}
    <div class="grid grid-cols-3 gap-4">
        {{-- CARD 1 --}}
        <div class="bg-white rounded-2xl border p-5 shadow-sm">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 rounded-xl bg-[#f7ecec] flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#7b0000]"></i>
                </div>
            </div>
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                Total Products
            </p>
            <h2 class="text-4xl font-black text-[#7b0000]">
                {{ $totalProducts }}
            </h2>
        </div>

        {{-- CARD 2 --}}
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

        {{-- CARD 3 --}}
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
                <a href="{{ route('product.inventory') }}" 
                   class="{{ !request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    All
                </a>
                <a href="{{ route('product.inventory', ['filter' => 'low_stock']) }}" 
                   class="{{ request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Low Stock
                </a>
                <a href="{{ route('product.inventory', ['filter' => 'out_of_stock']) }}" 
                   class="{{ request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out of Stock
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
                <thead>
                    <tr class="text-left border-b">
                        <th class="px-6 py-4 uppercase text-[11px] tracking-widest text-gray-400">Product</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">SKU</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Category</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Price</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Stock</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Status</th>
                        <th class="px-4 py-4 uppercase text-[11px] tracking-widest text-gray-400">Action</th>
                    </tr>
                </thead>
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

                        <td class="px-4 py-5 text-lg font-black">
                            {{ $product->calculated_stock }}
                        </td>

                        <td class="px-4 py-5">

                            <span class="
                                {{ 
                                    $product->status_label == 'IN STOCK'
                                    ? 'bg-green-100 text-green-700'
                                    : (
                                        $product->status_label == 'LOW STOCK'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-red-100 text-red-600'
                                    )
                                }}
                                px-3 py-1 rounded-full text-xs font-bold">
                                {{ $product->status_label }}
                            </span>
                        </td>
             
                        <td class="px-4 py-5">
                            <div class="relative">
                                <button onclick="toggleDropdown(this)" class="text-gray-400 hover:text-black p-2 rounded-lg">
                                    <i data-lucide="ellipsis" class="w-5 h-5"></i>
                                </button>

                                <div class="hidden absolute right-0 top-12 w-48 bg-white border rounded-2xl shadow-xl z-40 overflow-hidden action-dropdown transition-all duration-200">
                                    
                                    {{-- 1. Perbaikan Tombol BOM (Ditambahkan payload data resep mentah) --}}
                                    @php
                                        $bomData = $product->ingredients->map(function($ing) {
                                            return $ing->name . ' (' . $ing->pivot->amount_needed . ' ' . $ing->unit . ')';
                                        })->toArray();
                                    @endphp
                                    <button type="button"
                                            onclick="openBomModalFromDropdown(this)"
                                            data-title="{{ $product->pro_name }}"
                                            data-ingredients="{{ json_encode($bomData) }}"
                                            class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="cooking-pot" class="w-4 h-4"></i>
                                        View BOM
                                    </button>

                                    {{-- 2. Tombol Edit Berfungsi --}}
                                    <a href="{{ route('product.edit', $product->id) }}"
                                       class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        Edit Product
                                    </a>

                                    
                                      {{-- 3. Tombol Delete (Soft Delete) --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $product->pro_name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            Delete Product
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

{{-- MODAL BOM (Fix size & Scrollable body) --}}
<div id="bomModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="handleOutsideClick(event)">
    
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl border overflow-hidden flex flex-col max-h-[75vh]" onclick="event.stopPropagation()">
        
        {{-- MODAL HEADER --}}
        <div class="p-6 border-b flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Bill of Materials (BOM)</h3>
                <p class="text-xs text-gray-500 mt-1" id="bomProductName">Product Name</p>
            </div>
            <button onclick="closeBomModal()" class="text-gray-400 hover:text-black p-2 rounded-xl hover:bg-gray-200 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- MODAL BODY (Scrollable Area) --}}
        <div class="p-6 overflow-y-auto flex-1 space-y-3" id="bomIngredientsList">
            {{-- Konten diisi via JS --}}
        </div>

        {{-- MODAL FOOTER --}}
        <div class="p-4 bg-gray-50 border-t flex justify-end">
            <button onclick="closeBomModal()" class="bg-[#7b0000] hover:bg-[#650000] text-white px-5 py-2 rounded-xl font-bold text-sm transition">
                Close
            </button>
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

    // Perbaikan Fungsi pemanggil Modal BOM agar sinkron dengan ID elemen terdaftar
    function openBomModalFromDropdown(button) {
        closeAllDropdown();

        const modal = document.getElementById('bomModal');
        const textProductName = document.getElementById('bomProductName');
        const container = document.getElementById('bomIngredientsList');

        // Menguraikan data resep dari tombol data-atribut
        const ingredients = JSON.parse(button.dataset.ingredients);
        textProductName.innerText = button.dataset.title;

        container.innerHTML = '';
        
        if(ingredients.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-center italic py-4">No recipe ingredients found for this product.</p>';
        } else {
            ingredients.forEach(item => {
                container.innerHTML += `
                    <div class="bg-[#faf7f7] rounded-[20px] px-5 py-4 border border-[#f1ebeb] flex items-center justify-between">
                        <p class="text-black text-sm font-bold tracking-tight leading-none">${item}</p>
                    </div>
                `;
            });
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeBomModal() {
        const modal = document.getElementById('bomModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function handleOutsideClick(e) {
        closeBomModal();
    }

    function closeAllDropdown() {
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            menu.classList.add('hidden');
        });
    }

    document.addEventListener('click', function(e) {
        if(!e.target.closest('.relative')) {
            closeAllDropdown();
        }
    });

    document.addEventListener('keydown', function(event) {
        if(event.key === 'Escape') {
            closeBomModal();
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
                    // Ambil text dari kolom Nama Produk (kolom ke-1) dan SKU (kolom ke-2)
                    let productName = row.cells[0]?.textContent.toLowerCase() || "";
                    let sku = row.cells[1]?.textContent.toLowerCase() || "";

                    if (productName.includes(filter) || sku.includes(filter)) {
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