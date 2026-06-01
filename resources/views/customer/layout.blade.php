<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- AI --}}
    <meta
    name="csrf-token"
    content="{{ csrf_token() }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>From Broole</title>
</head>

<body class="bg-[#F8F5F2] text-[#3D3833]">

<div x-data="{ activeTab: 'home' }" class="min-h-screen">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 bg-[#F5F4EE]/95 backdrop-blur-md border-b border-[#E0DED7]/40">
        {{-- TOP BAR --}}
        <div class="w-full bg-[#9E1111] text-[#FAF9F5] text-[10px] tracking-[0.25em] font-black uppercase text-center py-1.5 px-4">
            ✨ SWEETNESS REDEFINED • EARN 10 PTS ON SIGNATURE DESSERT CUPS WITH FROM BROOLE ✨
        </div>

        {{-- MAIN NAV --}}
        <div class="h-[64px] px-6 lg:px-12 flex items-center justify-between">
            {{-- LEFT --}}
            <div @click="activeTab='home'" class="flex items-center gap-3 cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-[#9E1111] flex items-center justify-center text-white shadow-md">
                    ✨
                </div>
                <span class="text-[15px] tracking-[0.28em] font-black uppercase text-[#8C1717]">
                    From Broole
                </span>
            </div>

            {{-- CENTER NAV --}}
            <nav class="hidden lg:flex items-center gap-10">
                <a
                    href="{{ route('customer.home') }}"
                    class="text-[11px] uppercase tracking-[0.2em] font-black {{ Route::is('customer.home') ? 'text-[#8C1717]' : 'text-[#3D3833]/70' }} hover:text-[#8C1717] transition"
                >
                    Home
                </a>
                <a
                    href="{{ route('customer.shop') }}"
                    class="text-[11px] uppercase tracking-[0.2em] font-black {{ Route::is('customer.shop') ? 'text-[#8C1717]' : 'text-[#3D3833]/70' }} hover:text-[#8C1717] transition"
                >
                    Shop
                </a>
                <a
                    href="{{ route('customer.history') }}"
                    class="text-[11px] uppercase tracking-[0.2em] font-black {{ Route::is('customer.history') ? 'text-[#8C1717]' : 'text-[#3D3833]/70' }} hover:text-[#8C1717] transition"
                >
                    Transaction History
                </a>
                <a
                    href="{{ route('customer.about') }}#about-section"
                    class="text-[11px] uppercase tracking-[0.2em] font-black text-[#3D3833]/70 hover:text-[#8C1717] transition"
                >
                    About
                </a>
            </nav>

            {{-- RIGHT --}}
            <div class="flex items-center gap-5">
                {{-- CART --}}
                <button class="w-11 h-11 rounded-2xl bg-[#3D3833]/5 border border-[#3D3833]/5 flex items-center justify-center hover:scale-105 transition">🛒</button>

                <div class="flex items-center gap-4 border-l border-[#3D3833]/10 pl-5">
                    @auth
                        {{-- PROFILE BUTTON DIRECT LINK --}}
                        <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full bg-[#F3F1EC] border border-[#3D3833]/10 flex items-center justify-center text-[#8C1717] hover:scale-105 transition shadow-sm" title="Edit Profile">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        {{-- LOGOUT BUTTON (ICON ONLY) --}}
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-full bg-[#FFF1F1] border border-[#8C1717]/10 flex items-center justify-center text-[#8C1717] hover:bg-[#8C1717] hover:text-white hover:scale-105 transition shadow-sm" title="Sign Out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            </button>
                        </form>
                    @else
                        {{-- GUEST LOGIN LINK (ICON ONLY) --}}
                        <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-[#F3F1EC] border border-[#3D3833]/10 flex items-center justify-center text-[#655F5A] hover:bg-[#8C1717] hover:text-white hover:border-[#8C1717] hover:scale-105 transition shadow-sm" title="Login / Register">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')

        @include('customer.partials.ai-chat')
    </main>

</div>

</body>
</html>