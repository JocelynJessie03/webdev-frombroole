@extends('partials.sidebar')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-5">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative font-bold text-sm flex items-center gap-2 shadow-sm transition">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative font-bold text-sm flex items-center gap-2 shadow-sm transition">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-3 gap-4">
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
        <div class="bg-white rounded-2xl border p-5 shadow-sm">
            <div class="flex justify-between items-start mb-5">
                
                @if(request('filter') == 'out_of_stock')
                    {{-- Tampilan Merah saat Filter OUT OF STOCK Aktif --}}
                    <div class="w-12 h-12 rounded-xl {{ $outOfStockCount > 0 ? 'bg-red-50' : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                        <i data-lucide="info" class="w-5 h-5 {{ $outOfStockCount > 0 ? 'text-red-600' : 'text-gray-400' }}"></i>
                    </div>
                    @if($outOfStockCount > 0)
                        <div class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full animate-pulse">
                            Empty Stock
                        </div>
                    @endif

                @elseif(request('filter') == 'low_stock')
                    {{-- Tampilan Kuning saat Filter LOW STOCK Aktif --}}
                    <div class="w-12 h-12 rounded-xl {{ $lowStockCount > 0 ? 'bg-amber-50' : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                        <i data-lucide="triangle-alert" class="w-5 h-5 {{ $lowStockCount > 0 ? 'text-amber-500' : 'text-gray-400' }}"></i>
                    </div>
                    @if($lowStockCount > 0)
                        <div class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                            Monitor Stock
                        </div>
                    @endif

                @else
                    {{-- Tampilan GABUNGAN (ALL) saat tidak ada filter atau filter = all --}}
                    @php
                        $totalWarnings = $lowStockCount + $outOfStockCount;
                        $isCritical = $outOfStockCount > 0;
                    @endphp
                    <div class="w-12 h-12 rounded-xl {{ $totalWarnings > 0 ? ($isCritical ? 'bg-red-50' : 'bg-amber-50') : 'bg-gray-50' }} flex items-center justify-center transition-colors">
                        <i data-lucide="{{ $isCritical ? 'info' : 'triangle-alert' }}" class="w-5 h-5 {{ $totalWarnings > 0 ? ($isCritical ? 'text-red-600' : 'text-amber-500') : 'text-gray-400' }}"></i>
                    </div>
                    @if($totalWarnings > 0)
                        <div class="{{ $isCritical ? 'bg-red-100 text-red-700 animate-pulse' : 'bg-amber-100 text-amber-700' }} text-xs font-bold px-3 py-1 rounded-full">
                            {{ $isCritical ? 'Action Needed' : 'Monitor Stock' }}
                        </div>
                    @endif
                @endif
            </div>
            
            {{-- Judul dinamis --}}
            <p class="uppercase tracking-widest text-xs text-gray-400 font-bold mb-1">
                @if(request('filter') == 'out_of_stock')
                    Out Of Stock
                @elseif(request('filter') == 'low_stock')
                    Low Stock
                @else
                    Stock Warnings
                @endif
            </p>

            {{-- Angka dinamis --}}
            <h2 class="text-4xl font-black text-black">
                @if(request('filter') == 'out_of_stock')
                    {{ $outOfStockCount }}
                @elseif(request('filter') == 'low_stock')
                    {{ $lowStockCount }}
                @else
                    {{ $lowStockCount + $outOfStockCount }}
                @endif
            </h2>
        
        </div>
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

    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
        <div class="p-5 flex justify-between items-center border-b gap-4">
            <div class="bg-[#f6f3f1] rounded-xl p-1 flex gap-1 shrink-0">
                <a href="{{ route('product.inventory', array_merge(request()->except('highlight'), ['filter' => ''])) }}" 
                class="{{ !request('filter') ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    All
                </a>
                <a href="{{ route('product.inventory', array_merge(request()->query(), ['filter' => 'low_stock'])) }}" 
                   class="{{ request('filter') == 'low_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Low Stock
                </a>
                <a href="{{ route('product.inventory', array_merge(request()->query(), ['filter' => 'out_of_stock'])) }}" 
                   class="{{ request('filter') == 'out_of_stock' ? 'bg-white shadow text-[#7b0000]' : 'text-gray-500' }} px-4 py-2 rounded-lg font-bold text-sm transition">
                    Out of Stock
                </a>
            </div>

            <form action="{{ route('product.inventory') }}" method="GET" class="m-0 flex items-center shrink-0">
                @if(request('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
                <div class="bg-[#f6f3f1] border border-gray-200 rounded-xl px-3 py-2 flex items-center gap-2 focus-within:ring-2 focus-within:ring-[#7b0000]/20 transition">
                    <i data-lucide="filter" class="w-4 h-4 text-gray-400"></i>
                    <select name="category_filter" onchange="this.form.submit()" class="bg-transparent outline-none text-sm font-bold text-gray-700 cursor-pointer pr-2">
                        <option value="">All Categories</option>
                        @foreach($categories->filter(fn($c) => !$c->category_delete && strtolower($c->category_name) !== 'uncategorized') as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_filter') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="bg-[#f6f3f1] rounded-xl px-4 py-2.5 flex items-center gap-3 w-[240px] focus-within:ring-2 focus-within:ring-[#7b0000]/20 transition ml-auto">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search product..." 
                       class="bg-transparent outline-none w-full text-sm font-plain text-gray-700 placeholder-gray-400">
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <button onclick="openCategoryModal()"
                        class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition cursor-pointer">
                    <i data-lucide="tag" class="w-4 h-4 text-gray-500"></i>
                    Manage Category
                </button>

                <a href="{{ route('products.create') }}"
                   class="bg-[#7b0000] hover:bg-[#920000] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add Product
                </a>
            </div>
        </div>
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

                                    <a href="{{ route('product.edit', $product->id) }}"
                                       class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm font-semibold flex items-center gap-3 text-gray-700 transition">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        Edit Product
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $product->pro_name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold flex items-center gap-3 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            Delete Product
                                        </button>
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

<div id="categoryModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeCategoryModal()">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl border overflow-hidden flex flex-col max-h-[80vh]" onclick="event.stopPropagation()">
        <div class="p-6 border-b flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Manage Categories</h3>
                <p class="text-xs text-gray-500 mt-0.5">Add, edit, or delete product categories</p>
            </div>
            <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-black p-2 rounded-xl hover:bg-gray-200 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="p-6 border-b bg-white">
            <form action="{{ route('categories.store') }}" method="POST" class="flex gap-2 m-0">
                @csrf 
                <div class="flex-1">
                    <input type="text" 
                           name="category_name" 
                           placeholder="Type new category name..." 
                           required
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#7b0000]/20 focus:border-[#7b0000] transition">
                </div>
                <button type="submit" 
                        class="bg-[#7b0000] hover:bg-[#920000] text-white px-4 py-2.5 rounded-xl font-bold text-sm flex items-center gap-1 transition cursor-pointer shrink-0">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add
                </button>
            </form>
        </div>

        <div class="p-6 overflow-y-auto flex-1 space-y-2.5 bg-white" style="scrollbar-width: thin;">
            <p class="text-[10px] uppercase tracking-wider font-bold text-gray-400 mb-1">Active Categories</p>
            
            @php
                $activeCategories = $categories->filter(fn($c) => !$c->category_delete && strtolower($c->category_name) !== 'uncategorized');
                $deletedCategories = $categories->filter(fn($c) => $c->category_delete && strtolower($c->category_name) !== 'uncategorized');
            @endphp

            @if($activeCategories->count() > 0)
                @foreach($activeCategories as $category)
                    <div id="row-cat-{{ $category->id }}" class="flex justify-between items-center bg-[#f7f5f3] px-4 py-3 rounded-xl border border-gray-100 transition-all">
                        <div class="flex-1 view-mode">
                            <span class="font-bold text-sm text-gray-800 cat-name-text">{{ $category->category_name }}</span>
                            <span class="text-[10px] text-gray-400 font-mono ml-2 bg-gray-200/60 px-1.5 py-0.5 rounded">{{ $category->category_ID }}</span>
                        </div>

                        <div class="flex-1 edit-mode hidden pr-2">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="flex items-center gap-1.5 m-0">
                                @csrf
                                @method('PUT')
                                <input type="text" name="category_name" value="{{ $category->category_name }}" required
                                       class="w-full bg-white border border-[#7b0000] rounded-lg px-2.5 py-1 text-sm font-bold text-gray-800 focus:outline-none">
                                
                                <button type="submit" class="text-green-600 hover:bg-green-50 p-1.5 rounded-md transition">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </button>
                                <button type="button" onclick="cancelInlineEdit({{ $category->id }})" class="text-gray-400 hover:bg-gray-200 p-1.5 rounded-md transition">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center gap-1 action-buttons-block">
                            <button onclick="enableInlineEdit({{ $category->id }})" class="text-gray-500 hover:text-black hover:bg-gray-200 p-2 rounded-lg transition">
                                <i data-lucide="square-pen" class="w-4 h-4"></i>
                            </button>
                            
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? All related products will become Uncategorized.');" class="inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-400 italic text-xs py-2 pl-1">No active categories found.</p>
            @endif

            @if($deletedCategories->count() > 0)
                <div class="pt-4 mt-2 border-t border-dashed border-gray-200">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-red-500 mb-2 flex items-center gap-1">
                        <i data-lucide="archive" class="w-3 h-3"></i> Archived / Deleted
                    </p>
                    <div class="space-y-2">
                        @foreach($deletedCategories as $delCategory)
                            <div class="flex justify-between items-center bg-gray-50/70 px-4 py-2.5 rounded-xl border border-gray-100 opacity-75">
                                <div>
                                    <span class="font-semibold text-sm text-gray-500 line-through">{{ $delCategory->category_name }}</span>
                                    <span class="text-[9px] text-gray-400 font-mono ml-2 bg-gray-200/40 px-1 py-0.5 rounded">{{ $delCategory->category_ID }}</span>
                                </div>

                                <form action="{{ route('categories.restore', $delCategory->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" title="Restore Category" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition cursor-pointer">
                                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="p-4 bg-gray-50 border-t flex justify-end">
            <button onclick="closeCategoryModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-xl font-bold text-sm transition">
                Close
            </button>
        </div>
    </div>
</div>

<div id="bomModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeBomModal()">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl border overflow-hidden flex flex-col max-h-[75vh]" onclick="event.stopPropagation()">
        <div class="p-6 border-b flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-xl font-black text-[#7b0000]">Bill of Materials (BOM)</h3>
                <p class="text-xs text-gray-500 mt-1" id="bomProductName">Product Name</p>
            </div>
            <button onclick="closeBomModal()" class="text-gray-400 hover:text-black p-2 rounded-xl hover:bg-gray-200 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="p-6 overflow-y-auto flex-1 space-y-3" id="bomIngredientsList"></div>

        <div class="p-4 bg-gray-50 border-t flex justify-end">
            <button onclick="closeBomModal()" class="bg-[#7b0000] hover:bg-[#650000] text-white px-5 py-2 rounded-xl font-bold text-sm transition">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    function enableInlineEdit(id) {
        const row = document.getElementById(`row-cat-${id}`);
        if(!row) return;

        row.querySelector('.view-mode').classList.add('hidden');
        row.querySelector('.action-buttons-block').classList.add('hidden');
        row.querySelector('.edit-mode').classList.remove('hidden');
        
        const inputField = row.querySelector('.edit-mode input');
        inputField.focus();
        inputField.setSelectionRange(inputField.value.length, inputField.value.length);
        
        if(typeof lucide !== 'undefined') { lucide.createIcons(); }
    }

    function cancelInlineEdit(id) {
        const row = document.getElementById(`row-cat-${id}`);
        if(!row) return;

        row.querySelector('.view-mode').classList.remove('hidden');
        row.querySelector('.action-buttons-block').classList.remove('hidden');
        row.querySelector('.edit-mode').classList.add('hidden');
    }

    function openCategoryModal() {
        const modal = document.getElementById('categoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeCategoryModal() {
        const modal = document.getElementById('categoryModal');
        document.querySelectorAll('[id^="row-cat-"]').forEach(row => {
            cancelInlineEdit(row.id.replace('row-cat-', ''));
        });
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function toggleDropdown(button) {
        const dropdown = button.parentElement.querySelector('.action-dropdown');
        
        document.querySelectorAll('.action-dropdown').forEach(menu => {
            if(menu !== dropdown) {
                menu.classList.add('hidden');
            }
        });
        
        dropdown.classList.toggle('hidden');
        
        if (!dropdown.classList.contains('hidden')) {
            const rect = button.getBoundingClientRect();
            const spaceBelow = window.innerHeight - rect.bottom;
            
            if (spaceBelow < 160) {
                dropdown.classList.remove('top-12');
                dropdown.classList.add('bottom-full', 'mb-2');
            } else {
                dropdown.classList.remove('bottom-full', 'mb-2');
                dropdown.classList.add('top-12');
            }
        }
    }

    function openBomModalFromDropdown(button) {
        closeAllDropdown();

        const modal = document.getElementById('bomModal');
        const textProductName = document.getElementById('bomProductName');
        const container = document.getElementById('bomIngredientsList');

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
            closeCategoryModal();
            closeAllDropdown();
        }
    });
 
// ========================================================
    // LOGIKA PENCARIAN & HIGHLIGHT OTOMATIS (GLOBAL SEARCH)
    // ========================================================
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        
        // Fungsi Filter Lokal Utama
        function applyProductFilters() {
            let filter = searchInput.value.toLowerCase().trim();
            let rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let productName = row.cells[0]?.textContent.toLowerCase() || "";
                let sku = row.cells[1]?.textContent.toLowerCase() || "";

                if (productName.includes(filter) || sku.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        if(searchInput) {
            searchInput.addEventListener('keyup', applyProductFilters);
        }

        const urlParams = new URLSearchParams(window.location.search);
        const itemToHighlight = urlParams.get('highlight');

        if (itemToHighlight && searchInput) {
            const targetWord = itemToHighlight.toLowerCase().trim();
            
            // 1. Ketik otomatis & jalankan filter
            searchInput.value = itemToHighlight;
            applyProductFilters();

            // 2. Beri efek highlight kuning
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                let productName = row.cells[0]?.textContent.toLowerCase() || "";
                let sku = row.cells[1]?.textContent.toLowerCase() || "";

                if (productName.includes(targetWord) || sku.includes(targetWord)) {
                    row.style.backgroundColor = '#fef08a';
                    row.style.transition = 'background-color 1s ease';
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    setTimeout(() => { 
                        row.style.backgroundColor = ''; 
                    }, 1500);
                }
            });

            // 3. Hapus parameter highlight dari URL browser tanpa reload
            urlParams.delete('highlight');
            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
            window.history.replaceState({}, document.title, newUrl);

            // 4. (KODE PENYELAMAT) Bersihkan parameter highlight yang telanjur nempel di link tag <a> Laravel
            document.querySelectorAll('a').forEach(link => {
                if (link.href && link.href.includes('highlight=')) {
                    try {
                        let linkUrl = new URL(link.href);
                        linkUrl.searchParams.delete('highlight');
                        link.href = linkUrl.toString(); // Set ulang href yang sudah bersih
                    } catch (e) {
                        console.error("Gagal membersihkan href link", e);
                    }
                }
            });
        }
    });
</script> 
@endsection