<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Complete</title>
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
            padding: 40px 30px;
            text-align: center;
        }
        .icon-success {
            display: inline-block;
            width: 64px;
            height: 64px;
            background-color: #ecfdf5;
            color: #10b981;
            border-radius: 50%;
            line-height: 64px;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .greeting {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #111827;
        }
        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }
        .order-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }
        .order-box p {
            margin: 8px 0;
            font-size: 15px;
        }
        .order-box strong {
            color: #111827;
        }
        .btn {
            display: inline-block;
            background-color: #8C1717;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #7a1414;
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
            <p>Your sweetest moment is ready!</p>
        </div>
        
        <div class="content">
            <div class="icon-success">✓</div>
            <div class="greeting">Hi <?php echo e($order->customer->customer_name ?? 'there'); ?>,</div>
            <div class="message">
                Great news! Your order has been successfully completed. 
                We hope you enjoy your delicious treats from From Broolé.
            </div>

            <div class="order-box">
                <p><strong>Order ID:</strong> <?php echo e($order->order_id); ?></p>
                <p><strong>Completed On:</strong> <?php echo e(now()->format('d M Y, H:i')); ?></p>
            </div>

            <a href="<?php echo e(url('/')); ?>" class="btn">Order Again</a>
        </div>

        <div class="footer">
            <p>If you have any questions or feedback, please contact our support.</p>
            <p>&copy; <?php echo e(date('Y')); ?> From Broolé. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Herd\webdev-frombroole\resources\views/emails/order_complete.blade.php ENDPATH**/ ?>