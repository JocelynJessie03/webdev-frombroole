<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Password | From Broolé</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f2f1] flex items-center justify-center p-4 overflow-hidden">

<div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(107,13,13,0.15)] p-8 md:p-10">

    <!-- BACK -->
    <div class="mb-6">

        <a
            href="/verify-reset-otp"
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
            Create New Password
        </h1>

        <p class="text-gray-500 font-medium leading-relaxed">
            Your new password must be secure and unique
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
    <form method="POST" action="/new-password" class="space-y-5">
        <?php echo csrf_field(); ?>

        <!-- NEW PASSWORD -->
        <div>

            <label class="block text-[10px] uppercase tracking-[0.25em] text-gray-500 font-black mb-3">
                New Password
            </label>

            <div class="relative">

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    class="w-full px-5 py-4 pr-14 bg-[#f5f3f3] border border-[#f0e6e6] rounded-2xl outline-none focus:bg-white focus:ring-4 focus:ring-[#8d1010]/10 transition-all font-medium"
                >

                <button
                    type="button"
                    id="eyeIcon"
                    onclick="togglePassword()"
                    class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8d1010] transition-all z-10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                        />
                    </svg>

                </button>

            </div>

        </div>

        <!-- CONFIRM PASSWORD -->
        <div>

            <label class="block text-[10px] uppercase tracking-[0.25em] text-gray-500 font-black mb-3">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                placeholder="••••••••"
                required
                class="w-full px-5 py-4 bg-[#f5f3f3] border border-[#f0e6e6] rounded-2xl outline-none focus:bg-white focus:ring-4 focus:ring-[#8d1010]/10 transition-all font-medium"
            >

        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full py-4 bg-[#a30808] hover:bg-[#870707] transition-all text-white rounded-2xl font-black text-lg shadow-[0_20px_40px_-15px_rgba(163,8,8,0.45)]"
        >
            Update Password
        </button>

    </form>

</div>

<script>

function togglePassword() {

    const passwordInput = document.getElementById('password');

    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        eyeIcon.classList.remove('text-gray-400');

        eyeIcon.classList.add('text-[#8d1010]');

    } else {

        passwordInput.type = 'password';

        eyeIcon.classList.remove('text-[#8d1010]');

        eyeIcon.classList.add('text-gray-400');
    }
}

</script>

</body>
</html><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/new-password.blade.php ENDPATH**/ ?>