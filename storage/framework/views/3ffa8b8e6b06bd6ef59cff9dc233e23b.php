<section class="max-w-7xl mx-auto px-8 py-24">

    <div class="text-center">

        <span class="text-[#8C1717] font-bold uppercase tracking-widest text-xs">
            Browse Collection
        </span>

        <h2 class="text-5xl font-black mt-4">
            Shop All Desserts
        </h2>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">

        <?php for($i=0;$i<6;$i++): ?>

        <div class="bg-white rounded-[32px] p-6">

            <div class="h-52 bg-[#F8F5F2] rounded-2xl flex items-center justify-center">

                <img
                    src="/fb_broole.png"
                    class="w-40"
                >

            </div>

            <h3 class="font-black text-xl mt-5">
                Oreo Blade
            </h3>

            <p class="text-sm text-stone-500 mt-2">
                Crunchy chocolate luxury.
            </p>

            <div class="flex items-center justify-between mt-6">

                <p class="font-black text-[#8C1717]">
                    Rp 45.000
                </p>

                <button class="bg-[#8C1717] text-white px-5 py-2 rounded-xl text-xs font-bold">
                    ADD
                </button>

            </div>

        </div>

        <?php endfor; ?>

    </div>

</section><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/customer/shop.blade.php ENDPATH**/ ?>