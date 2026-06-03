

<?php $__env->startSection('content'); ?>


<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="mb-8 border-b pb-4">
        <h2 class="text-3xl font-bold text-[#7b0000]">
            Transaction History
        </h2>

        <p class="text-gray-500 mt-2">
            Review status and details of your orders.
        </p>
    </div>

    <?php if($orders->isEmpty()): ?>

    <div
        class="bg-white rounded-[40px] shadow-sm border border-[#7b0000]/10 p-12 text-center"
        data-aos="zoom-in"
    >
        <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-[#7b0000]/10 flex items-center justify-center">
            🧁
        </div>

        <h3 class="text-2xl font-black text-[#7b0000] mb-2">
            No Orders Yet
        </h3>

        <p class="text-gray-500 mb-6">
            Looks like you haven't treated yourself yet.
            Start exploring our handcrafted desserts 🍰
        </p>

        <a
            href="<?php echo e(route('customer.shop')); ?>"
            class="inline-block bg-[#7b0000] text-white px-6 py-3 rounded-2xl font-bold"
        >
            Explore Shop
        </a>
    </div>

    <?php else: ?>

        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div
            data-aos="fade-up"
            class="mb-6"
        >

            <?php
                $badgeColor = match($order->status) {
                    'Pending' => 'bg-yellow-100 text-yellow-700',
                    'Preparing' => 'bg-blue-100 text-blue-700',
                    'Complete' => 'bg-green-100 text-green-700',
                    'Delivered' => 'bg-gray-100 text-gray-700',
                    default => 'bg-gray-100 text-gray-700'
                };
            ?>

            <details
                class="
                    group
                    bg-white
                    rounded-[28px]
                    border
                    border-gray-100
                    overflow-hidden
                    transition-all
                    duration-500

                    hover:border-[#7b0000]/20
                    hover:shadow-xl

                    open:border-[#7b0000]/20
                    open:shadow-[0_8px_35px_rgba(123,0,0,0.10)]
                "
            >

                <summary
                    class="
                        list-none
                        cursor-pointer
                        p-6
                        md:p-8
                    "
                >

                    <div class="flex justify-between items-center">

                        <div>

                            <h4 class="font-black text-xl text-[#2D2D2D]">
                                Order <?php echo e($order->order_id); ?>

                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                <?php echo e($order->order_date?->format('d M Y • H:i')); ?>

                            </p>

                        </div>

                        <div class="flex items-center gap-4">

                            <div class="text-right">

                                <p class="text-2xl font-black text-[#7b0000]">
                                    Rp <?php echo e(number_format($order->total_price,0,',','.')); ?>

                                </p>

                                <span class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold <?php echo e($badgeColor); ?>">
                                    <?php echo e($order->status); ?>

                                </span>

                            </div>

                            <svg
                                class="w-5 h-5 text-[#7b0000] transition-transform duration-300 group-open:rotate-180"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </div>

                    </div>

                </summary>

                <div
                    class="
                        border-t
                        border-gray-100
                        bg-[#fcfbfa]
                        p-6
                        md:p-8
                    "
                >

                    <h5 class="font-black text-[#7b0000] mb-5">
                        Item Breakdown
                    </h5>

                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div
                        class="
                            flex
                            justify-between
                            items-center
                            py-4
                            border-b
                            border-gray-100
                            last:border-0
                        "
                    >

                        <div class="flex items-center gap-4">

                            <span
                                class="
                                    w-8
                                    h-8
                                    rounded-full
                                    bg-[#7b0000]/10
                                    text-[#7b0000]
                                    flex
                                    items-center
                                    justify-center
                                    font-bold
                                    text-sm
                                "
                            >
                                <?php echo e($index + 1); ?>

                            </span>

                            <div>

                                <p class="font-bold text-gray-900">
                                    <?php echo e(optional($item->product)->pro_name ?? 'Deleted Product'); ?>

                                </p>

                                <p class="text-sm text-gray-500">
                                    Qty <?php echo e($item->quantity); ?>

                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="font-bold text-[#7b0000]">
                                Rp <?php echo e(number_format($item->price_at_purchase * $item->quantity,0,',','.')); ?>

                            </p>

                        </div>

                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </details>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/customer/transaction-history.blade.php ENDPATH**/ ?>