<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dagangin POS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body{
            background:#f7f5f3;
        }

        .sidebar-gradient{
            background: linear-gradient(180deg,#7b0000,#8d0000);
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-[320px] sidebar-gradient text-white flex flex-col justify-between">

        <div>

            {{-- LOGO --}}
            <div class="px-8 pt-8 pb-10">

                <div class="flex items-center gap-4">

                    <div class="bg-white text-[#7b0000] w-14 h-14 rounded-2xl flex items-center justify-center">
                        <i data-lucide="store" class="w-7 h-7"></i>
                    </div>

                    <div>
                        <h1 class="text-5xl font-black leading-none">
                            Dagangin
                        </h1>

                        <p class="uppercase text-sm opacity-70 tracking-widest">
                            Modern Steward
                        </p>
                    </div>

                </div>

            </div>

            {{-- MENU --}}
            <div class="px-6 space-y-3">

                <a href="/dashboard"
                   class="bg-white/10 border-r-4 border-white flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl font-bold">

                    <i data-lucide="layout-dashboard"></i>
                    Dashboard
                </a>

                <a href="#"
                   class="flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl opacity-80 hover:bg-white/10">

                    <i data-lucide="calculator"></i>
                    Point of Sale
                </a>

                <a href="#"
                   class="flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl opacity-80 hover:bg-white/10">

                    <i data-lucide="package"></i>
                    Inventory
                </a>

                <a href="#"
                   class="flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl opacity-80 hover:bg-white/10">

                    <i data-lucide="receipt"></i>
                    Orders
                </a>

                <a href="#"
                   class="flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl opacity-80 hover:bg-white/10">

                    <i data-lucide="users"></i>
                    Customers
                </a>

                <a href="#"
                   class="flex items-center gap-4 px-6 py-5 rounded-2xl text-2xl opacity-80 hover:bg-white/10">

                    <i data-lucide="bar-chart-3"></i>
                    Reports
                </a>

            </div>

            {{-- OPEN REGISTER --}}
            <div class="px-6 mt-10">

                <button class="bg-white text-[#7b0000] w-full py-6 rounded-3xl text-2xl font-bold shadow-xl">
                    + Open Register
                </button>

            </div>

        </div>


        {{-- BOTTOM --}}
        <div class="p-6">

            <div class="bg-white/10 rounded-3xl p-5 flex items-center gap-4">

                <img
                    src="https://i.pravatar.cc/100"
                    class="w-16 h-16 rounded-2xl"
                >

                <div>
                    <h3 class="text-2xl font-bold">
                        Ahmad's Coffee
                    </h3>

                    <p class="opacity-70">
                        Store Manager
                    </p>
                </div>

            </div>

        </div>

    </aside>


    {{-- MAIN --}}
    <main class="flex-1 p-8 overflow-auto">

        {{-- NAVBAR --}}
        <div class="flex justify-between items-center mb-8">

            <h1 class="text-5xl font-black text-[#7b0000]">
                Dashboard
            </h1>

            <div class="flex items-center gap-6">

                <div class="bg-white px-6 py-4 rounded-full w-[600px] shadow-sm border">

                    <input
                        type="text"
                        placeholder="Search everything..."
                        class="outline-none w-full text-xl"
                    >

                </div>

                <div class="flex items-center gap-5">

                    <i data-lucide="bell" class="w-7 h-7"></i>
                    <i data-lucide="refresh-cw" class="w-7 h-7"></i>

                </div>

            </div>

        </div>

        @yield('content')

    </main>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>