<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto print-area">

    
    <div class="bg-green-100 border border-green-200 rounded-3xl p-6 mb-8 no-print">

        <h1 class="text-3xl font-black text-green-700 mb-2">
            Payment Successful
        </h1>

        <p class="text-green-600">
            Transaction completed successfully.
        </p>

    </div>



    
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-10">

        
        <div class="flex justify-between items-start mb-10">

            <div>

                <h2 class="text-4xl font-black text-[#7b0000] mb-2">
                    RECEIPT
                </h2>

                <p class="text-gray-400">
                    <?php echo e($order->order_id); ?>

                </p>

            </div>

            <div class="text-right">

                <p class="text-sm text-gray-400">
                    Payment Status
                </p>

                <p class="font-black text-green-600">
                    Complete
                </p>

            </div>

        </div>



        
        <div class="space-y-6 mb-10">

            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="flex justify-between items-center border-b pb-5">

                    <div>

                        <h3 class="font-black text-lg">
                            <?php echo e($item->product->pro_name); ?>

                        </h3>
                        <?php if($item->sugar_level < 100): ?>
                            <p class="text-blue-600 font-bold text-xs mb-1">
                                * <?php echo e($item->sugar_level == 50 ? 'Less Sugar (50%)' : 'No Sugar (0%)'); ?>

                            </p>
                        <?php endif; ?>
                        <p class="text-gray-400 text-sm">
                            Qty : <?php echo e($item->quantity); ?>

                        </p>

                    </div>

                    <div>

                        <p class="font-black text-[#7b0000] text-lg">
                            Rp <?php echo e(number_format($item->price_at_purchase * $item->quantity, 0, ',', '.')); ?>

                        </p>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>



        
        <?php

            $subtotal = $order->total_price / 1.10;

            $tax = $order->total_price - $subtotal;

        ?>

        <div class="space-y-5 border-t pt-6">

            <div class="flex justify-between">

                <span class="text-gray-500">
                    Subtotal
                </span>

                <span class="font-bold">
                    Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-gray-500">
                    Tax
                </span>

                <span class="font-bold">
                    Rp <?php echo e(number_format($tax, 0, ',', '.')); ?>

                </span>

            </div>

            <div class="flex justify-between items-center">

                <span class="text-3xl font-black">
                    Total
                </span>

                <span class="text-4xl font-black text-[#7b0000]">
                    Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                </span>

            </div>

        </div>



        
        <div class="flex gap-4 mt-10 no-print">

            <a href="<?php echo e(route('pos')); ?>"
               class="flex-1 bg-[#7b0000] hover:bg-[#650000] text-white py-5 rounded-2xl font-black text-center transition">

                Back To POS

            </a>

            <button
                onclick="window.print()"
                class="flex-1 border border-gray-300 hover:bg-gray-100 py-5 rounded-2xl font-black transition">

                Print Receipt

            </button>

        </div>

    </div>

</div>



<style>

@media print {

    body * {
        visibility: hidden;
    }

    .print-area,
    .print-area * {
        visibility: visible;
    }

    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: white;
        padding: 20px;
    }

    .no-print {
        display: none !important;
    }

}

</style>
<script>
    // Hapus data keranjang di browser setelah transaksi sukses
    localStorage.removeItem('pos_cart');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/receipt.blade.php ENDPATH**/ ?>