<!DOCTYPE html>
<html>

<head>

    <title>Payment</title>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo e(config('midtrans.client_key')); ?>">
    </script>

</head>

<body>

<script>

snap.pay('<?php echo e($snapToken); ?>', {

    onSuccess: function(result)
    {
        window.location.href =
            "/pos/payment-success/" + result.order_id;
    },

    onPending: function(result)
    {
        alert("Payment Pending");
    },

    onError: function(result)
    {
        alert("Payment Failed");
    }

});

</script>

</body>

</html><?php /**PATH D:\Herd\webdev-frombroole\resources\views/payment.blade.php ENDPATH**/ ?>