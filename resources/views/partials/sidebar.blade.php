<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>From Broole</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_from_broole.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            background: #f7f5f3;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #7b0000, #8d0000);
        }

        /* Memastikan transisi lebar sidebar berjalan mulus */
        aside {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #main-container {
            transform: scale(0.9);
            transform-origin: top left;
            width: 111.12%;
            height: 111.12%;
            display: flex;
        }

        aside.collapsed .hide-on-collapse {
            display: none;
        }

        aside.collapsed .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
    </style>

</head>

<body class="h-screen w-screen overflow-hidden">

<div id="main-container">
    {{-- SIDEBAR --}}
    <aside
        id="sidebar"
        class="w-[95px] collapsed sidebar-gradient text-white flex flex-col justify-between relative shadow-2xl shrink-0 h-full"
    >

        <div class="overflow-y-auto no-scrollbar">

            {{-- LOGO --}}
            <div class="px-8 pt-8 pb-10">

                <div class="flex items-center gap-4">

                    <div class="bg-white text-[#7b0000] min-w-[50px] h-12 rounded-2xl flex items-center justify-center shrink-0 shadow-lg">

                        <i data-lucide="store" class="w-6 h-6"></i>

                    </div>

                    <div class="hide-on-collapse">

                        <h1 class="text-2xl font-black leading-none whitespace-nowrap">
                            From Broole
                        </h1>

                        <p class="uppercase text-[8px] opacity-80 tracking-widest mt-1">
                            FROM BROOLE TO YOU
                        </p>

                    </div>

                </div>

            </div>



            {{-- MENU --}}
            @php
                $adminUser = Auth::guard('admin')->user() ?? Auth::user();
                $isSuperAdmin = $adminUser && $adminUser->role === 'super_admin';
            @endphp
            <div class="px-5 space-y-1.5">

                <a
                    href="{{ route('dashboard') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('dashboard') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="layout-dashboard" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Dashboard
                    </span>

                </a>



                <a
                    href="{{ route('pos') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('pos') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="calculator" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Point of Sale
                    </span>

                </a>



                <a
                    href="{{ route('product.inventory') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('product.inventory') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="package" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Product Inventory
                    </span>

                </a>



                <a
                    href="{{ route('ingredient.inventory') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('ingredient.inventory') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="package-2" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Ingredient Inventory
                    </span>

                </a>



                <a
                    href="{{ route('order_history') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('order_history') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="receipt" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Order History
                    </span>

                </a>



                @if($isSuperAdmin)
                <a
                    href="{{ route('customers') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('customers') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="users" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Members
                    </span>

                </a>



                <a
                    href="{{ route('reports') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('reports') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="bar-chart-3" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Reports & Analytics
                    </span>

                </a>

                <a
                    href="{{ route('manage_admin.index') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('manage_admin.*') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="user-cog" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Manage Admin
                    </span>

                </a>
                @endif

            </div>

        </div>

        <div class="px-5 pb-8">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="menu-item flex w-full items-center gap-4 px-5 py-3 rounded-2xl text-base opacity-70 hover:opacity-100 hover:bg-white/10 transition-all duration-200 group text-left">
                    
                    <i data-lucide="log-out" class="shrink-0 w-5 h-5 group-hover:text-red-300"></i>
                    
                    <span class="hide-on-collapse whitespace-nowrap font-medium">
                        Logout
                    </span>

                </button>
            </form>
        </div>

    </aside>



 {{-- MAIN --}}
<main class="flex-1 p-12 overflow-auto h-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center gap-10 mb-10">

        @php

           $title = match(Request::segment(1)) {

    'dashboard' => 'Dashboard',

    'pos' => 'Point of Sale',

    'product-inventory' => 'Product Inventory',

    'products' => 'Product Inventory',

    'ingredient-inventory' => 'Ingredient Inventory',

    'ingredients' => 'Ingredient Inventory',

    'customers' => 'Customers',

    'reports' => 'Reports',

    'order_history' => 'Order History',

    'manage-admin' => 'Manage Admin',

    default => '',

};

        @endphp

        <h1 class="text-5xl font-black text-[#7b0000] tracking-tight shrink-0">

            {{ $title }}

        </h1>

            



            <div class="flex items-center gap-6">

                {{-- SEARCH --}}
                <div class="relative w-[450px]">

                    <div class="bg-white px-8 py-4 rounded-full shadow-sm border border-[#7b0000] transition-all">

                        <input
                            type="text"
                            id="global-search"
                            placeholder="Search everything..."
                            class="outline-none w-full text-xl bg-transparent"
                        >

                    </div>



                    {{-- DROPDOWN --}}
                    <div
                        id="search-dropdown"
                        class="hidden absolute top-[85px] left-0 w-full bg-white rounded-3xl shadow-2xl border border-gray-100 z-50 overflow-hidden"
                    >

                        <div id="search-results" class="max-h-[400px] overflow-y-auto">

                        </div>

                    </div>

                </div>


