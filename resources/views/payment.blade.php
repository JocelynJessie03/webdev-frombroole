<!DOCTYPE html>
<html>

<head>

    <title>Payment</title>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

</head>

<body>

<script>

snap.pay('{{ $snapToken }}', {

    onSuccess: function(result)
    {
        window.location.href =
            "/payment-success/" + result.order_id;
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

</html>