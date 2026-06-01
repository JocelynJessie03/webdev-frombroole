<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                ✦ &nbsp; Sweetness Redefined &nbsp;·&nbsp; Earn 10 pts on every Signature Dessert Cup &nbsp; ✦
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
        href="/"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('pos') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        Shop
    </a>

    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
        href="<?php echo e(route('customer.about')); ?>"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('customer.about') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
    >
        About
    </a>

    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

    <a
        href="/"
        class="relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em]
        <?php echo e(Route::is('order_history') ? 'text-[#8C1717]' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
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

</nav>

                
                <div class="flex flex-shrink-0 items-center gap-2.5">

                    
                    <button
                        class="flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:-translate-y-px hover:border-[#8C1717]/30 hover:text-[#8C1717] hover:shadow-[0_4px_12px_rgba(140,23,23,0.1)]"
                        aria-label="Search"
                    >
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                    </button>

                    
                    <button
                        class="relative flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:-translate-y-px hover:border-[#8C1717]/30 hover:text-[#8C1717] hover:shadow-[0_4px_12px_rgba(140,23,23,0.1)]"
                        aria-label="Cart"
                    >
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
                        </svg>
                        
                        <?php if(isset($cartCount)): ?>
                            <?php if($cartCount > 0): ?>
                                <span class="absolute -right-1.5 -top-1.5 flex h-[17px] w-[17px] items-center justify-center rounded-full border-2 border-[#FDFAF7] bg-[#8C1717] font-['Montserrat'] text-[9px] font-bold text-white">
                                    <?php echo e($cartCount > 9 ? '9+' : $cartCount); ?>

                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </button>

        


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

            <div class="p-5">
                <h3 class="font-bold text-[#2C2623]">
                    <?php echo e(auth()->user()->name); ?>

                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    <?php echo e(auth()->user()->email); ?>

                </p>
            </div>

            <div class="border-t"></div>

            <div class="p-2">

                <a
                    href="//"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Profile
                </a>

                <a
                    href="//"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Order History
                </a>

                <form method="POST" action="//">
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

            
            <div
                x-show="mobileOpen"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="-translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="-translate-y-2 opacity-0"
                class="border-t border-[#8C1717]/10 bg-[#FDFAF7] px-6 pb-4 pt-2 lg:hidden"
            >
                

                
            </div>

        </div>
    </header>

    
    <main>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>

</body>
</html><?php /**PATH C:\Users\user\Herd\webdev-frombroole\resources\views/layouts/app.blade.php ENDPATH**/ ?>