{{-- ICONS --}}
<div class="flex items-center gap-6 text-gray-400 relative">
{{-- NOTIFICATION --}}
<div class="relative">

    {{-- BUTTON --}}
    <button id="notif-btn" class="relative">

        <i data-lucide="bell"
           class="w-7 h-7 cursor-pointer hover:text-[#7b0000] transition-colors">
        </i>

        {{-- RED DOT --}}
        @if(\App\Models\Notification::where('is_read', false)->count() > 0)

              <span
        id="notif-red-dot"
        class="absolute -top-1 -right-1 bg-red-500 w-3 h-3 rounded-full">
    </span>


        @endif

    </button>



    {{-- DROPDOWN --}}
    <div
        id="notif-dropdown"
        class="hidden absolute right-0 top-14 w-[360px] bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-50"
    >

       {{-- HEADER --}}
<div class="p-5 border-b bg-[#7b0000] text-white">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="font-black text-lg">
                Notifications
            </h2>

            <p class="text-xs opacity-80 mt-1">
                Latest activity from your store
            </p>

        </div>



        <button
            onclick="markAllAsRead()"
            class="text-[10px] bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition"
        >

            Mark all read

        </button>

    </div>

</div>



        {{-- LIST --}}
        <div class="max-h-[350px] overflow-y-auto">

            @forelse($notifications as $notif)

                <div
                    data-id="{{ $notif->id }}"
                    class="notif-item px-5 py-4 border-b transition cursor-pointer

                    {{ $notif->is_read
                        ? 'bg-white opacity-60'
                        : 'bg-red-50 hover:bg-red-100'
                    }}"
                >

                    <div class="flex items-start gap-3">

                        <div class="p-2 rounded-2xl

                            @if($notif->type == 'order')

                                bg-green-100 text-green-600

                            @elseif($notif->type == 'stock')

                                bg-yellow-100 text-yellow-600

                            @else

                                bg-blue-100 text-blue-600

                            @endif
                        ">

                            @if($notif->type == 'order')

                                <i data-lucide="shopping-bag"
                                   class="w-4 h-4"></i>

                            @elseif($notif->type == 'stock')

                                <i data-lucide="alert-triangle"
                                   class="w-4 h-4"></i>

                            @else

                                <i data-lucide="bar-chart-3"
                                   class="w-4 h-4"></i>

                            @endif

                        </div>



                        <div>

                            <p class="font-bold text-sm text-black">

                                {{ $notif->title }}

                            </p>

                            <p class="text-xs text-gray-500 mt-1">

                                {{ $notif->message }}

                            </p>

                            <p class="text-[10px] text-gray-300 mt-2">

                                {{ $notif->created_at->diffForHumans() }}

                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-8 text-center text-gray-400">

                    No notifications yet

                </div>

            @endforelse

        </div>

    </div>

</div>



    {{-- REFRESH --}}
    <button onclick="window.location.reload()">

        <i data-lucide="refresh-cw"
           class="w-7 h-7 cursor-pointer hover:text-[#7b0000] transition-colors">
        </i>

    </button>
</div>

            </div>


        </div>



        {{-- CONTENT --}}
        <div class="content-wrapper">

            @yield('content')

        </div>

    </main>

