<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Broolé Verification</title>
</head>

<body style="
    margin:0;
    padding:40px 0;
    background:#f3efea;
    font-family:Arial, Helvetica, sans-serif;
">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td align="center">

<table
    width="770"
    cellpadding="0"
    cellspacing="0"
    border="0"
    style="
        background:#ffffff;
        border-radius:30px;
        overflow:hidden;
        box-shadow:0 20px 50px rgba(0,0,0,0.08);
    "
>

    <!-- HEADER -->
    <tr>
        <td
            align="center"
            style="
                background:
                radial-gradient(circle at center,
                #a00018 0%,
                #850014 45%,
                #690010 100%);
                padding:45px 30px 55px;
            "
        >

            <div
                style="
                    width:140px;
                    height:140px;
                    border-radius:50%;
                    background:#fffaf5;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    margin:auto;

                    box-shadow:
                    0 0 20px rgba(255,255,255,.9),
                    0 0 45px rgba(255,255,255,.6),
                    0 0 80px rgba(255,255,255,.3);
                "
            >

                <img
                    src="<?php echo e($message->embed(public_path('images/logo_from_broole.png'))); ?>"
                    alt="From Broolé"
                    width="110"
                    style="
                        display:block;
                        margin:auto;
                    "
                >

            </div>

            <h1
                style="
                    margin-top:28px;
                    margin-bottom:0;

                    color:#fff8f2;

                    font-size:58px;
                    font-family:Georgia, serif;
                    font-style:italic;
                    font-weight:600;

                    text-shadow:
                    0 0 10px rgba(255,255,255,.8),
                    0 0 25px rgba(255,245,220,.6);
                "
            >
                From Broolé
            </h1>

        </td>
    </tr>

    <!-- CONTENT -->
    <tr>
        <td style="
            padding:60px 60px;
            text-align:center;
        ">

            <h2 style="
                margin-top:0;
                margin-bottom:20px;
                color:#1f2937;
                font-size:28px;
                font-weight:700;
            ">
                Verify Your Identity
            </h2>

            <p style="
                color:#6b7280;
                font-size:18px;
                line-height:1.7;
                margin-bottom:40px;
            ">
                Use the verification code below to continue your account verification.
            </p>

            <!-- OTP BOX -->
            <div
                style="
                    display:inline-block;
                    background:#fff8f8;
                    border:2px solid #f2d4d4;
                    border-radius:20px;
                    padding:30px 45px;
                    margin-bottom:35px;
                "
            >

                <span
                    style="
                        font-size:64px;
                        font-weight:800;
                        color:#8b0015;
                        letter-spacing:14px;
                    "
                >
                    <?php echo e($otp); ?>

                </span>

            </div>

            <p style="
                color:#6b7280;
                font-size:18px;
                margin-top:0;
            ">
                This code will expire in
                <strong>5 minutes</strong>.
            </p>

            <hr
                style="
                    border:none;
                    border-top:1px solid #e5e7eb;
                    margin:45px 0;
                "
            >

            <p style="
                color:#6b7280;
                font-size:16px;
                line-height:1.7;
                margin:0;
            ">
                For security reasons, please do not share this code with anyone.
            </p>

        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td
            style="
                background:#faf8f6;
                padding:25px;
                text-align:center;
            "
        >

            <p style="
                margin:0;
                color:#9ca3af;
                font-size:15px;
            ">
                © <?php echo e(date('Y')); ?> From Broolé. All rights reserved.
            </p>

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html><?php /**PATH D:\Herd\webdev-frombroole\resources\views/emails/otp.blade.php ENDPATH**/ ?>