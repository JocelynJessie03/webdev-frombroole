<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Broole</title>

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
        class="w-[280px] sidebar-gradient text-white flex flex-col justify-between relative shadow-2xl shrink-0 h-full"
    >

        {{-- TOGGLE --}}
        <button
            id="toggle-btn"
            class="absolute -right-5 top-14 bg-white text-[#7b0000] rounded-full p-2 shadow-xl border border-gray-100 z-50 hover:scale-110 active:scale-95 transition-all"
        >

            <i id="toggle-icon" data-lucide="chevron-left" class="w-5 h-5"></i>

        </button>



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



                <a
                    href="{{ route('customers') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('customers') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="users" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Customers
                    </span>

                </a>



                <a
                    href="{{ route('reports') }}"
                    class="menu-item flex items-center gap-4 px-5 py-3 rounded-2xl text-lg transition-all
                    {{ Route::is('reports') ? 'bg-white/10 border-r-4 border-white font-bold' : 'opacity-70 hover:bg-white/10' }}"
                >

                    <i data-lucide="bar-chart-3" class="shrink-0 w-5 h-5"></i>

                    <span class="hide-on-collapse whitespace-nowrap">
                        Reports
                    </span>

                </a>

            </div>

        </div>



        {{-- PROFILE --}}
        <div class="p-6">

            <div class="bg-white/10 rounded-3xl p-4 flex items-center gap-4 overflow-hidden">

                <img
                    src="https://i.pravatar.cc/100"
                    class="w-10 h-10 rounded-2xl shrink-0"
                >

                <div class="hide-on-collapse">

                    <h3 class="text-base font-bold whitespace-nowrap">
                        Ahmad's Coffee
                    </h3>

                    <p class="text-[10px] opacity-70">
                        Store Manager
                    </p>

                </div>

            </div>

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
                'ingredient-inventory' => 'Ingredient Inventory',
                'customers' => 'Customers',
                'reports' => 'Reports',
                'order_history' => 'Order History',

                default => 'Dashboard',
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
            <span class="absolute -top-1 -right-1 bg-red-500 w-3 h-3 rounded-full"></span>

        </button>



        {{-- DROPDOWN --}}
        <div
            id="notif-dropdown"
            class="hidden absolute right-0 top-14 w-[360px] bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-50"
        >

            {{-- HEADER --}}
            <div class="p-5 border-b bg-[#7b0000] text-white">

                <h2 class="font-black text-lg">
                    Notifications
                </h2>

                <p class="text-xs opacity-80 mt-1">
                    Latest activity from your store
                </p>

            </div>



            {{-- LIST --}}
            <div class="max-h-[350px] overflow-y-auto">

                {{-- NOTIF ITEM --}}
                <div class="px-5 py-4 border-b hover:bg-gray-50 transition cursor-pointer">

                    <div class="flex items-start gap-3">

                        <div class="bg-green-100 text-green-600 p-2 rounded-2xl">

                            <i data-lucide="shopping-bag" class="w-4 h-4"></i>

                        </div>

                        <div>

                            <p class="font-bold text-sm text-black">
                                New Order Received
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                INV-20260525001 successfully created
                            </p>

                            <p class="text-[10px] text-gray-300 mt-2">
                                2 minutes ago
                            </p>

                        </div>

                    </div>

                </div>



                {{-- NOTIF ITEM --}}
                <div class="px-5 py-4 border-b hover:bg-gray-50 transition cursor-pointer">

                    <div class="flex items-start gap-3">

                        <div class="bg-yellow-100 text-yellow-600 p-2 rounded-2xl">

                            <i data-lucide="alert-triangle" class="w-4 h-4"></i>

                        </div>

                        <div>

                            <p class="font-bold text-sm text-black">
                                Low Ingredient Stock
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Milk stock remaining only 2 liters
                            </p>

                            <p class="text-[10px] text-gray-300 mt-2">
                                10 minutes ago
                            </p>

                        </div>

                    </div>

                </div>



                {{-- NOTIF ITEM --}}
                <div class="px-5 py-4 hover:bg-gray-50 transition cursor-pointer">

                    <div class="flex items-start gap-3">

                        <div class="bg-blue-100 text-blue-600 p-2 rounded-2xl">

                            <i data-lucide="bar-chart-3" class="w-4 h-4"></i>

                        </div>

                        <div>

                            <p class="font-bold text-sm text-black">
                                Revenue Updated
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Today's sales reached Rp 2.500.000
                            </p>

                            <p class="text-[10px] text-gray-300 mt-2">
                                1 hour ago
                            </p>

                        </div>

                    </div>

                </div>

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



    /*
    |--------------------------------------------------------------------------
    | SIDEBAR COLLAPSE
    |--------------------------------------------------------------------------
    */

    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');
    const toggleIcon = document.getElementById('toggle-icon');

    toggleBtn.addEventListener('click', () => {

        const isCollapsed = sidebar.classList.toggle('collapsed');

        if (isCollapsed)
        {
            sidebar.classList.replace('w-[280px]', 'w-[95px]');
            toggleIcon.setAttribute('data-lucide', 'chevron-right');
        }
        else
        {
            sidebar.classList.replace('w-[95px]', 'w-[280px]');
            toggleIcon.setAttribute('data-lucide', 'chevron-left');
        }

        lucide.createIcons();

    });



    /*
    |--------------------------------------------------------------------------
    | GLOBAL SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById('global-search');

    if(searchInput)
    {

        const dropdown = document.getElementById('search-dropdown');
        const results = document.getElementById('search-results');



      searchInput.addEventListener('keyup', async function() {

    const query = this.value;

    if(query.length < 1)
    {
        dropdown.classList.add('hidden');
        return;
    }

    try
    {

        const response = await fetch(`/api/search?query=${query}`);

        const data = await response.json();

        let html = '';



        // PRODUCTS
        if(data.products && data.products.length > 0)
        {

            html += `
                <div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">
                    Products
                </div>
            `;

            data.products.forEach(product => {

                html += `
                    <a href="/product-inventory"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">

                        <div>

                            <p class="font-bold">
                                ${product.pro_name}
                            </p>

                            <p class="text-sm text-gray-400">
                                Product
                            </p>

                        </div>

                        <span class="text-[#7b0000] font-bold">
                            View →
                        </span>

                    </a>
                `;

            });

        }



        // INGREDIENTS
        if(data.ingredients && data.ingredients.length > 0)
        {

            html += `
                <div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">
                    Ingredients
                </div>
            `;

            data.ingredients.forEach(ingredient => {

                html += `
                    <a href="/ingredient-inventory"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">

                        <div>

                            <p class="font-bold">
                                ${ingredient.name}
                            </p>

                            <p class="text-sm text-gray-400">
                                Stock: ${ingredient.stock}
                            </p>

                        </div>

                        <span class="text-[#7b0000] font-bold">
                            View →
                        </span>

                    </a>
                `;

            });

        }



        // REPORTS
        if(data.reports && data.reports.length > 0)
        {

            html += `
                <div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">
                    Reports & Analytics
                </div>
            `;

            data.reports.forEach(report => {

                let customerName = 'Customer';

                if(report.customer)
                {
                    customerName = report.customer.customer_name;
                }

                html += `
                    <a href="/reports"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">

                        <div>

                            <p class="font-bold">
                                ${report.order_id}
                            </p>

                            <p class="text-sm text-gray-400">

                                ${customerName}

                                •

                                ${report.status}

                                •

                                Rp ${new Intl.NumberFormat('id-ID').format(report.total_price)}

                            </p>

                        </div>

                        <span class="text-[#7b0000] font-bold">
                            Open →
                        </span>

                    </a>
                `;

            });

        }



        // CUSTOMERS
        if(data.customers && data.customers.length > 0)
        {

            html += `
                <div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">
                    Customers
                </div>
            `;

            data.customers.forEach(customer => {

                html += `
                    <a href="/customers"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">

                        <div>

                            <p class="font-bold">
                                ${customer.customer_name}
                            </p>

                        </div>

                        <span class="text-[#7b0000] font-bold">
                            View →
                        </span>

                    </a>
                `;

            });

        }



        // ORDERS
        if(data.orders && data.orders.length > 0)
        {

            html += `
                <div class="p-4 border-b bg-gray-50 font-bold text-[#7b0000]">
                    Orders
                </div>
            `;

            data.orders.forEach(order => {

                html += `
                    <a href="/order_history"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b">

                        <div>

                            <p class="font-bold">
                                ${order.order_id}
                            </p>

                            <p class="text-sm text-gray-400">
                                Rp ${new Intl.NumberFormat('id-ID').format(order.total_price)}
                            </p>

                        </div>

                        <span class="text-[#7b0000] font-bold">
                            View →
                        </span>

                    </a>
                `;

            });

        }

        // EMPTY
        if(html === '')
        {

            html = `
                <div class="p-8 text-center text-gray-400">
                    No results found.
                </div>
            `;

        }

        results.innerHTML = html;

        dropdown.classList.remove('hidden');

    }
    catch(error)
    {

        console.error(error);

    }

});



/*
|--------------------------------------------------------------------------
| CLOSE DROPDOWN
|--------------------------------------------------------------------------
*/

document.addEventListener('click', function(e) {

    if(
        !searchInput.contains(e.target)
        &&
        !dropdown.contains(e.target)
    )
    {
        dropdown.classList.add('hidden');
    }

});

}

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

<script>

/*
|--------------------------------------------------------------------------
| NOTIFICATION DROPDOWN
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const notifBtn = document.getElementById('notif-btn');
    const notifDropdown = document.getElementById('notif-dropdown');

    if(notifBtn && notifDropdown)
    {

        notifBtn.addEventListener('click', function(e) {

            e.stopPropagation();

            notifDropdown.classList.toggle('hidden');

        });




        document.addEventListener('click', function(e) {

            if(
                !notifDropdown.contains(e.target)
                &&
                !notifBtn.contains(e.target)
            )
            {
                notifDropdown.classList.add('hidden');
            }

        });

    }

});

</script>
</html>



        