</div>


    <script>
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');

    // Ketika kursor mendekat / masuk ke area sidebar (Membuka)
    sidebar.addEventListener('mouseenter', () => {
        sidebar.classList.remove('collapsed');
        sidebar.classList.replace('w-[95px]', 'w-[280px]');
        lucide.createIcons();
    });

    // Ketika kursor menjauh / keluar dari area sidebar (Menutup)
    sidebar.addEventListener('mouseleave', () => {
        sidebar.classList.add('collapsed');
        sidebar.classList.replace('w-[280px]', 'w-[95px]');
        lucide.createIcons();
    });


    // ==========================================
    // LOGIKA TOGGLE NOTIFIKASI (KODE BARU)
    // ==========================================
    const notifBtn = document.getElementById('notif-btn');
    const notifDropdown = document.getElementById('notif-dropdown');
    const searchDropdown = document.getElementById('search-dropdown');

    if (notifBtn && notifDropdown) {
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah benturan klik
            notifDropdown.classList.toggle('hidden');
            
            // Tutup dropdown search jika sedang terbuka agar tidak tabrakan
            if (searchDropdown) searchDropdown.classList.add('hidden');
        });

        // Tutup notifikasi jika klik di luar area notif
        document.addEventListener('click', function(e) {
            if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                notifDropdown.classList.add('hidden');
            }
        });
    }

    // Fungsi Menandai Semua Notifikasi Telah Dibaca
    // ==========================================
    // 1. FUNGSI MARK ALL AS READ
    // ==========================================
    window.markAllAsRead = async function() {
        try {
            // Mengirim request POST ke Laravel
            const response = await fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            
            if (response.ok) {
                // Hapus titik merah notifikasi
                const redDot = document.getElementById('notif-red-dot');
                if (redDot) redDot.remove();
                
                // Ubah style list item notifikasi jadi pudar (sudah dibaca)
                document.querySelectorAll('.notif-item').forEach(item => {
                    item.classList.remove('bg-red-50', 'hover:bg-red-100');
                    item.classList.add('bg-white', 'opacity-60');
                });
            } else {
                console.error("Gagal update ke database. Pastikan Route Laravel sudah dibuat.");
            }
        } catch (error) {
            console.error('Network Error:', error);
        }
    }

    // ==========================================
    // 2. FUNGSI KLIK 1 NOTIFIKASI (MARK AS READ)
    // ==========================================
    document.querySelectorAll('.notif-item').forEach(item => {
        item.addEventListener('click', async function() {
            const notifId = this.getAttribute('data-id');
            // Cek apakah item ini belum diread (masih ada background merah)
            const isUnread = this.classList.contains('bg-red-50');

            if (isUnread) {
                try {
                    // Kirim request ke Laravel untuk 1 notifikasi
                    const response = await fetch(`/notifications/${notifId}/read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        // Ubah tampilan 1 notifikasi ini jadi pudar
                        this.classList.remove('bg-red-50', 'hover:bg-red-100');
                        this.classList.add('bg-white', 'opacity-60');

                        // Cek apakah masih ada notifikasi merah lainnya?
                        const remainingUnread = document.querySelectorAll('.notif-item.bg-red-50').length;
                        
                        // Jika sudah habis dibaca semua, hapus titik merah di lonceng
                        if (remainingUnread === 0) {
                            const redDot = document.getElementById('notif-red-dot');
                            if (redDot) redDot.remove();
                        }
                    }
                } catch (error) {
                    console.error('Error klik notifikasi:', error);
                }
            }
        });
    });


    // ==========================================
    // FITUR SEARCH DROPDOWN DENGAN HIGHLIGHT
    // ==========================================
    const searchInput = document.getElementById('global-search');

    if(searchInput) {
        const dropdown = document.getElementById('search-dropdown');
        const results = document.getElementById('search-results');

        function highlightText(text, query) {
            if (!query || !text) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return String(text).replace(regex, `<mark class="bg-yellow-300 text-black px-1 rounded">$1</mark>`);
        }

        searchInput.addEventListener('keyup', async function() {
            const query = this.value;

            if(query.length < 1) {
                dropdown.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(`/api/search?query=${query}`);
                const data = await response.json();
                let html = '';

                // PRODUCTS
                if(data.products && data.products.length > 0) {
                    html += `<div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">Products</div>`;
                    data.products.forEach(product => {
                        const highlightedName = highlightText(product.pro_name, query);
                        html += `
                            <a href="/product-inventory?highlight=${encodeURIComponent(product.pro_name)}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">
                                <div>
                                    <p class="font-bold">${highlightedName}</p>
                                    <p class="text-sm text-gray-400">Product</p>
                                </div>
                                <span class="text-[#7b0000] font-bold">View →</span>
                            </a>
                        `;
                    });
                }

                // INGREDIENTS
                if(data.ingredients && data.ingredients.length > 0) {
                    html += `<div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">Ingredients</div>`;
                    data.ingredients.forEach(ingredient => {
                        const highlightedName = highlightText(ingredient.name, query);
                        html += `
                            <a href="/ingredient-inventory?highlight=${encodeURIComponent(ingredient.name)}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">
                                <div>
                                    <p class="font-bold">${highlightedName}</p>
                                    <p class="text-sm text-gray-400">Stock: ${ingredient.stock}</p>
                                </div>
                                <span class="text-[#7b0000] font-bold">View →</span>
                            </a>
                        `;
                    });
                }

                // CUSTOMERS
                if(data.customers && data.customers.length > 0) {
                    html += `<div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">Customers</div>`;
                    data.customers.forEach(customer => {
                        const highlightedName = highlightText(customer.customer_name, query);
                        html += `
                            <a href="/customers?highlight=${encodeURIComponent(customer.customer_name)}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">
                                <div>
                                    <p class="font-bold">${highlightedName}</p>
                                </div>
                                <span class="text-[#7b0000] font-bold">View →</span>
                            </a>
                        `;
                    });
                }

                if(html === '') {
                    html = `<div class="p-8 text-center text-gray-400">No results found.</div>`;
                }

                results.innerHTML = html;
                dropdown.classList.remove('hidden');
                
                // Otomatis tutup dropdown notifikasi jika user mulai mengetik pencarian
                if(notifDropdown) notifDropdown.classList.add('hidden');

            } catch(error) {
                console.error(error);
            }
        });

        document.addEventListener('click', function(e) {
            if(!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
    </script>
</body>
</html>