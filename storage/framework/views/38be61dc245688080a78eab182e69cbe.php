<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <meta
    name="csrf-token"
    content="<?php echo e(csrf_token()); ?>"
>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>From Broole</title>
</head>

<body class="bg-[#F8F5F2] text-[#3D3833]">

<div x-data="{ activeTab: 'home' }" class="min-h-screen">

    
    <header class="sticky top-0 z-50 bg-[#F5F4EE]/95 backdrop-blur-md border-b border-[#E0DED7]/40">
        
        <div class="w-full bg-[#9E1111] text-[#FAF9F5] text-[10px] tracking-[0.25em] font-black uppercase text-center py-1.5 px-4">
            ✨ SWEETNESS REDEFINED • EARN 10 PTS ON SIGNATURE DESSERT CUPS WITH FROM BROOLE ✨
        </div>

        
        <div class="h-[64px] px-6 lg:px-12 flex items-center justify-between">
            
            <div @click="activeTab='home'" class="flex items-center gap-3 cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-[#9E1111] flex items-center justify-center text-white shadow-md">
                    ✨
                </div>
                <span class="text-[15px] tracking-[0.28em] font-black uppercase text-[#8C1717]">
                    From Broole
                </span>
            </div>

            
        <nav class="hidden lg:flex items-center gap-10">

            <a
                href="<?php echo e(route('pos')); ?>"
                class="text-[11px] uppercase tracking-[0.2em] font-black <?php echo e(Route::is('pos') ? 'text-[#8C1717]' : 'text-[#3D3833]/70'); ?> hover:text-[#8C1717] transition"
            >
                Shop
            </a>

            <a
                href="<?php echo e(route('customer.home')); ?>#about-section"
                class="text-[11px] uppercase tracking-[0.2em] font-black text-[#3D3833]/70 hover:text-[#8C1717] transition"
            >
                About
            </a>

            <a
                href="<?php echo e(route('order_history')); ?>"
                class="text-[11px] uppercase tracking-[0.2em] font-black <?php echo e(Route::is('order_history') ? 'text-[#8C1717]' : 'text-[#3D3833]/70'); ?> hover:text-[#8C1717] transition"
            >
                Transaction History
            </a>

            <button class="text-[11px] uppercase tracking-[0.2em] font-black text-[#3D3833]/70 hover:text-[#8C1717] transition">
                Contact
            </button>

        </nav>

            
            <div class="flex items-center gap-3">
                
                <button class="w-11 h-11 rounded-2xl bg-[#3D3833]/5 border border-[#3D3833]/5 flex items-center justify-center hover:scale-105 transition">🛒</button>

                <div class="relative" x-data="{ open: false }">
                    
                    <button @click="open=!open" class="w-11 h-11 rounded-full overflow-hidden border border-[#3D3833]/10 hover:scale-105 transition">
                        <?php if(auth()->guard()->check()): ?>
                            <img src="<?php echo e(auth()->user()->profile_photo ?? 'https://i.pravatar.cc/100'); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-[#F3F1EC] flex items-center justify-center text-lg">👤</div>
                        <?php endif; ?>
                    </button>

                    
                    <div x-show="open" @click.outside="open=false" x-transition class="absolute right-0 mt-4 w-[260px] bg-[#F8F5F2] border border-[#E5E0DA] rounded-[28px] shadow-[0_25px_50px_rgba(0,0,0,0.08)] overflow-hidden z-50">
                        <?php if(auth()->guard()->check()): ?>
                            <div class="p-5">
                                <h3 class="font-black text-[#2C2623]"><?php echo e(auth()->user()->name); ?></h3>
                                <p class="text-sm text-stone-400 mt-1"><?php echo e(auth()->user()->email); ?></p>
                            </div>
                            <div class="border-t border-[#E5E0DA]"></div>
                            <div class="p-3 space-y-1">
                                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white transition text-sm font-black uppercase tracking-wide">✨ Edit Profile</a>
                                <button @click="activeTab='transactions'; open=false" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white transition text-sm font-black uppercase tracking-wide text-left">🧾 Order History</button>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl bg-[#FFF1F1] hover:bg-[#FFE3E3] transition text-sm font-black uppercase tracking-wide text-[#2C2623]">↪ Sign Out</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="p-5">
                                <h3 class="font-black text-lg">Welcome Guest</h3>
                                <p class="text-sm text-stone-400 mt-1">Sign in to access your dessert rewards.</p>
                                <div class="space-y-3 mt-6">
                                    <a href="<?php echo e(route('login')); ?>" class="block text-center bg-[#8C1717] text-white py-3 rounded-2xl font-black uppercase tracking-wider text-sm">Login</a>
                                    <a href="<?php echo e(route('register')); ?>" class="block text-center bg-[#F1ECE8] text-[#2C2623] py-3 rounded-2xl font-black uppercase tracking-wider text-sm">Register</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('customer.partials.ai-chat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </main>

</div>

</body>
</html><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/customer/layout.blade.php ENDPATH**/ ?>