<?php $__env->startSection('content'); ?>
<section class="max-w-5xl mx-auto px-8 py-24">

    <h2 class="text-5xl font-black">
        Transaction History
    </h2>

    <div class="space-y-5 mt-14">

        <?php for($i = 0; $i < 4; $i++): ?>

            <div class="bg-white rounded-3xl p-6 flex items-center justify-between">

                <div>
                    <h3 class="font-black">
                        Oreo Blade Signature
                    </h3>

                    <p class="text-sm text-stone-500 mt-1">
                        24 May 2026
                    </p>
                </div>

                <div class="text-right">
                    <p class="font-black text-[#8C1717]">
                        Rp 45.000
                    </p>

                    <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold">
                        Completed
                    </span>
                </div>

            </div>

        <?php endfor; ?>

    </div>

</section>
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Herd\webdev-frombroole\resources\views/customer/transactions_history.blade.php ENDPATH**/ ?>