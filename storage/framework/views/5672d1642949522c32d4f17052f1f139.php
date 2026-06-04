<!DOCTYPE html>
<html lang="en">
<head>
    <script>
    (function(){ document.documentElement.setAttribute('data-theme', localStorage.getItem('frombroole_theme') || 'light'); })();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

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

    [data-theme="dark"] body {
    background: var(--bg-base) !important;
    color: var(--text-primary) !important;
    transition: background .35s, color .35s; }
    
    header { background: var(--bg-nav) !important; border-color: var(--border-light) !important; }
    .bg-\[#F8F5F2\]  { background: var(--bg-base) !important; }
    .bg-\[#F5F4EE\], .bg-\[#F5F4EE\]\/95 { background: var(--bg-nav) !important; }
    [data-theme="dark"] .text-\[#3D3833\] {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .text-\[#3D3833\]\/70 {
        color: var(--text-muted) !important;
    }

    [data-theme="dark"] .border-\[#E0DED7\]\/40 {
        border-color: var(--border-light) !important;
    }

    [data-theme="dark"] .bg-\[#3D3833\]\/5 {
        background: var(--bg-subtle) !important;
    }

    [data-theme="dark"] .border-\[#3D3833\]\/5 {
        border-color: var(--border-subtle) !important;
    }

    [data-theme="dark"] .bg-\[#9E1111\] {
        background: var(--topbar-bg) !important;
    }

    [data-theme="dark"] .bg-white {
        background: var(--bg-card) !important;
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Midtrans Snap Payment Gateway -->
    <?php if(config('midtrans.is_production')): ?>
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
    <?php else: ?>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
    <?php endif; ?>

    <title>From Broole</title>
</head>

<body class="bg-[#F8F5F2] text-[#3D3833]">

<div
    x-data="{ activeTab: 'home', mobileOpen: false }"
    class="min-h-screen"
>

    
    <header class="sticky top-0 z-50">

        
        <div class="relative overflow-hidden bg-[#8C1717] py-2.5 text-center">
            <div
                class="pointer-events-none absolute inset-0"
                style="background:repeating-linear-gradient(90deg,transparent,transparent 60px,rgba(255,255,255,0.04) 60px,rgba(255,255,255,0.04) 61px)"
            ></div>
            <p class="relative z-10 font-['Montserrat'] text-[9px] font-semibold uppercase tracking-[0.4em] text-white/90">
                ✦ &nbsp; Hi Broolers! &nbsp;·&nbsp; Earn Points with Every Purchase &nbsp;·&nbsp; Redeem Exclusive Rewards &nbsp;✦
            </p>
        </div>

        
        <div class="border-b border-[#8C1717]/10 bg-[#FDFAF7]">
            <div class="flex h-20 items-center justify-between px-4 lg:px-6">

                
                <a href="/" class="flex flex-shrink-0 items-center gap-3.5 no-underline">
                    <div class="flex h-[46px] w-[46px] flex-shrink-0 items-center justify-center rounded-full bg-[#8C1717]">
                        <img
    src="<?php echo e(asset('home/logo.png')); ?>"
    alt="From Broole logo"
    class="h-12 w-auto object-contain"
/>
                    </div>
                    <div>
                        <span class="block font-['Cormorant_Garamond'] text-[21px] font-bold leading-none tracking-[0.06em] text-[#8C1717]">
                            From Broole
                        </span>
                        <span class="mt-0.5 block font-['Montserrat'] text-[8px] font-medium uppercase tracking-[0.35em] text-[#A89080]">
                            Artisan Desserts
                        </span>
                    </div>
                </a>

                
                <nav class="hidden flex-1 items-center justify-center gap-1 lg:flex">

    <a
        href="<?php echo e(route('customer.home')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.home') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        Home
    </a>

    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
        href="<?php echo e(route('customer.shop')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.shop') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        Shop
    </a>
    
    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
        href="<?php echo e(route('customer.history')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.history') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        Transaction History
    </a>


    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
       href="<?php echo e(route('customer.contact')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.contact') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        Contact
    </a>

    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
        href="<?php echo e(route('customer.about')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.about') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        About
    </a>

</nav>

                
                <div class="flex flex-shrink-0 items-center gap-2.5">



<div
    class="relative"
    x-data="{
        openWidget:false,
        widgetTasks:[],
        fetchTasks(){
            fetch('<?php echo e(route('customer.tasks.widget')); ?>')
                .then(res => res.json())
                .then(data => this.widgetTasks = data)
        }
    }"
    @mouseenter="openWidget=true;fetchTasks()"
    @mouseleave="openWidget=false"
>

    <button
    class="
    relative
    flex h-11 w-11
    items-center justify-center
    rounded-xl
    border border-[#8C1717]/10
    bg-white
    text-[#7A6E68]
    shadow-sm
    transition-all duration-300
    hover:-translate-y-1
    hover:shadow-lg
    hover:border-[#8C1717]/30
    hover:text-[#8C1717]
    "
>

    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.8"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
        />
    </svg>

    <?php if(auth()->guard()->check()): ?>

        <span
            class="
            absolute
            -top-1
            -right-1
            flex
            h-5
            w-5
            items-center
            justify-center
            rounded-full
            bg-[#8C1717]
            text-white
            text-[10px]
            font-bold
            ring-2
            ring-white
            "
        >
            !
        </span>

    <?php endif; ?>

</button>

    <div
        x-show="openWidget"
        x-transition
        class="absolute right-0 top-12 w-72 bg-white rounded-2xl shadow-xl border p-4 z-50"
    >

        <h4 class="text-xs font-bold uppercase tracking-wider text-[#8C1717] mb-3">
            Available Tier Tasks
        </h4>

        <div class="space-y-2 max-h-60 overflow-y-auto">

            <template x-for="item in widgetTasks" :key="item.id">

                <div
                    class="p-2 border rounded-xl flex justify-between items-center text-xs"
                    :class="item.unlocked ? 'bg-white' : 'bg-gray-50 opacity-60'"
                >

                    <div>
                        <p class="font-semibold" x-text="item.title"></p>

                        <span
                            class="px-2 py-1 rounded text-[9px] uppercase font-bold"
                            x-text="item.required_tier"
                        ></span>
                    </div>

                    <div>
                        <span x-show="item.claimed" class="text-green-600 font-bold">
                            ✓ Claimed
                        </span>

                        <span x-show="!item.claimed && item.unlocked" class="text-[#8C1717] font-bold">
                            Available
                        </span>

                        <span x-show="!item.unlocked" class="text-gray-400">
                            🔒 Locked
                        </span>
                    </div>

                </div>

            </template>

        </div>

        <a
            href="<?php echo e(route('customer.tasks.index')); ?>"
            class="block mt-3 text-center text-[10px] uppercase tracking-wider font-bold text-[#8C1717]"
        >
            View All Tasks
        </a>

    </div>

</div>



    

<div x-data="{ open:false }" class="relative">

    <button
        @click="open = !open"
        class="flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:-translate-y-px hover:border-[#8C1717]/30 hover:text-[#8C1717] hover:shadow-[0_4px_12px_rgba(140,23,23,0.1)]"
    >
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
        </svg>
    </button>

    <div
        x-show="open"
        @click.outside="open=false"
        x-transition
        class="absolute right-0 mt-3 w-64 overflow-hidden rounded-2xl border border-[#E5E0DA] bg-white shadow-xl z-50"
    >

        <?php if(auth()->guard()->check()): ?>

            <div class="p-5 flex items-center gap-4">

    
    <div
        class="
        w-14 h-14
        rounded-full
        bg-gradient-to-br
        from-[#8C1717]
        to-[#B12828]
        text-white
        flex items-center justify-center
        text-lg font-bold
        shadow-md
        "
    >
       <img
    src="<?php echo e(asset('Avatar/' . auth()->user()->avatar)); ?>"
    class="w-14 h-14 rounded-full object-cover"
>
    </div>

    
    <?php
    $cust = \App\Models\Customer::where(
        'email',
        auth()->user()->email
    )->first();
    ?>

        <div>
            
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-lg text-[#2C2623] leading-tight">
                    <?php echo e(auth()->user()->name); ?>

                </h3>
                <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-[10px] uppercase font-bold flex-shrink-0">
                    <?php echo e($cust->tier ?? 'Bronze'); ?>

                </span>
            </div>

            
            <div class="flex items-center gap-1 mt-1">
                <span class="text-[#8C1717] text-sm">✨</span>
                <span class="font-bold text-[#8C1717] text-sm">
                    <?php echo e(number_format($cust->member_points ?? 0)); ?>

                </span>
                <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">pts</span>
            </div>

            <p class="text-xs text-gray-500 mt-1">
                <?php echo e(auth()->user()->email); ?>

            </p>
        </div>

</div>

            <div class="border-t"></div>

            <div class="p-2">

                <a
                    href="<?php echo e(route('profile.edit')); ?>"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Edit Profile
                </a>

        
                <form method="POST" action="<?php echo e(route('logout')); ?>" onsubmit="clearCustomerLocalStorage()">
                    <?php echo csrf_field(); ?>

                    <button
                        type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl hover:bg-red-50 text-red-600"
                    >
                        Logout
                    </button>
                </form>

            </div>

        <?php else: ?>

            <div class="p-5">
                <h3 class="font-bold text-lg">
                    Welcome Guest
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Sign in to access your dessert rewards
                </p>

                <div class="mt-5 space-y-3">

                    <a
                        href="/"
                        class="block w-full text-center bg-[#8C1717] text-white py-3 rounded-xl font-semibold"
                    >
                        Login
                    </a>

                    <a
                        href="/"
                        class="block w-full text-center bg-[#F3F1EC] py-3 rounded-xl font-semibold"
                    >
                        Register
                    </a>

                </div>
            </div>

        <?php endif; ?>

    </div>

</div>
                

                    
                    <button
                        @click="mobileOpen = !mobileOpen"
                        class="flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:border-[#8C1717]/30 hover:text-[#8C1717] lg:hidden"
                        aria-label="Toggle menu"
                    >
                        <svg x-show="!mobileOpen" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 12h18M3 6h18M3 18h18"/>
                        </svg>
                        <svg x-show="mobileOpen" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </button>

                </div>
            </div>

            
            <d
<div
    x-show="mobileOpen"
    x-transition:enter="transition duration-200 ease-out"
    x-transition:enter-start="-translate-y-2 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-2 opacity-0"
    class="border-t border-[#8C1717]/10 bg-[#FDFAF7] px-6 py-5 lg:hidden"
>

    <div
    x-show="mobileOpen"
    x-transition
    class="absolute left-0 top-full w-full bg-[#FDFAF7] shadow-xl z-[999] lg:hidden"
>

    <div class="flex flex-col p-6 gap-5">

        <a href="<?php echo e(route('customer.home')); ?>" class="font-semibold text-[#7A6E68]">
            Home
        </a>

        <a href="<?php echo e(route('customer.about')); ?>" class="font-semibold text-[#7A6E68]">
            About
        </a>

        <a href="<?php echo e(route('customer.shop')); ?>" class="font-semibold text-[#7A6E68]">
            Shop
        </a>

        <a href="<?php echo e(route('customer.tasks.index')); ?>" class="font-semibold text-[#7A6E68]">
            Coupons
        </a>

        <a href="<?php echo e(route('customer.history')); ?>" class="font-semibold text-[#7A6E68]">
            Transaction History
        </a>

        <a href="<?php echo e(route('customer.contact')); ?>" class="font-semibold text-[#7A6E68]">
            Contact
        </a>

    </div>

</div>
                
    </header>

    
    <main>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>
 <?php echo $__env->make('customer.partials.ai-chat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    
    // Optional: Clear semua localStorage untuk clean slate
    // localStorage.clear();
    
    console.log('Customer localStorage cleared on logout');
    return true;
}
</script>

    <!-- DARK MODE TOGGLE -->
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
</html><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/layouts/app.blade.php ENDPATH**/ ?>