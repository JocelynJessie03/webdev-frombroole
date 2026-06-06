<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #8C1717;
            margin: 0;
            font-size: 24px;
        }
        .order-meta {
            margin-bottom: 25px;
            font-size: 14px;
        }
        .order-meta p {
            margin: 5px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .items-table th, .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .items-table th {
            background-color: #fafafa;
            color: #555;
            font-weight: bold;
        }
        .items-table td.right, .items-table th.right {
            text-align: right;
        }
        .totals {
            width: 100%;
            margin-top: 20px;
        }
        .totals td {
            padding: 8px 12px;
            text-align: right;
        }
        .totals-label {
            font-weight: bold;
            color: #555;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #8C1717;
            border-top: 2px solid #eee;
            padding-top: 15px !important;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>From Broolé</h1>
            <p>Thank you for your purchase!</p>
        </div>

        <div class="order-meta">
            <p><strong>Order ID:</strong> <?php echo e($order->order_id); ?></p>
            <p><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($order->order_date)->format('d M Y, H:i')); ?></p>
            <p><strong>Payment Status:</strong> <?php echo e($order->payment_status); ?></p>
            <p><strong>Payment Method:</strong> <?php echo e($order->payment_method); ?></p>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="right">Qty</th>
                    <th class="right">Price</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($item->product->pro_name ?? 'Unknown Product'); ?>

                            <?php if($item->sugar_level): ?>
                                <br><small style="color: #777;">Sugar: <?php echo e($item->sugar_level); ?>%</small>
                            <?php endif; ?>
                        </td>
                        <td class="right"><?php echo e($item->quantity); ?></td>
                        <td class="right">Rp <?php echo e(number_format($item->price_at_purchase, 0, ',', '.')); ?></td>
                        <td class="right">Rp <?php echo e(number_format($item->quantity * $item->price_at_purchase, 0, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <table class="totals">
            <?php if($order->points_used > 0): ?>
                <tr>
                    <td class="totals-label">Points Used</td>
                    <td>- Rp <?php echo e(number_format($order->points_used, 0, ',', '.')); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($order->promo_code): ?>
                <tr>
                    <td class="totals-label">Promo Applied (<?php echo e($order->promo_code); ?>)</td>
                    <td>Yes</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="totals-label grand-total">Total Paid</td>
                <td class="grand-total">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
            </tr>
        </table>

        <div class="footer">
            <p>If you have any questions about your order, please contact our support.</p>
            <p>&copy; <?php echo e(date('Y')); ?> From Broolé. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Herd\webdev-frombroole\resources\views/emails/order_receipt.blade.php ENDPATH**/ ?>