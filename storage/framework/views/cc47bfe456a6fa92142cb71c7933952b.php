<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            line-height: 1.6;
            margin: 0;
            padding: 20px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            background-color: #8C1717;
            color: #ffffff;
            text-align: center;
            padding: 40px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .order-meta {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            font-size: 14px;
        }
        .order-meta p {
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
        }
        .order-meta strong {
            color: #4b5563;
        }
        .order-meta span {
            color: #111827;
            font-weight: 600;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f3f4f6;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .items-table th {
            font-size: 13px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 600;
            padding: 12px 8px;
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
        }
        .items-table td {
            padding: 15px 8px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }
        .items-table th.right, .items-table td.right {
            text-align: right;
        }
        .product-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }
        .product-meta {
            font-size: 13px;
            color: #6b7280;
        }
        .totals {
            width: 100%;
            margin-top: 10px;
        }
        .totals td {
            padding: 10px 8px;
            text-align: right;
            font-size: 15px;
        }
        .totals-label {
            color: #4b5563;
        }
        .grand-total {
            font-size: 20px !important;
            font-weight: 700;
            color: #8C1717;
            border-top: 2px solid #e5e7eb;
            padding-top: 15px !important;
        }
        .footer {
            background-color: #f9fafb;
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>From Broolé</h1>
            <p>Thank you for your purchase!</p>
        </div>

        <div class="content">
            <div class="order-meta">
                <p><strong>Order ID:</strong> <span><?php echo e($order->order_id); ?></span></p>
                <p><strong>Date:</strong> <span><?php echo e(\Carbon\Carbon::parse($order->order_date)->format('d M Y, H:i')); ?></span></p>
                <p><strong>Payment Status:</strong> <span><?php echo e($order->payment_status); ?></span></p>
                <p><strong>Payment Method:</strong> <span><?php echo e($order->payment_method); ?></span></p>
            </div>

            <div class="section-title">Order Summary</div>

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
                                <div class="product-name"><?php echo e($item->product->pro_name ?? 'Unknown Product'); ?></div>
                                <?php if($item->sugar_level): ?>
                                    <div class="product-meta">Sugar: <?php echo e($item->sugar_level); ?>%</div>
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
                        <td style="color: #10b981; font-weight: 600;">- Rp <?php echo e(number_format($order->points_used, 0, ',', '.')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($order->promo_code): ?>
                    <tr>
                        <td class="totals-label">Promo Applied</td>
                        <td style="font-weight: 600; color: #111827;"><?php echo e($order->promo_code); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td class="totals-label" style="font-weight: 600; color: #111827;">Total Paid</td>
                    <td class="grand-total">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>If you have any questions about your order, please contact our support.</p>
            <p>&copy; <?php echo e(date('Y')); ?> From Broolé. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Herd\webdev-frombroole\resources\views/emails/order_receipt.blade.php ENDPATH**/ ?>