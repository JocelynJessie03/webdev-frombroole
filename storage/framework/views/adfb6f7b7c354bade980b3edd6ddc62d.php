<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | From Broolé</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f2f1] flex items-center justify-center p-4 overflow-hidden">


    <div class="w-full max-w-lg bg-white rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(107,13,13,0.15)] p-10 md:p-12">

        <!-- BACK -->
        <div class="mb-6">

            <a
                href="/login"
                class="flex items-center gap-2 text-gray-400 hover:text-[#8d1010] transition-all font-bold text-sm"
            >
                ← Back
            </a>

        </div>

        <!-- HEADER -->
        <div class="text-center mb-8">

            <div class="w-20 h-20 bg-[#8d1010]/10 rounded-full flex items-center justify-center mx-auto mb-5">

                <img
                    src="<?php echo e(asset('images/logo_from_broole.png')); ?>"
                    class="w-14 h-14 object-contain"
                >

            </div>

            <h1 class="text-4xl font-black text-[#2a1111] tracking-tight mb-3">
                Forgot Password
            </h1>

            <p class="text-gray-500 font-medium leading-relaxed">
                Enter your email to receive a verification code
            </p>

        </div>

        <!-- ERROR POPUP -->
        <?php if($errors->any()): ?>

        <div
            id="errorModal"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
        >

            <div class="bg-white w-[90%] max-w-md rounded-[2rem] p-8 shadow-2xl text-center">

                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">

                    <span class="text-4xl">
                        ⚠️
                    </span>

                </div>

                <h2 class="text-3xl font-black text-[#2a1111] mb-3">
                    Oops!
                </h2>

                <p class="text-gray-500 font-medium mb-6 leading-relaxed">
                    <?php echo e($errors->first()); ?>

                </p>

                <button
                    onclick="document.getElementById('errorModal').style.display='none'"
                    class="bg-[#8d1010] hover:bg-[#741010] transition-all text-white px-8 py-3 rounded-2xl font-black"
                >
                    Try Again
                </button>

            </div>

        </div>

        <?php endif; ?>

        <!-- FORM -->
        <form
            method="POST"
            action="/forgot-password/send-otp"
            class="space-y-5"
        >

            <?php echo csrf_field(); ?>

            <div>

                <label class="block text-[10px] uppercase tracking-[0.25em] text-gray-500 font-black mb-3">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="you@example.com"
                    required
                    class="w-full px-5 py-4 bg-[#f5f3f3] border border-[#f0e6e6] rounded-2xl outline-none focus:bg-white focus:ring-4 focus:ring-[#8d1010]/10 transition-all font-medium"
                >

            </div>

            <button
                type="submit"
                class="w-full py-4 bg-[#a30808] hover:bg-[#870707] transition-all text-white rounded-2xl font-black text-lg shadow-[0_20px_40px_-15px_rgba(163,8,8,0.45)]"
            >
                Send Reset Code
            </button>

        </form>

    </div>


</body>
</html><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/forgot-password.blade.php ENDPATH**/ ?>