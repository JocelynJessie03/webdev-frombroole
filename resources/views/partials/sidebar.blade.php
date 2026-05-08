<aside class="w-[240px] bg-gradient-to-b from-[#7b0000] to-[#8f0000] text-white flex flex-col justify-between min-h-screen">

    <div>

        {{-- LOGO --}}
        <div class="px-5 pt-5 pb-7">

            <div class="flex items-center gap-3">

                <div class="bg-white text-[#7b0000] w-10 h-10 rounded-xl flex items-center justify-center shadow">
                    <i data-lucide="store" class="w-5 h-5"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-black leading-none">
                        Dagangin
                    </h1>

                    <p class="uppercase tracking-widest text-[9px] opacity-70">
                        Modern Steward
                    </p>
                </div>

            </div>

        </div>


        {{-- MENU --}}
        <div class="px-3 space-y-2">

            {{-- ACTIVE --}}
            <a href="/dashboard"
               class="bg-white/10 border-r-4 border-white flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold shadow">

                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>

                Dashboard
            </a>


            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-base opacity-80 hover:bg-white/10 transition">

                <i data-lucide="calculator" class="w-4 h-4"></i>

                Point of Sale
            </a>


            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-base opacity-80 hover:bg-white/10 transition">

                <i data-lucide="package" class="w-4 h-4"></i>

                Inventory
            </a>


            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-base opacity-80 hover:bg-white/10 transition">

                <i data-lucide="receipt" class="w-4 h-4"></i>

                Orders
            </a>


            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-base opacity-80 hover:bg-white/10 transition">

                <i data-lucide="users" class="w-4 h-4"></i>

                Customers
            </a>


            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-base opacity-80 hover:bg-white/10 transition">

                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>

                Reports
            </a>

        </div>


        {{-- OPEN REGISTER --}}
        <div class="px-3 mt-6">

            <button class="bg-white text-[#7b0000] w-full py-3 rounded-2xl text-base font-bold shadow hover:scale-[1.01] transition">

                + Open Register

            </button>

        </div>

    </div>


    {{-- BOTTOM PROFILE --}}
    <div class="p-3">

        <div class="bg-white/10 rounded-2xl p-3 flex items-center gap-3 border border-white/10">

            <img
                src="https://i.pravatar.cc/100"
                class="w-10 h-10 rounded-xl object-cover"
            >

            <div>

                <h3 class="text-sm font-bold">
                    Ahmad's Coffee
                </h3>

                <p class="opacity-70 text-xs">
                    Store Manager
                </p>

            </div>

        </div>

    </div>

</aside>