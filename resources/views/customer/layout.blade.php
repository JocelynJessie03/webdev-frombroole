<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="en" data-theme="light">
    <script>
        (function(){ document.documentElement.setAttribute('data-theme', localStorage.getItem('frombroole_theme') || 'light'); })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- AI --}}
    <meta
    name="csrf-token"
    content="{{ csrf_token() }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- DARK MODE STYLES -->
    <style>
    :root {
        --bg-base: #F8F5F2; --bg-nav: #F5F4EE; --bg-card: #FFFFFF;
        --bg-subtle: rgba(61,56,51,0.05); --text-primary: #3D3833;
        --text-muted: rgba(61,56,51,.70); --border-light: rgba(224,222,215,.40);
        --border-subtle: rgba(61,56,51,.05); --brand: #9E1111; --brand-deep: #8C1717;
        --topbar-bg: #9E1111; --input-bg: #FFFFFF;
    }
    [data-theme="dark"] {
        --bg-base: #1A1714; --bg-nav: #211E1A; --bg-card: #2A2520;
        --bg-subtle: rgba(255,255,255,.04); --text-primary: #F0EDE8;
        --text-muted: rgba(240,237,232,.55); --border-light: rgba(255,255,255,.08);
        --border-subtle: rgba(255,255,255,.06); --brand: #E03333; --brand-deep: #C82222;
        --topbar-bg: #7A0D0D; --input-bg: #2A2520;
    }

    body { background: var(--bg-base) !important; color: var(--text-primary) !important; transition: background .35s, color .35s; }
    header { background: var(--bg-nav) !important; border-color: var(--border-light) !important; }
    .bg-\[#F8F5F2\]  { background: var(--bg-base) !important; }
    .bg-\[#F5F4EE\], .bg-\[#F5F4EE\]\/95 { background: var(--bg-nav) !important; }
    .text-\[#3D3833\]     { color: var(--text-primary) !important; }
    .text-\[#3D3833\]\/70 { color: var(--text-muted) !important; }
    .border-\[#E0DED7\]\/40 { border-color: var(--border-light) !important; }
    .bg-\[#3D3833\]\/5    { background: var(--bg-subtle) !important; }
    .border-\[#3D3833\]\/5 { border-color: var(--border-subtle) !important; }
    .bg-\[#9E1111\]       { background: var(--topbar-bg) !important; }
    .bg-white             { background: var(--bg-card) !important; }
    [data-theme="dark"] input,
    [data-theme="dark"] textarea,
    [data-theme="dark"] select { background: var(--input-bg) !important; color: var(--text-primary) !important; border-color: var(--border-light) !important; }
    [data-theme="dark"] [x-show="openWidget"] { background: var(--bg-card); border-color: var(--border-light); }
    [data-theme="dark"] .bg-gray-50 { background: rgba(255,255,255,.03) !important; }

    /* ── TOGGLE BUTTON ── */
    #dm-toggle {
        position: fixed;
        bottom: 90px;
        right: 22px;
        z-index: 9999;
        cursor: grab;
        user-select: none;
        touch-action: none;
    }
    #dm-toggle:active { cursor: grabbing; }
    #dm-toggle-btn {
        width: 58px; height: 58px;
        border-radius: 50%;
        border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: transform .2s, box-shadow .4s, background .4s;
        position: relative;
        overflow: visible;
    }
    #dm-toggle-btn:hover { transform: scale(1.10); }
    #dm-toggle-btn:active { transform: scale(.93); }

    /* Light mode = red glow */
    [data-theme="light"] #dm-toggle-btn {
        background: #FFFFFF;
        box-shadow:
        0 0 0 2px rgba(158,17,17,.22),
        0 0 18px 6px rgba(158,17,17,.28),
        0 0 42px 14px rgba(158,17,17,.11),
        0 4px 16px rgba(0,0,0,.12);
    }
    [data-theme="light"] #dm-toggle-btn:hover {
        box-shadow:
        0 0 0 2.5px rgba(158,17,17,.38),
        0 0 28px 10px rgba(158,17,17,.44),
        0 0 62px 22px rgba(158,17,17,.17),
        0 6px 20px rgba(0,0,0,.15);
    }

    /* Dark mode = gold glow */
    [data-theme="dark"] #dm-toggle-btn {
        background: #2A2520;
        box-shadow:
        0 0 0 2px rgba(245,200,66,.28),
        0 0 18px 6px rgba(245,200,66,.34),
        0 0 42px 14px rgba(245,200,66,.13),
        0 4px 16px rgba(0,0,0,.35);
    }
    [data-theme="dark"] #dm-toggle-btn:hover {
        box-shadow:
        0 0 0 2.5px rgba(245,200,66,.48),
        0 0 28px 10px rgba(245,200,66,.54),
        0 0 62px 22px rgba(245,200,66,.21),
        0 6px 20px rgba(0,0,0,.45);
    }

    /* Icon swap */
    .dm-icon { position: absolute; width: 28px; height: 28px; transition: opacity .3s, transform .3s; }
    [data-theme="light"] .dm-icon-moon { opacity: 1; transform: rotate(0deg) scale(1); }
    [data-theme="light"] .dm-icon-sun  { opacity: 0; transform: rotate(90deg) scale(.5); }
    [data-theme="dark"]  .dm-icon-moon { opacity: 0; transform: rotate(-90deg) scale(.5); }
    [data-theme="dark"]  .dm-icon-sun  { opacity: 1; transform: rotate(0deg) scale(1); }

    /* Tooltip */
    #dm-toggle::after {
        content: attr(data-tip);
        position: absolute; right: 68px; top: 50%; transform: translateY(-50%);
        padding: 5px 12px; border-radius: 20px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        white-space: nowrap; pointer-events: none;
        opacity: 0; transition: opacity .2s;
        background: var(--bg-card); color: var(--brand);
        box-shadow: 0 2px 12px rgba(0,0,0,.15);
    }
    #dm-toggle:hover::after { opacity: 1; }
    </style>

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
                <a
    href="{{ route('customer.tasks.index') }}"
    class="text-[11px] uppercase tracking-[0.2em] font-black {{ Route::is('customer.tasks.index') ? 'text-[#8C1717]' : 'text-[#3D3833]/70' }} hover:text-[#8C1717] transition"
>
    Tasks & Coupons
</a>

<div class="relative flex items-center" x-data="{ openWidget: false, widgetTasks: [], fetchTasks() { fetch('{{ route('customer.tasks.widget') }}').then(res => res.json()).then(data => this.widgetTasks = data) } }" @mouseenter="openWidget = true; fetchTasks()" @mouseleave="openWidget = false">
    <button class="w-11 h-11 rounded-2xl bg-[#3D3833]/5 border border-[#3D3833]/5 flex items-center justify-center hover:scale-105 transition relative">
        📋
        @auth('customer')
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-[#9E1111] rounded-full animate-ping"></span>
        @endauth
    </button>

    <div x-show="openWidget" x-transition class="absolute right-0 top-12 w-72 bg-white rounded-2xl shadow-xl border p-4 z-50 text-left">
        <h4 class="text-xs font-black uppercase tracking-wider text-[#8C1717] mb-2">Available Tier Tasks</h4>
        <div class="space-y-2 max-h-60 overflow-y-auto">
            <template x-for="item in widgetTasks" :key="item.id">
                <div class="p-2 border rounded-xl text-xs flex justify-between items-center" :class="item.unlocked ? 'bg-white' : 'bg-gray-50 opacity-60'">
                    <div>
                        <p class="font-bold text-[#3D3833]" x-text="item.title"></p>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider" 
                              :class="item.required_tier === 'Gold' ? 'bg-yellow-100 text-yellow-700' : (item.required_tier === 'Silver' ? 'bg-gray-100 text-gray-600' : 'bg-orange-100 text-orange-700')"
                              x-text="item.required_tier"></span>
                    </div>
                    <div>
                        <span x-if="item.claimed" class="text-green-600 font-bold">✓ Claimed</span>
                        <span x-if="!item.claimed && item.unlocked" class="text-[#9E1111] font-bold">Available</span>
                        <span x-if="!item.unlocked" class="text-gray-400">🔒 Locked</span>
                    </div>
                </div>
            </template>
        </div>
        <a href="{{ route('customer.tasks.index') }}" class="block text-center text-[10px] uppercase tracking-wider font-black text-[#9E1111] mt-3 hover:underline">View All Tasks</a>
    </div>
</div>
                <div class="flex items-center gap-4 border-l border-[#3D3833]/10 pl-5">
                    @auth
                        {{-- PROFILE BUTTON DIRECT LINK --}}
                        <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full bg-[#F3F1EC] border border-[#3D3833]/10 flex items-center justify-center text-[#8C1717] hover:scale-105 transition shadow-sm" title="Edit Profile">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        {{-- LOGOUT BUTTON (ICON ONLY) --}}
                        <form method="POST" action="{{ route('logout') }}" class="m-0" onsubmit="clearCustomerLocalStorage()">
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

<script>
/**
 * Clear customer-specific localStorage data saat logout
 * Ini mencegah data dari user sebelumnya (seperti points) tampil di user baru
 */
function clearCustomerLocalStorage() {
    // Clear customer-specific localStorage keys
    const keysToRemove = [
        'customer_cart',
        'checkout_payload',
        'available_points',
        'user_member_points',
        'last_customer_id'
    ];
    
    keysToRemove.forEach(key => {
        localStorage.removeItem(key);
    });
    
    console.log('Customer localStorage cleared on logout');
    return true;
}
</script>

<!-- DRAGGABLE DARK MODE TOGGLE -->
<div id="dm-toggle" data-tooltip="Dark Mode">
    <button id="dm-toggle-btn" onclick="toggleDarkMode()" title="Toggle dark mode" aria-label="Toggle dark/light mode">
        <!-- Moon (shown in light mode) -->
        <span class="dm-icon-moon">🌙</span>
        <!-- Sun (shown in dark mode) -->
        <span class="dm-icon-sun">☀️</span>
    </button>
</div>

<script>

/* ===== DARK MODE ===== */
    <div id="dm-toggle" data-tip="Dark Mode">
    <button id="dm-toggle-btn" onclick="dmToggle()" aria-label="Toggle dark/light mode">

        <!-- Moon (light mode) -->
        <svg class="dm-icon dm-icon-moon" viewBox="0 0 24 24" fill="none">
        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"
                fill="#8C1717" stroke="#8C1717" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <!-- Sun (dark mode) -->
        <svg class="dm-icon dm-icon-sun" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="5" fill="#F5C842" stroke="#F5C842" stroke-width="1.5"/>
        <line x1="12" y1="1"  x2="12" y2="4"  stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="12" y1="20" x2="12" y2="23" stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="1"  y1="12" x2="4"  y2="12" stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="20" y1="12" x2="23" y2="12" stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="4.22"  y1="4.22"  x2="6.34"  y2="6.34"  stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="17.66" y1="17.66" x2="19.78" y2="19.78" stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="4.22"  y1="19.78" x2="6.34"  y2="17.66" stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        <line x1="17.66" y1="6.34"  x2="19.78" y2="4.22"  stroke="#F5C842" stroke-width="2" stroke-linecap="round"/>
        </svg>

    </button>
    </div>

    <script>
    // Toggle
    function dmToggle() {
    const html = document.documentElement;
    const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('frombroole_theme', next);
    document.getElementById('dm-toggle').setAttribute(
        'data-tip', next === 'dark' ? 'Light Mode' : 'Dark Mode'
    );
    }

    // Draggable
    (function() {
    const el = document.getElementById('dm-toggle');
    let drag = false, moved = false, sx, sy, il, it;

    function clamp(v, a, b) { return Math.min(Math.max(v, a), b); }

    function start(cx, cy) {
        drag = true; moved = false;
        const r = el.getBoundingClientRect();
        il = r.left; it = r.top; sx = cx; sy = cy;
        el.style.cursor = 'grabbing';
    }
    function move(cx, cy) {
        if (!drag) return;
        const dx = cx - sx, dy = cy - sy;
        if (Math.abs(dx) > 4 || Math.abs(dy) > 4) moved = true;
        const W = window.innerWidth, H = window.innerHeight;
        const w = el.offsetWidth || 58, h = el.offsetHeight || 58;
        el.style.left   = clamp(il + dx, 8, W - w - 8) + 'px';
        el.style.top    = clamp(it + dy, 8, H - h - 8) + 'px';
        el.style.right  = 'auto';
        el.style.bottom = 'auto';
    }
    function end() {
        if (!drag) return;
        drag = false;
        el.style.cursor = 'grab';
        if (moved) {
        const r = el.getBoundingClientRect();
        localStorage.setItem('fb_toggle_pos', JSON.stringify({ l: r.left, t: r.top }));
        // block next click from firing toggle
        el.querySelector('button').addEventListener('click', function absorb(e) {
            e.stopImmediatePropagation(); e.preventDefault();
            this.removeEventListener('click', absorb);
        }, true);
        }
    }

    el.addEventListener('mousedown',  e => { if (e.button === 0) { start(e.clientX, e.clientY); e.preventDefault(); } });
    document.addEventListener('mousemove', e => move(e.clientX, e.clientY));
    document.addEventListener('mouseup',   end);
    el.addEventListener('touchstart', e => { start(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); }, { passive: false });
    document.addEventListener('touchmove', e => move(e.touches[0].clientX, e.touches[0].clientY), { passive: false });
    document.addEventListener('touchend',  end);

    // Restore saved position
    try {
        const s = JSON.parse(localStorage.getItem('fb_toggle_pos') || 'null');
        if (s) {
        const W = window.innerWidth, H = window.innerHeight;
        el.style.left = clamp(s.l, 8, W - 66) + 'px';
        el.style.top  = clamp(s.t, 8, H - 66) + 'px';
        el.style.right = 'auto'; el.style.bottom = 'auto';
        }
    } catch(e) {}
    })();
    </script>

</body>
</html>